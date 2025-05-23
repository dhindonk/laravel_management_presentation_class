<?php

namespace App\Http\Controllers;

use App\Models\JadwalPresentasi;
use App\Models\Kelompok;
use App\Models\Nilai;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $kelompok = Kelompok::with(['nilais', 'kelas', 'jadwalPresentasi'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.index', compact('kelompok'));
    }

    public function approve($id)
    {
        try {
            $kelompok = Kelompok::find($id);
            if (!$kelompok) {
                return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
            }

            // if ($kelompok->mode) {
            //     // For online mode, validate link
            //     request()->validate([
            //         'link' => 'required'
            //     ]);
            //     $kelompok->link = request('link');
            // }

            $kelompok->status = 'Diterima';
            $kelompok->save();

            return redirect()->back()->with('success', 'Pengajuan berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui pengajuan.');
        }
    }
    // Tolak pengajuan
    public function reject($id)
    {
        $kelompok = Kelompok::find($id);
        if ($kelompok) {
            $kelompok->status = 'Ditolak';
            $kelompok->save();
            return redirect()->back()->with('success', 'Pengajuan ditolak.');
        }
        return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
    }

    public function storeNilai(Request $request, $id)
    {
        $request->validate([
            'nama_penilai' => 'required|string',
            'penilaian_presentasi' => 'required|numeric|min:0|max:100',
            'penilaian_materi' => 'required|numeric|min:0|max:100',
            'penilaian_diskusi' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string|max:200',
        ]);

        $kelompok = Kelompok::findOrFail($id);

        // Update jika sudah ada, atau buat baru jika belum ada
        Nilai::updateOrCreate(
            ['kelompok_id' => $kelompok->id, 'nama_penilai' => $request->nama_penilai],
            [
                'penilaian_presentasi' => $request->penilaian_presentasi,
                'penilaian_materi' => $request->penilaian_materi,
                'penilaian_diskusi' => $request->penilaian_diskusi,
                'catatan' => $request->catatan,
            ]
        );

        return response()->json(['success' => true]);
    }


    public function selesai($id)
    {
        $kelompok = Kelompok::find($id);
        if ($kelompok) {
            $kelompok->selesai = true; // Tandai sebagai selesai
            $kelompok->save();
            return redirect()->back()->with('success', 'Kelompok telah menuntaskan presentasi.');
        }
        return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
    }

    public function jadwal()
    {
        // Ambil semua jadwal presentasi
        $jadwals = JadwalPresentasi::all();
        return view('admin.jadwal', compact('jadwals'));
    }

    // Menyimpan jadwal presentasi yang dibuat admin
    public function storeJadwal(Request $request)
    {
        $request->validate([
            'tanggal_presentasi' => 'required|date',
            'waktu_presentasi' => 'required|date_format:H:i',
        ]);

        JadwalPresentasi::create([
            'tanggal_presentasi' => $request->tanggal_presentasi,
            'waktu_presentasi' => $request->waktu_presentasi,
        ]);

        return redirect()->route('admin.jadwalForm')->with('success', 'Jadwal presentasi berhasil ditambahkan.');
    }
    public function destroyJadwal($id)
    {
        $jadwal = JadwalPresentasi::find($id);

        if ($jadwal->kelompok()->count() > 0) {
            return redirect()->back()->with('error', 'Jadwal tidak dapat dihapus karena sedang digunakan.');
        }

        $jadwal->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }

    public function destroy($id)
    {
        $kelompok = Kelompok::find($id);
        if ($kelompok) {
            $kelompok->delete();
            return redirect()->back()->with('success', 'Kelompok berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
    }

    public function openJadwalLab($id)
    {
        $kelompok = Kelompok::find($id);
        if ($kelompok) {
            $kelompok->jadwal_lab_opened = true;
            $kelompok->link = request('link');
            $kelompok->save();
            return redirect()->back()->with('success', 'Pengajuan jadwal dan lab telah dibuka untuk kelompok ini.');
        }
        return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
    }

    public function openAllJadwalLab()
    {
        // Update semua kelompok yang statusnya 'Diterima' dan belum dibuka akses jadwalnya
        Kelompok::where('status', 'Diterima')
            ->where('jadwal_lab_opened', false)
            ->update(['jadwal_lab_opened' => true]);

        return redirect()->back()->with('success', 'Pengajuan jadwal dan lab telah dibuka untuk semua kelompok yang diterima.');
    }

    public function approveJadwalChange($id)
    {
        try {
            $kelompok = Kelompok::find($id);
            if (!$kelompok) {
                return redirect()->back()->with('error', 'Kelompok tidak ditemukan.');
            }

            // Validate link
            request()->validate([
                'link' => 'required'
            ]);

            // Update kelompok with new jadwal and link
            $kelompok->jadwal_presentasi_id = $kelompok->requested_jadwal_id;
            $kelompok->requested_jadwal_id = null;
            $kelompok->link = request('link'); // Add link
            $kelompok->mode = true; // Set to online mode
            $kelompok->save();

            // Update jadwal status
            if ($kelompok->jadwalPresentasi) {
                $kelompok->jadwalPresentasi->status = 'approved';
                $kelompok->jadwalPresentasi->save();
            }

            return redirect()->back()->with('success', 'Perubahan jadwal disetujui dan link telah ditambahkan.');
        } catch (\Exception $e) {
            // \Log::error('Error in approveJadwalChange: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui perubahan jadwal.');
        }
    }

    public function rejectJadwalChange($id)
    {
        $kelompok = Kelompok::find($id);
        if (!$kelompok || !$kelompok->requested_jadwal_id) {
            return redirect()->back()->with('error', 'Permintaan perubahan jadwal tidak ditemukan.');
        }

        // Get the requested jadwal
        $jadwal = JadwalPresentasi::find($kelompok->requested_jadwal_id);
        if ($jadwal) {
            // Reset jadwal status
            $jadwal->status = 'rejected';
            $jadwal->save();
        }

        // Reset kelompok request
        $kelompok->requested_jadwal_id = null;
        $kelompok->save();

        return redirect()->back()->with('success', 'Perubahan jadwal ditolak.');
    }
}
