@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Buat Pengajuan</h1>

        <form id="submissionForm" class="p-4 bg-light border rounded col-md-8 mx-auto" action="{{ route('mahasiswa.store') }}"
            method="POST">
            @csrf
            <!-- Judul Proyek -->
            <div class="mb-3">
                <label for="judul_proyek" class="form-label">Judul Proyek</label>
                <input type="text" class="form-control" id="judul_proyek" name="judul_proyek" placeholder="Judul Proyek"
                    required>
            </div>

            <!-- Ketua dan NPM Ketua  -->
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="ketua" class="form-label">Ketua Kelompok</label>
                    <input type="text" class="form-control" id="ketua" name="ketua" placeholder="Ketua Kelompok"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="npm_ketua" class="form-label">NPM Ketua</label>
                    <div class="input-group">
                        <span class="input-group-text">0</span>
                        <input type="number" class="form-control" id="npm_ketua" name="npm_ketua" placeholder="651***"
                            min="0" inputmode="numeric" pattern="[0-9]*" required>
                    </div>
                </div>
            </div>

            <!-- Anggota Kelompok -->
            <div class="mb-3">
                <label for="anggotaContainer" class="form-label">Anggota Kelompok</label>
                <div id="anggotaContainer">
                    <div class="d-flex">
                        <input type="text" class="form-control mb-2 me-2" name="anggota[]" placeholder="Anggota 1">
                        <div class="input-group mb-2">
                            <span class="input-group-text">0</span>
                            <input type="number" class="form-control" name="npm_anggota[]" placeholder="651***"
                                min="0" inputmode="numeric" pattern="[0-9]*">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-primary" onclick="addAnggota()">Tambah Anggota</button>
            </div>
            <div class="mb-3">
                <label for="labSelect" class="form-label">Pilih Lab</label>
                <select id="labSelect" name="lab_id" class="form-select">
                    @foreach ($labs as $lab)
                        <option value="{{ $lab->id }}">{{ $lab->nama_lab }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Kelas -->
            <div class="mb-3">
                <label for="kelas_id" class="form-label">Pilih Kelas</label>
                <select id="kelas_id" name="kelas_id" class="form-select" required>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jadwal_presentasi_id" class="form-label">Pilih Jadwal Presentasi</label>
                <select id="jadwal_presentasi_id" name="jadwal_presentasi_id" class="form-select" required>
                    <option value="">Pilih Jadwal</option>
                    @foreach ($jadwal as $j)
                        @php
                            // Cek apakah jadwal ini sudah digunakan oleh kelompok lain di lab yang sama
                            $isDisabled = false;
                            foreach ($kelompoks as $kelompok) {
                                if ($kelompok->jadwal_presentasi_id == $j->id && $kelompok->lab == old('lab_id')) {
                                    $isDisabled = true;
                                    break;
                                }
                            }
                        @endphp
                        <option value="{{ $j->id }}" {{ $isDisabled ? 'disabled' : '' }}>
                            {{ $j->tanggal_presentasi }} - {{ $j->waktu_presentasi }}
                            {{ $isDisabled ? '(Sudah Diambil)' : '' }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitBtn" class="btn btn-primary w-100" disabled>Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jadwalSelect = document.getElementById('jadwal_presentasi_id');
            const labSelect = document.querySelector('select[name="lab_id"]');

            function updateJadwalOptions() {
                const selectedLab = labSelect.value;

                // Data jadwal yang sudah digunakan dari controller
                const isUsed = @json($usedJadwalIds);

                // Ambil semua opsi dari jadwal select
                const options = jadwalSelect.querySelectorAll('option');

                options.forEach(option => {
                    option.disabled = false; // Reset status disabled

                    if (option.value) {
                        // Cek apakah jadwal ini sudah digunakan di lab yang sama
                        const used = isUsed.some(kelompok => kelompok.lab_id == selectedLab && kelompok
                            .jadwal_id == option.value);

                        // Disable opsi jika sudah digunakan di lab yang sama
                        if (used) {
                            option.disabled = true;
                        }
                    }
                });

                // Refresh jadwal select agar perubahan terlihat
                jadwalSelect.selectedIndex = 0;
            }

            // Event listener untuk saat Lab dipilih ulang
            labSelect.addEventListener('change', updateJadwalOptions);

            // Panggil fungsi untuk memperbarui opsi ketika halaman dimuat
            updateJadwalOptions();
        });
    </script>

    <script>
        function addAnggota() {
            const anggotaContainer = document.getElementById('anggotaContainer');
            const anggotaInputs = document.querySelectorAll('input[name="anggota[]"]');

            if (anggotaInputs.length >= 4) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Maksimal 4 Anggota',
                    text: 'Maksimal hanya 4 anggota yang diperbolehkan.',
                });
                return;
            }

            let valid = true;
            anggotaInputs.forEach(input => {
                if (input.value.trim() === '') {
                    valid = false;
                }
            });

            if (!valid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Input Tidak Valid',
                    text: 'Silakan isi semua anggota sebelum menambah anggota baru.',
                });
                return;
            }

            const div = document.createElement('div');
            div.classList.add('d-flex', 'mb-2');

            const inputAnggota = document.createElement('input');
            inputAnggota.type = 'text';
            inputAnggota.name = 'anggota[]';
            inputAnggota.classList.add('form-control', 'me-2');
            inputAnggota.placeholder = 'Anggota ' + (anggotaInputs.length + 1);

            const inputNpmAnggota = document.createElement('div');
            inputNpmAnggota.classList.add('input-group');
            inputNpmAnggota.innerHTML = `
                <span class="input-group-text">0</span>
                <input type="number" class="form-control" name="npm_anggota[]" placeholder="651***" min="0" inputmode="numeric" pattern="[0-9]*">
            `;

            div.appendChild(inputAnggota);
            div.appendChild(inputNpmAnggota);
            anggotaContainer.appendChild(div);

            validateForm(); // Panggil fungsi validasi setiap kali ada perubahan
        }

        // Fungsi untuk memeriksa validasi form
        function validateForm() {
            const form = document.getElementById('submissionForm');
            const submitBtn = document.getElementById('submitBtn');
            const inputs = form.querySelectorAll('input, select');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                }
            });

            submitBtn.disabled = !isValid;
        }

        // Panggil fungsi validasi saat ada perubahan di input
        document.querySelectorAll('#submissionForm input, #submissionForm select').forEach(input => {
            input.addEventListener('input', validateForm);
        });

        // Validasi ketika form disubmit
        document.getElementById('submissionForm').onsubmit = function(e) {
            e.preventDefault();
            const anggotaInputs = document.querySelectorAll('input[name="anggota[]"]');
            let valid = false;

            anggotaInputs.forEach(input => {
                if (input.value.trim() !== '') {
                    valid = true;
                }
            });

            if (!valid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Form Tidak Lengkap',
                    text: 'Setidaknya satu anggota harus diisi.',
                });
                return false;
            }

            this.submit();
        };

        // Panggil validasi saat halaman dimuat
        validateForm();
    </script>
@endsection
