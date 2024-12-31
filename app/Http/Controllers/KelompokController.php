<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Kelas;
use App\Models\JadwalPresentasi;
use Illuminate\Http\Request;
use App\Models\Lab;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KelompokController extends Controller
{
    public function index()
    {
        // Ambil semua kelompok
        $kelompok = Kelompok::with(['lab', 'jadwalPresentasi', 'user'])
            ->orderByRaw('CASE WHEN user_id = ? THEN 0 ELSE 1 END', [Auth::id()]) // Kelompok user login di atas
            ->orderBy('created_at', 'desc') // Kemudian urutkan berdasarkan yang terbaru
            ->get();

        // Tambahkan debugging
        // foreach ($kelompok as $k) {
        //     \Log::info('Kelompok ID: ' . $k->id);
        //     \Log::info('User ID: ' . $k->user_id);
        //     \Log::info('Auth ID: ' . Auth::id());
        //     \Log::info('Is Same: ' . ($k->user_id === Auth::id() ? 'true' : 'false'));
        // }

        return view('mahasiswa.index', compact('kelompok'));
    }

    public function create()
    {
        $kelas = Kelas::all();

        // Ambil lab
        $labs = Lab::all();

        // Ambil semua kelompok yang diterima, beserta lab_id dan jadwal_presentasi_id mereka
        $kelompoks = Kelompok::where('status', 'Diterima')
            ->get(['lab_id', 'jadwal_presentasi_id']);

        // Ubah ke array yang bisa diproses
        $usedJadwalIds = $kelompoks->map(function ($kelompok) {
            return [
                'lab_id' => $kelompok->lab_id,
                'jadwal_id' => $kelompok->jadwal_presentasi_id,
            ];
        });

        // Ambil semua jadwal presentasi
        $jadwal = JadwalPresentasi::all();

        return view('mahasiswa.create', compact('jadwal', 'kelas', 'kelompoks', 'labs', 'usedJadwalIds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_proyek' => 'required',
            'ketua' => 'required',
            'npm_ketua' => 'required',
            'anggota' => 'array',
            'npm_anggota' => 'array',
            'kelas_id' => 'required',
            'mode' => 'required',
        ]);

        // Filter anggota dan npm_anggota
        $filteredAnggota = array_values(array_filter($request->anggota, function ($value) {
            return !empty(trim($value));
        }));

        $filteredNpmAnggota = array_values(array_filter($request->npm_anggota, function ($key) use ($request) {
            return !empty(trim($request->anggota[$key]));
        }, ARRAY_FILTER_USE_KEY));

        // Mode handling (online/offline)
        $modeNew = $request->mode == 'true' ? 1 : 0;

        // For online mode (true), set jadwal_presentasi_id as null initially
        // For offline mode (false), get jadwal based on kelas
        $jadwalId = null;
        if (!$modeNew) { // If offline mode
            $jadwalId = $request->kelas_id;
        }

        // Create kelompok
        Kelompok::create([
            'user_id' => Auth::user()->id,
            'judul_proyek' => $request->judul_proyek,
            'ketua' => $request->ketua,
            'npm_ketua' => $request->npm_ketua,
            'anggota' => json_encode($filteredAnggota),
            'npm_anggota' => json_encode($filteredNpmAnggota),
            'kelas_id' => $request->kelas_id,
            'jadwal_presentasi_id' => $jadwalId,
            'mode' => $modeNew,
            'status' => 'Pending',
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Pengajuan kelompok berhasil dikirim.');
    }

    public function showJadwalForm($id)
    {
        $kelompok = Kelompok::findOrFail($id);

        // Cek apakah kelompok milik user yang login
        if ($kelompok->user_id !== Auth::user()->id) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Anda tidak memiliki akses ke kelompok ini.');
        }

        $labs = Lab::all();
        $jadwals = JadwalPresentasi::all();

        // Ambil data jadwal yang sudah digunakan
        $usedJadwals = Kelompok::where('status', 'Diterima') // Pastikan status "Diterima" sudah benar
            ->whereNotNull('jadwal_presentasi_id')
            ->pluck('jadwal_presentasi_id') // Hanya ambil ID jadwal
            ->toArray(); // Konversi ke array


        return view('mahasiswa.jadwal', compact('kelompok', 'labs', 'jadwals', 'usedJadwals'));
    }
    public function updateJadwal(Request $request, $id)
    {
        try {
            $kelompok = Kelompok::find($id);

            if (!$kelompok) {
                return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
            }

            $request->validate([
                'jadwal_presentasi_id' => 'required|exists:jadwal_presentasis,id',
            ]);

            // Get the new jadwal
            $newJadwal = JadwalPresentasi::find($request->jadwal_presentasi_id);
            if (!$newJadwal) {
                return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
            }

            // Update jadwal status to pending
            $newJadwal->status = 'pending';
            $newJadwal->save();

            // Update kelompok with requested jadwal and set mode to online
            $kelompok->requested_jadwal_id = $request->jadwal_presentasi_id;
            $kelompok->mode = true; // Set mode to online/true
            $kelompok->save();

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Permintaan perubahan jadwal telah dikirim dan menunggu persetujuan admin.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui jadwal.');
        }
    }

    // Add new methods for admin approval
    public function approveJadwalUpdate($id)
    {
        $kelompok = Kelompok::find($id);

        if (!$kelompok) {
            return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
        }

        $kelompok->update([
            'jadwal_presentasi_id' => $kelompok->requested_jadwal_id,
            'requested_jadwal_id' => null,
            'jadwal_update_status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'Perubahan jadwal telah disetujui.');
    }

    public function rejectJadwalUpdate($id)
    {
        $kelompok = Kelompok::find($id);

        if (!$kelompok) {
            return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
        }

        $kelompok->update([
            'requested_jadwal_id' => null,
            'jadwal_update_status' => 'rejected'
        ]);

        return redirect()->back()->with('success', 'Perubahan jadwal ditolak.');
    }

    // public function updateJadwal(Request $request, $id)
    // {
    //     Carbon::setLocale('id');
    //     $kelompok = Kelompok::findOrFail($id);

    //     // Cek apakah kelompok milik user yang login
    //     if ($kelompok->user_id !== Auth::user()->id) {
    //         return redirect()->route('mahasiswa.index')
    //             ->with('error', 'Anda tidak memiliki akses ke kelompok ini.');
    //     }

    //     $request->validate([
    //         'jadwal_presentasi_id' => 'required|exists:jadwal_presentasis,id',
    //     ]);

    //     // Cek apakah jadwal sudah digunakan di lab yang sama
    //     $existingKelompok = Kelompok::where('lab_id', $request->lab_id)
    //         ->where('jadwal_presentasi_id', $request->jadwal_presentasi_id)
    //         ->where('status', 'Diterima')
    //         ->where('id', '!=', $id)
    //         ->first();

    //     if ($existingKelompok) {
    //         return back()->with('error', 'Jadwal ini sudah digunakan di lab yang dipilih.');
    //     }

    //     $kelompok->update([
    //         'jadwal_presentasi_id' => $request->jadwal_presentasi_id,
    //     ]);

    //     return redirect()->route('mahasiswa.index')
    //         ->with('success', 'Jadwal dan lab berhasil diajukan.');
    // }

    public function edit($id)
    {
        $kelompok = Kelompok::findOrFail($id);

        // Cek apakah kelompok milik user yang login
        if ($kelompok->user_id !== Auth::id()) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Anda tidak memiliki akses ke kelompok ini.');
        }

        $kelas = Kelas::all();

        return view('mahasiswa.edit', compact('kelompok', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelompok = Kelompok::findOrFail($id);

        // Cek apakah kelompok milik user yang login
        if ($kelompok->user_id !== Auth::id()) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Anda tidak memiliki akses ke kelompok ini.');
        }

        $request->validate([
            'judul_proyek' => 'required',
            'ketua' => 'required',
            'npm_ketua' => 'required',
            'anggota' => 'array',
            'npm_anggota' => 'array',
            'kelas_id' => 'required',
        ]);

        // Filter anggota dan npm_anggota yang tidak kosong
        $filteredAnggota = array_values(array_filter($request->anggota, function ($value) {
            return !empty(trim($value));
        }));

        $filteredNpmAnggota = array_values(array_filter($request->npm_anggota, function ($key) use ($request) {
            return !empty(trim($request->anggota[$key]));
        }, ARRAY_FILTER_USE_KEY));

        // Reset status ke Pending untuk persetujuan ulang
        $kelompok->update([
            'judul_proyek' => $request->judul_proyek,
            'ketua' => $request->ketua,
            'npm_ketua' => $request->npm_ketua,
            'anggota' => json_encode($filteredAnggota),
            'npm_anggota' => json_encode($filteredNpmAnggota),
            'kelas_id' => $request->kelas_id,
            'status' => 'Pending', // Reset status ke Pending
            'jadwal_lab_opened' => false, // Reset akses jadwal
            'lab_id' => null, // Reset lab
            'jadwal_presentasi_id' => null // Reset jadwal
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Pengajuan berhasil diupdate dan menunggu persetujuan admin.');
    }

    public function openJadwalLab($id)
    {
        $kelompok = Kelompok::find($id);
        if ($kelompok) {
            $kelompok->jadwal_lab_opened = true;
            // Tambahkan logika untuk mengisi link
            $kelompok->link = request('link'); // Mengambil link dari request
            $kelompok->save();
            return redirect()->back()->with('success', 'Pengajuan jadwal dan lab telah dibuka untuk kelompok ini.');
        }
        return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
    }
}
