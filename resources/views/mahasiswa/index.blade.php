@extends('layouts.app')

@section('content')
    <section class="pc-container" style="top: 10px !important; margin-left: 0 !important; margin: 40px !important;">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tugas Akhir Mobile Programming</h5>
                        <p class="text-muted">Ajukan presentasi tugas akhir Mobile Programming Anda dengan mudah di sini.</p>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-4">
                            <a class="btn btn-primary btn-lg" href="{{ route('mahasiswa.create') }}">Buat Pengajuan</a>
                        </div>

                        <div class="table-responsive" style="border-radius: 15px !important">
                            <table id="complex-header" class="table table-striped table-bordered nowrap">
                                <thead class="text-light text-center " style="background: #860000;">
                                    <tr>
                                        <th style="color: white !important">Judul Proyek</th>
                                        <th style="color: white !important">Ketua & Anggota</th>
                                        <th style="color: white !important">Lab</th>
                                        <th style="color: white !important">Jadwal Presentasi</th>
                                        <th style="color: white !important">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($kelompok->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <img src="https://icons.veryicon.com/png/o/business/financial-category/no-data-6.png"
                                                    alt="Data Kosong" style="max-width: 300px;">
                                                <h5>Data Kosong</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($kelompok as $k)
                                            <tr>
                                                <td style="text-align: center; ">{{ $k->judul_proyek }}
                                                    @if ($k->selesai == 1)
                                                        <img src="{{ asset('verified.png') }}" width="20"
                                                            height="20">
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $k->ketua }} [ {{ $k->npm_ketua }} ]</strong>

                                                    <button class="btn btn-link p-0" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#anggotaCollapse{{ $k->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="anggotaCollapse{{ $k->id }}">
                                                        <i id="iconArrow{{ $k->id }}" class="fas fa-chevron-down"
                                                            style="color: var(--primary)"></i>
                                                    </button>
                                                    <br>
                                                    <div class="collapse mt-2" id="anggotaCollapse{{ $k->id }}">
                                                        <small>
                                                            @if (!empty($k->anggota) && !empty($k->npm_anggota))
                                                                @php
                                                                    $anggotaList = json_decode($k->anggota);
                                                                    $npmList = json_decode($k->npm_anggota);
                                                                @endphp
                                                                @if (count($anggotaList) === count($npmList))
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($anggotaList as $index => $anggota)
                                                                            <li>{{ $anggota }} [
                                                                                {{ $npmList[$index] }}
                                                                                ]</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    <span>Jumlah anggota dan NPM tidak sesuai</span>
                                                                @endif
                                                            @else
                                                                <span>Tidak ada anggota atau NPM</span>
                                                            @endif
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>{{ $k->lab->nama_lab }}</td>
                                                <td class="text-center">
                                                    @if ($k->jadwalPresentasi)
                                                        <span>{{ $k->jadwalPresentasi->tanggal_presentasi }}</span><br>
                                                        <small>{{ $k->jadwalPresentasi->waktu_presentasi }}</small>
                                                    @else
                                                        <span class="badge bg-secondary">Belum diatur</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($k->status == 'Pending')
                                                        <span class="btn btn-warning disabled ">Pending</span>
                                                    @elseif($k->status == 'Diterima')
                                                        <span class="btn btn-success disabled ">Diterima</span>
                                                    @elseif($k->status == 'Ditolak')
                                                        <span class="btn btn-danger disabled ">Ditolak</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const collapses = document.querySelectorAll('[data-bs-toggle="collapse"]');

            collapses.forEach(function(button) {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const targetCollapse = document.querySelector(this.getAttribute(
                        'data-bs-target'));

                    // Toggle icon direction based on collapse state
                    targetCollapse.addEventListener('shown.bs.collapse', function() {
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    });

                    targetCollapse.addEventListener('hidden.bs.collapse', function() {
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    });
                });
            });
        });
    </script>
@endsection
