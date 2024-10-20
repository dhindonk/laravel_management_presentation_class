<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\Kelas;
use App\Models\JadwalPresentasi;
use Illuminate\Http\Request;
use App\Models\Lab;

class KelompokController extends Controller
{
    public function index()
    {
        $kelompok = Kelompok::all();
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
            'anggota' => 'required|array',
            'npm_anggota' => 'required|array',
            'lab_id' => 'required|exists:labs,id',
            'kelas_id' => 'required',
            'jadwal_presentasi_id' => 'required',
        ]);

        // Cek apakah jadwal presentasi pada lab tersebut sudah digunakan oleh kelompok lain yang diterima
        $existingKelompok = Kelompok::where('lab_id', $request->lab_id)
            ->where('jadwal_presentasi_id', $request->jadwal_presentasi_id)
            ->where('status', 'Diterima')
            ->first();

        if ($existingKelompok) {
            return redirect()->back()->withErrors([
                'jadwal_presentasi_id' => 'Jadwal ini sudah digunakan oleh kelompok lain di lab yang sama.',
            ])->withInput();
        }

        Kelompok::create([
            'judul_proyek' => $request->judul_proyek,
            'ketua' => $request->ketua,
            'npm_ketua' => $request->npm_ketua,
            'anggota' => json_encode($request->anggota),
            'npm_anggota' => json_encode($request->npm_anggota),
            'lab_id' => $request->lab_id,
            'kelas_id' => $request->kelas_id,
            'jadwal_presentasi_id' => $request->jadwal_presentasi_id,
            'status' => 'Pending',
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Pengajuan berhasil dikirim.');
    }
}
