@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="container mt-5">
        <div class="text-end">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger" style="opacity: 50%">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>

        <h1 class="text-center mb-4">Manajemen Pengajuan Presentasi</h1>

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


            <table class="table table-bordered table-hover">
                <thead class=" text-white text-center" style="background: #7a1010">
                    <tr>
                        <th style="color: white !important; border-radius: 15px 0 0 0">Judul Proyek</th>
                        <th style="color: white !important">Ketua & Anggota</th>
                        <th style="color: white !important">Lab</th>
                        <th style="color: white !important">Status</th>
                        <th style="color: white !important">Jadwal Presentasi</th>
                        <th style="color: white !important">Nilai</th>
                        <th style="color: white !important; border-radius: 0 15px 0 0">Aksi</th>
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
                                <td>{{ $k->judul_proyek }}</td>
                                <td>
                                    <strong>{{ $k->ketua }} [ {{ $k->npm_ketua }} ]</strong>

                                    <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#anggotaCollapse{{ $k->id }}" aria-expanded="false"
                                        aria-controls="anggotaCollapse{{ $k->id }}">
                                        <i id="iconArrow{{ $k->id }}" class="fas fa-chevron-down"
                                            style="color: #9f10b5"></i>
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

                                <td>{{ $k->lab->nama_lab }}</td>
                                <td class="text-center">
                                    @if ($k->status == 'Pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($k->status == 'Diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($k->status == 'Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
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
                                                <strong>Penilai:</strong> {{ $nilai->nama_penilai }} <br>
                                                <span class="badge" style="background-color: #28a745">
                                                    {{ $nilai->penilaian_presentasi }}
                                                </span>
                                                <span class="badge" style="background-color: #e4af10">
                                                    {{ $nilai->penilaian_materi }}
                                                </span>
                                                <span class="badge" style="background-color: #dc3545">
                                                    {{ $nilai->penilaian_diskusi }}
                                                </span>
                                                <button class="badge btn-info btn-sm" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#deskripsiModal{{ $nilai->id }}">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                <hr>
                                            </div>
                                            <!-- Modal Catatan -->
                                            <div class="modal fade" id="deskripsiModal{{ $nilai->id }}" tabindex="-1"
                                                aria-labelledby="deskripsiModalLabel{{ $nilai->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <!-- Menambahkan modal-lg untuk ukuran yang lebih besar -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deskripsiModalLabel{{ $nilai->id }}">Catatan
                                                                Penilaian</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
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
                                        <span class="badge bg-secondary">Belum Dinilai</span>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="penilaianModalLabel">Penilaian Kelompok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="penilaianForm" action="" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <input type="hidden" name="kelompok_id" id="kelompok_id" value="">

                        <div class="form-group mb-3">
                            <label for="nama_penilai">Nama Penilai:</label>
                            <input type="text" name="nama_penilai" id="nama_penilai" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="penilaian_presentasi">Nilai Presentasi:</label>
                            <input type="number" name="penilaian_presentasi" id="penilaian_presentasi"
                                class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="penilaian_materi">Nilai Materi:</label>
                            <input type="number" name="penilaian_materi" id="penilaian_materi" class="form-control"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="penilaian_diskusi">Nilai Diskusi:</label>
                            <input type="number" name="penilaian_diskusi" id="penilaian_diskusi" class="form-control"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="catatan">Catatan:</label>
                            <textarea style="resize: none !important" name="catatan" id="catatan" class="form-control" rows="2"
                                maxlength="200"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan Penilaian</button>
                    </form>
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

@endsection
