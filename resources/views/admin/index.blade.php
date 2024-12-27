@extends('layouts.app')
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

        <h1 class="text-center text-white mb-4">Manajemen Pengajuan Presentasi</h1>

        <div class="text-end mb-3">
            <a href="{{ route('admin.jadwalForm') }}" class="btn btn-dark">Kelola Jadwal Presentasi</a>
            {{-- <button type="button" class="btn btn-info ms-2" onclick="openAllJadwalLab()">
            <i class="fas fa-clock"></i> Buka Semua Akses Jadwal
        </button> --}}
        </div>

        <div class="table-responsive">
            <div class="mt-3">
                <strong class="text-white">Legenda Nilai:</strong>
                <ul class="list-inline text-white">
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
                        <th style="color: white !important">Penanggung Jawab</th>
                        <th style="color: white !important">Jadwal Presentasi</th>
                        <th style="color: white !important">Status</th>
                        <th style="color: white !important">Nilai</th>
                        <th style="color: white !important">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($kelompok->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="https://icons.veryicon.com/png/o/business/financial-category/no-data-6.png"
                                    alt="Data Kosong" style="max-width: 300px;">
                                <h5 class="text-white">Data Kosong</h5>
                            </td>
                        </tr>
                    @else
                        @foreach ($kelompok as $k)
                            <tr>
                                <td class="text-white">{{ $k->judul_proyek }}</td>
                                <td class="text-white">
                                    <strong>{{ $k->ketua }} [ {{ $k->npm_ketua }} ]</strong>
                                    <button class="btn btn-link p-0 collapse-btn" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#anggotaCollapse{{ $k->id }}" aria-expanded="false">
                                        <i class="fas fa-chevron-down text-white"></i>
                                    </button>
                                    <div class="collapse mt-2" id="anggotaCollapse{{ $k->id }}">
                                        @if (!empty($k->anggota) && !empty($k->npm_anggota))
                                            @php
                                                $anggotaList = json_decode($k->anggota);
                                                $npmList = json_decode($k->npm_anggota);
                                            @endphp
                                            <ul class="list-unstyled text-white">
                                                @foreach ($anggotaList as $index => $anggota)
                                                    <li>{{ $anggota }} [ {{ $npmList[$index] }} ]</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-white">Tidak ada anggota</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-white">
                                    @if ($k->kelas_id)
                                        {{-- {{ $k->kelas_id->penanggung_jawab }} --}}
                                        <span>{{ $k->kelas->penanggung_jawab }}</span>
                                    @else
                                        <span class="badge bg-secondary">Belum diatur</span>
                                    @endif
                                </td>
                                <td class="text-center text-white">
                                    @if ($k->jadwalPresentasi)
                                        {{ \Carbon\Carbon::parse($k->jadwalPresentasi->tanggal_presentasi)->isoFormat('dddd, D MMMM Y') }}
                                        <br>
                                        <small>
                                            {{ $k->jadwalPresentasi->waktu_presentasi }}
                                        </small>
                                    @else
                                        <span class="badge bg-secondary">Belum diatur</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($k->status == 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($k->status == 'Diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($k->status == 'Ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($k->nilais->isNotEmpty())
                                        @foreach ($k->nilais as $nilai)
                                            <div>
                                                <strong class="text-white">{{ $nilai->nama_penilai }}</strong><br>
                                                <span class="badge bg-success">{{ $nilai->penilaian_presentasi }}</span>
                                                <span
                                                    class="badge bg-warning text-dark">{{ $nilai->penilaian_materi }}</span>
                                                <span class="badge bg-danger">{{ $nilai->penilaian_diskusi }}</span>
                                                <button class="badge btn-info btn-sm" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#deskripsiModal{{ $nilai->id }}">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="badge bg-secondary">Belum Dinilai</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($k->status == 'Pending')
                                        <button type="button" class="btn btn-success btn-sm" title="Setujui"
                                            onclick="approveKelompok('{{ route('admin.approve', $k->id) }}')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" title="Tolak"
                                            onclick="rejectKelompok('{{ route('admin.reject', $k->id) }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @elseif ($k->status == 'Diterima' && !$k->selesai)
                                        @if (!$k->jadwal_lab_opened)
                                            <button type="button" class="btn btn-info btn-sm" title="Buka Akses Jadwal"
                                                onclick="openJadwalLab('{{ route('admin.openJadwalLab', $k->id) }}')">
                                                <i class="fas fa-clock"></i>
                                            </button>
                                        @endif
                                        <button class="btn btn-primary btn-sm" title="Nilai" data-bs-toggle="modal"
                                            data-bs-target="#penilaianModal" data-id="{{ $k->id }}"
                                            data-nama="{{ $k->judul_proyek }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" title="Tandai Selesai"
                                            onclick="selesaiKelompok('{{ route('admin.selesai', $k->id) }}')">
                                            <i class="fas fa-flag"></i>
                                        </button>
                                    @endif
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
                    <h5 class="modal-title text-white" id="penilaianModalLabel">Penilaian Kelompok</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="penilaianForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_penilai" class="form-label">Nama Penilai</label>
                            <input type="text" class="form-control" id="nama_penilai" name="nama_penilai" required>
                        </div>
                        <div class="mb-3">
                            <label for="penilaian_presentasi" class="form-label">Nilai Presentasi (0-100)</label>
                            <input type="number" class="form-control" id="penilaian_presentasi"
                                name="penilaian_presentasi" min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="penilaian_materi" class="form-label">Nilai Materi (0-100)</label>
                            <input type="number" class="form-control" id="penilaian_materi" name="penilaian_materi"
                                min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="penilaian_diskusi" class="form-label">Nilai Diskusi (0-100)</label>
                            <input type="number" class="form-control" id="penilaian_diskusi" name="penilaian_diskusi"
                                min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="submitPenilaian()">Simpan Nilai</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function approveKelompok(url) {
            Swal.fire({
                title: 'Setujui Pengajuan?',
                text: "Anda yakin ingin menyetujui pengajuan ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form untuk submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    // Tambah CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    // Tambah method PUT
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PUT';
                    form.appendChild(methodField);

                    // Tambah form ke body dan submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function rejectKelompok(url) {
            Swal.fire({
                title: 'Tolak Pengajuan?',
                text: "Anda yakin ingin menolak pengajuan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form untuk submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    // Tambah CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    // Tambah method PUT
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PUT';
                    form.appendChild(methodField);

                    // Tambah form ke body dan submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function openJadwalLab(url) {
            Swal.fire({
                title: 'Buka Akses Jadwal?',
                text: "Kelompok akan dapat memilih jadwal dan lab setelah ini",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Buka!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Menggunakan SweetAlert untuk meminta link
                    Swal.fire({
                        title: 'Masukkan Link',
                        input: 'text',
                        inputLabel: 'Link Gmeet untuk kelompok',
                        inputPlaceholder: 'Masukkan link di sini',
                        showCancelButton: true,
                        confirmButtonText: 'Kirim',
                        cancelButtonText: 'Batal',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Anda harus memasukkan link!';
                            }
                        }
                    }).then((inputResult) => {
                        if (inputResult.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = url;

                            const csrf = document.createElement('input');
                            csrf.type = 'hidden';
                            csrf.name = '_token';
                            csrf.value = '{{ csrf_token() }}';
                            form.appendChild(csrf);

                            // Tambahkan input untuk link dari SweetAlert
                            const linkInput = document.createElement('input');
                            linkInput.type = 'hidden';
                            linkInput.name =
                                'link'; // Pastikan nama ini sesuai dengan yang diambil di controller
                            linkInput.value = inputResult.value; // Mengambil nilai dari input SweetAlert
                            form.appendChild(linkInput);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
            });
        }

        function selesaiKelompok(url) {
            Swal.fire({
                title: 'Tandai Selesai?',
                text: "Anda yakin ingin menandai kelompok ini selesai?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesai!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const csrf = document.createElement('input');
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
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function openAllJadwalLab() {
            Swal.fire({
                title: 'Buka Semua Akses Jadwal?',
                text: "Semua kelompok yang diterima akan dapat memilih jadwal dan lab",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Buka Semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('admin.openAllJadwalLab') }}';

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Script untuk modal penilaian
        let kelompokId = null;

        document.addEventListener('DOMContentLoaded', function() {
            const penilaianModal = document.getElementById('penilaianModal');
            if (penilaianModal) {
                penilaianModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    kelompokId = button.getAttribute('data-id');
                    const kelompokNama = button.getAttribute('data-nama');

                    const modalTitle = penilaianModal.querySelector('.modal-title');
                    modalTitle.textContent = 'Penilaian: ' + kelompokNama;

                    // Reset form
                    document.getElementById('penilaianForm').reset();
                });
            }
        });

        function submitPenilaian() {
            if (!kelompokId) return;

            const form = document.getElementById('penilaianForm');
            const formData = new FormData(form);

            // Validasi nilai
            const presentasi = parseInt(formData.get('penilaian_presentasi'));
            const materi = parseInt(formData.get('penilaian_materi'));
            const diskusi = parseInt(formData.get('penilaian_diskusi'));

            if (presentasi > 100 || materi > 100 || diskusi > 100) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Nilai tidak boleh lebih dari 100'
                });
                return;
            }

            // Submit nilai
            fetch(`/admin/storeNilai/${kelompokId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Nilai berhasil disimpan',
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Terjadi kesalahan'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan nilai'
                    });
                });

            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('penilaianModal'));
            modal.hide();
        }
    </script>

@endsection
