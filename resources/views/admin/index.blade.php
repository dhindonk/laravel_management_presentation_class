@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div style="color: white !important">

        <div class="container mt-5">
            <div class="text-end">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger" style="opacity: 50%">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>

            <h1 class="text-center text-white mb-4">Manajemen Pengajuan Presentasi</h1>

            <div class="text-end mb-3">
                <a href="{{ route('admin.jadwalForm') }}" class="btn btn-dark">Buat Jadwal Presentasi</a>
            </div>

            <div class="table-responsive">
                <div class="mt-3">
                    <strong>Legenda Nilai:</strong>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <span class="badge" style="background-color: #28a745;">•</span> Nilai Presentasi
                        </li>
                        <li class="list-inline-item">
                            <span class="badge" style="background-color: #e4af10;">•</span> Nilai Materi
                        </li>
                        <li class="list-inline-item">
                            <span class="badge" style="background-color: #dc3545;">•</span> Nilai Diskusi
                        </li>
                    </ul>
                </div>


                <table class="table table-body table-hover">
                    <thead class="text-white text-center" style="background: #09191F !important">
                        <tr>
                            <th style="color: white !important;">Judul Proyek</th>
                            <th style="color: white !important">Ketua & Anggota</th>
                            <th style="color: white !important">Lab</th>
                            <th style="color: white !important">Status</th>
                            <th style="color: white !important">Jadwal Presentasi</th>
                            <th style="color: white !important">Nilai</th>
                            <th style="color: white !important; ">Aksi</th>
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
                                    <td class="text-white">{{ $k->judul_proyek }}</td>
                                    <td class="text-white">
                                        <strong style="color: white">{{ $k->ketua }} [ {{ $k->npm_ketua }} ]</strong>

                                        <button class="btn btn-link p-0 collapse-btn" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#anggotaCollapse{{ $k->id }}" aria-expanded="false"
                                            aria-controls="anggotaCollapse{{ $k->id }}">
                                            <i id="iconArrow{{ $k->id }}" class="fas fa-chevron-down"
                                                style="color: white; transition: transform 0.3s ease"></i>
                                        </button>
                                        <br>
                                        <div class="collapse mt-2" id="anggotaCollapse{{ $k->id }}">
                                            <small style="color: white">
                                                @if (!empty($k->anggota) && !empty($k->npm_anggota))
                                                    @php
                                                        $anggotaList = json_decode($k->anggota);
                                                        $npmList = json_decode($k->npm_anggota);
                                                    @endphp
                                                    @if (count($anggotaList) === count($npmList))
                                                        <ul class="list-unstyled">
                                                            @foreach ($anggotaList as $index => $anggota)
                                                                <li>{{ $anggota }} [ {{ $npmList[$index] }} ]</li>
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

                                    <td class="text-white">{{ $k->lab->nama_lab }}</td>
                                    <td class="text-center ">
                                        @if ($k->status == 'Pending')
                                            <span class="badge"
                                                style="background-color: #fbbf24; color: #000000">Pending</span>
                                        @elseif($k->status == 'Diterima')
                                            <span class="badge"
                                                style="background-color: #22c55e; color: #ffffff">Diterima</span>
                                        @elseif($k->status == 'Ditolak')
                                            <span class="badge"
                                                style="background-color: #ef4444; color: #ffffff">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-white">
                                        @if ($k->jadwalPresentasi)
                                            <span>{{ $k->jadwalPresentasi->tanggal_presentasi }}</span><br>
                                            <small>{{ $k->jadwalPresentasi->waktu_presentasi }}</small>
                                        @else
                                            <span class="badge bg-secondary">Belum diatur</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($k->nilais->isNotEmpty())
                                            @foreach ($k->nilais as $nilai)
                                                <div>
                                                    <strong style="color: white">Penilai:</strong> 
                                                    <span style="color: white">{{ $nilai->nama_penilai }}</span>
                                                    <br>
                                                    <span class="badge" style="background-color: #22c55e; color: #ffffff">
                                                        {{ $nilai->penilaian_presentasi }}
                                                    </span>
                                                    <span class="badge" style="background-color: #f59e0b; color: #000000">
                                                        {{ $nilai->penilaian_materi }}
                                                    </span>
                                                    <span class="badge" style="background-color: #ef4444; color: #ffffff">
                                                        {{ $nilai->penilaian_diskusi }}
                                                    </span>
                                                    <button class="badge btn-info btn-sm" type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deskripsiModal{{ $nilai->id }}">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                    <hr style="border-color: var(--bs-primary)">
                                                </div>
                                                <!-- Modal Catatan -->
                                                <div class="modal fade" id="deskripsiModal{{ $nilai->id }}"
                                                    tabindex="-1" aria-labelledby="deskripsiModalLabel{{ $nilai->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: var(--bs-primary); color: white">
                                                                <h5 class="modal-title"
                                                                    id="deskripsiModalLabel{{ $nilai->id }}" style="color: white">
                                                                    Catatan Penilaian
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body"
                                                                style="width: 100%; word-wrap: break-word; white-space: pre-wrap;">
                                                                <p>{{ $nilai->catatan ?? 'Tidak ada catatan' }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <span class="badge" style="background-color: #94a3b8; color: #ffffff">Belum
                                                Dinilai</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($k->status == 'Pending')
                                            <!-- Setujui -->
                                            <button type="button" class="btn btn-success btn-sm" title="Setujui"
                                                onclick="approveKelompok('{{ route('admin.approve', $k->id) }}')">
                                                <i class="fas fa-check"></i>
                                            </button>

                                            <!-- Tolak -->
                                            <button type="button" class="btn btn-danger btn-sm" title="Tolak"
                                                onclick="rejectKelompok('{{ route('admin.reject', $k->id) }}')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @elseif ($k->status == 'Diterima' && !$k->selesai)
                                            <!-- Nilai -->
                                            <button class="btn btn-primary btn-sm" title="Nilai" data-bs-toggle="modal"
                                                data-bs-target="#penilaianModal" data-id="{{ $k->id }}"
                                                data-nama="{{ $k->judul_proyek }}">
                                                <i class="fas fa-edit"></i> Nilai
                                            </button>

                                            <!-- Tandai Selesai -->
                                            <button type="button" class="btn btn-warning btn-sm" title="Tandai Selesai"
                                                onclick="selesaiKelompok('{{ route('admin.selesai', $k->id) }}')">
                                                <i class="fas fa-flag"></i> Selesai
                                            </button>
                                        @endif

                                        <!-- Hapus -->
                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus"
                                            onclick="hapusKelompok('{{ route('admin.destroy', $k->id) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Penilaian -->
        <div class="modal fade" id="penilaianModal" tabindex="-1" aria-labelledby="penilaianModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: var(--bs-primary);">
                        <h5 class="modal-title" id="penilaianModalLabel" style="color: white">Penilaian Kelompok</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="penilaianForm" action="" method="POST" onsubmit="return validateForm()">
                            @csrf
                            <input type="hidden" name="kelompok_id" id="kelompok_id" value="">

                            <div class="form-group mb-3">
                                <label for="nama_penilai" style="color: var(--bs-primary); font-weight: 500">Nama Penilai:</label>
                                <input type="text" name="nama_penilai" id="nama_penilai" class="form-control" 
                                    style="color: var(--bs-primary);" placeholder="Masukkan nama penilai" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="penilaian_presentasi" style="color: var(--bs-primary); font-weight: 500">Nilai Presentasi:</label>
                                <input type="number" name="penilaian_presentasi" id="penilaian_presentasi" class="form-control"
                                    style="color: var(--bs-primary);" placeholder="0-100" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="penilaian_materi" style="color: var(--bs-primary); font-weight: 500">Nilai Materi:</label>
                                <input type="number" name="penilaian_materi" id="penilaian_materi" class="form-control"
                                    style="color: var(--bs-primary);" placeholder="0-100" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="penilaian_diskusi" style="color: var(--bs-primary); font-weight: 500">Nilai Diskusi:</label>
                                <input type="number" name="penilaian_diskusi" id="penilaian_diskusi" class="form-control"
                                    style="color: var(--bs-primary);" placeholder="0-100" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="catatan" style="color: var(--bs-primary); font-weight: 500">Catatan:</label>
                                <textarea style="resize: none !important; color: var(--bs-primary);" 
                                    name="catatan" id="catatan" class="form-control" rows="2"
                                    maxlength="200" placeholder="Masukkan catatan (opsional)"></textarea>
                            </div>

                            <button type="submit" class="btn w-100 submit-penilaian-btn" style="background-color: var(--bs-primary); color: white">
                                Simpan Penilaian
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const penilaianModal = document.getElementById('penilaianModal');

            penilaianModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const idKelompok = button.getAttribute('data-id');
                const namaKelompok = button.getAttribute('data-nama');

                console.log(idKelompok, namaKelompok); // Debugging untuk memastikan ID dan Nama terbaca

                // Set nilai input di form
                const form = penilaianModal.querySelector('#penilaianForm');
                form.action = `/admin/storeNilai/${idKelompok}`;
                form.querySelector('#kelompok_id').value = idKelompok;
                form.querySelector('#nama_penilai').value = '';
                form.querySelector('#penilaian_presentasi').value = '';
                form.querySelector('#penilaian_materi').value = '';
                form.querySelector('#penilaian_diskusi').value = '';
                form.querySelector('#catatan').value = '';
            });

            const collapseButtons = document.querySelectorAll('.collapse-btn');
            
            collapseButtons.forEach(button => {
                const icon = button.querySelector('i');
                const targetId = button.getAttribute('data-bs-target');
                const collapseElement = document.querySelector(targetId);
                
                collapseElement.addEventListener('show.bs.collapse', () => {
                    gsap.to(icon, {
                        rotation: 180,
                        duration: 0.3,
                        ease: "back.out(1.7)"
                    });
                });
                
                collapseElement.addEventListener('hide.bs.collapse', () => {
                    gsap.to(icon, {
                        rotation: 0,
                        duration: 0.3,
                        ease: "back.out(1.7)"
                    });
                });
                
                button.addEventListener('mouseenter', () => {
                    gsap.to(icon, {
                        scale: 1.2,
                        opacity: 0.7,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
                
                button.addEventListener('mouseleave', () => {
                    gsap.to(icon, {
                        scale: 1,
                        opacity: 1,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
            });
        });

        function validateForm() {
            const presentasi = parseFloat(document.getElementById('penilaian_presentasi').value);
            const materi = parseFloat(document.getElementById('penilaian_materi').value);
            const diskusi = parseFloat(document.getElementById('penilaian_diskusi').value);
            let valid = true;

            if (presentasi > 100) {
                // Tutup modal sebelum menampilkan SweetAlert
                var modal = bootstrap.Modal.getInstance(document.getElementById('penilaianModal'));
                modal.hide();

                Swal.fire({
                    icon: 'error',
                    title: 'Nilai Presentasi tidak boleh lebih dari 100',
                    text: 'Nilai presentasi telah diatur ke 100.',
                }).then(function() {
                    // Buka kembali modal setelah SweetAlert ditutup
                    modal.show();
                });

                document.getElementById('penilaian_presentasi').value = 100; // Set to max value
                valid = false;
            }

            if (materi > 100) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('penilaianModal'));
                modal.hide();

                Swal.fire({
                    icon: 'error',
                    title: 'Nilai Materi tidak boleh lebih dari 100',
                    text: 'Nilai materi telah diatur ke 100.',
                }).then(function() {
                    modal.show();
                });

                document.getElementById('penilaian_materi').value = 100; // Set to max value
                valid = false;
            }

            if (diskusi > 100) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('penilaianModal'));
                modal.hide();

                Swal.fire({
                    icon: 'error',
                    title: 'Nilai Diskusi tidak boleh lebih dari 100',
                    text: 'Nilai diskusi telah diatur ke 100.',
                }).then(function() {
                    modal.show();
                });

                document.getElementById('penilaian_diskusi').value = 100; // Set to max value
                valid = false;
            }

            return valid; // Allow form submission if valid
        }
    </script>
    <script>
        function approveKelompok(url) {
            Swal.fire({
                title: 'Setujui Pengajuan?',
                text: "Anda tidak bisa mengubah ini setelah disetujui!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form secara otomatis
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    var csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    var method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'PUT';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function rejectKelompok(url) {
            Swal.fire({
                title: 'Tolak Pengajuan?',
                text: "Anda tidak bisa mengubah ini setelah ditolak!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    var csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    var method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'PUT';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function selesaiKelompok(url) {
            Swal.fire({
                title: 'Tandai Selesai?',
                text: "Apakah Anda yakin kelompok ini sudah selesai?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tandai Selesai!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    var csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function hapusKelompok(url) {
            Swal.fire({
                title: 'Hapus Kelompok?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    var csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    var method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

    <style>
        /* Mengubah warna placeholder */
        ::placeholder {
            color: #94a3b8 !important;
            opacity: 0.7;
        }

        /* Mengubah warna input saat focus */
        .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        }

        /* Styling untuk tombol */
        .submit-penilaian-btn {
            transition: .3s;
        }

        .submit-penilaian-btn:hover {
            background-color: var(--bs-primary);
            color: white;
            opacity: 0.7;
        }

        .collapse-btn {
            cursor: pointer;
            border: none;
            background: transparent;
            padding: 5px;
            transition: all 0.3s ease;
        }

        .collapse-btn:active {
            transform: scale(0.95);
        }

        .collapse {
            overflow: hidden;
        }
    </style>

@endsection
