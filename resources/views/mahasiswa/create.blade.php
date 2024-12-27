@extends('layouts.app')
{{-- isi yield style --}}
@section('style')
    <style>
        .text-gradient {
            color: white !important;
        }
    </style>
@endsection

@section('content')
    <!-- Pastikan library GSAP sudah dimuat -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <div class="container mt-5">
        <div class="title-container text-center mb-5">
            <h1 class="title-animation">
                <span class="line-wrapper">
                    <span class="line text-gradient">Buat</span>
                </span>
                <span class="line-wrapper">
                    <span class="line text-gradient">Pengajuan</span>
                </span>
            </h1>
            <div class="title-underline"></div>
        </div>

        {{-- rounded 10px --}}
        <form id="submissionForm" style="border-radius: 15px !important" class="p-4 bg-light border rounded col-md-8 mx-auto" action="{{ route('mahasiswa.store') }}"
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

            <!-- Pilih Kelas -->
            <div class="mb-3">
                <label for="kelas_id" class="form-label">Pilih Kelas</label>
                <select id="kelas_id" name="kelas_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" data-penanggung-jawab="{{ $k->penanggung_jawab }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Penanggung Jawab -->
            <div class="mb-3">
                <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                <input type="text" id="penanggung_jawab" name="penanggung_jawab" class="form-control" readonly>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const kelasSelect = document.getElementById('kelas_id');
                    const penanggungJawabInput = document.getElementById('penanggung_jawab');

                    kelasSelect.addEventListener('change', function() {
                        const selectedOption = kelasSelect.options[kelasSelect.selectedIndex];
                        penanggungJawabInput.value = selectedOption.getAttribute('data-penanggung-jawab');
                    });
                });
            </script>

            <!-- Submit Button -->
            <button type="submit" id="submitBtn" class="btn w-100 position-relative overflow-hidden submit-btn">
                <span class="submit-text">Submit</span>
            </button>
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
            let isValid = true;

            // Cek input wajib (required fields)
            const requiredInputs = form.querySelectorAll('input[required], select[required]');
            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                }
            });

            // Anggota adalah opsional, jadi tidak perlu divalidasi
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Register ScrollTrigger plugin
            gsap.registerPlugin(ScrollTrigger);

            // Split text into characters
            const lines = document.querySelectorAll('.line');
            lines.forEach(line => {
                const text = line.textContent;
                line.textContent = '';
                [...text].forEach(char => {
                    const span = document.createElement('span');
                    span.textContent = char;
                    span.style.display = 'inline-block';
                    span.style.transform = 'translateY(100%) rotateX(-90deg)';
                    span.style.opacity = '0';
                    line.appendChild(span);
                });
            });

            // Initial animation
            const tl = gsap.timeline();

            lines.forEach((line, lineIndex) => {
                const chars = line.querySelectorAll('span');
                tl.to(chars, {
                    y: 0,
                    rotateX: 0,
                    opacity: 1,
                    duration: 0.8,
                    stagger: 0.03,
                    ease: "back.out(1.7)",
                    delay: lineIndex * 0.2
                });
            });

            tl.to('.title-underline', {
                width: '80px',
                duration: 0.8,
                ease: "power2.out"
            }, '-=0.5');

            // Hover animation
            const title = document.querySelector('.title-animation');

            title.addEventListener('mouseenter', () => {
                const chars = title.querySelectorAll('span');
                gsap.to(chars, {
                    y: () => gsap.utils.random(-15, 15),
                    rotationZ: () => gsap.utils.random(-15, 15),
                    duration: 0.4,
                    ease: "power2.out",
                    stagger: {
                        amount: 0.3,
                        from: "random"
                    }
                });
            });

            title.addEventListener('mouseleave', () => {
                const chars = title.querySelectorAll('span');
                gsap.to(chars, {
                    y: 0,
                    rotationZ: 0,
                    duration: 0.4,
                    ease: "power2.out",
                    stagger: {
                        amount: 0.3,
                        from: "random"
                    }
                });
            });
        });
    </script>

    <style>
        .submit-btn {
            background: #09191F;
            border: none;
            color: white;
            padding: 12px 24px;
            transition: all 0.3s ease;
        }

        .submit-btn:hover:not(:disabled) {
            background: #efefef;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(9, 25, 31, 0.3);
        }

        .submit-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .submit-btn:active:not(:disabled) {
            transform: translateY(0);
            background: #061216;
        }

        .submit-text {
            position: relative;
            z-index: 1;
        }
    </style>
@endsection
