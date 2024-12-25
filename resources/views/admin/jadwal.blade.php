@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header" style="background-color: #09191F;">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-calendar-plus me-2"></i>
                        Tambah Jadwal Presentasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.storeJadwal') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-1"></i> Tanggal Presentasi
                                </label>
                                <input type="date" name="tanggal_presentasi" class="form-control custom-input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-clock me-1"></i> Waktu Presentasi
                                </label>
                                <input type="time" name="waktu_presentasi" class="form-control custom-input" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="submit" class="submit-button">
                                <i class="fas fa-save me-2"></i>
                                Simpan Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #09191F;">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-list me-2"></i>
                        Daftar Jadwal Presentasi
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th class="px-4 py-3">Tanggal Presentasi</th>
                                    <th class="px-4 py-3">Waktu Presentasi</th>
                                    <th class="px-4 py-3 text-center" width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($jadwals->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            <img src="https://icons.veryicon.com/png/o/business/financial-category/no-data-6.png"
                                                alt="Data Kosong" style="max-width: 200px; opacity: 0.5">
                                            <p class="text-muted mt-2 mb-0">Belum ada jadwal presentasi</p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($jadwals as $jadwal)
                                        <tr>
                                            <td class="px-4 py-3">{{ $jadwal->tanggal_presentasi }}</td>
                                            <td class="px-4 py-3">{{ $jadwal->waktu_presentasi }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <form action="{{ route('admin.destroyJadwal', $jadwal->id) }}" method="POST"
                                                    class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
</div>

<style>
/* Button Styles */
.back-button {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    background-color: #09191F;
    color: #fff;
    border: 1.5px solid #09191F;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease;
    font-size: 0.95rem;
}

.back-button:hover {
    background-color: transparent;
    color: #09191F;
    transform: translateX(-5px);
}

.back-button i {
    margin-right: 8px;
}

.submit-button {
    padding: 8px 20px;
    background-color: #09191F;
    color: #fff;
    border: 1.5px solid #09191F;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
}

.submit-button:hover {
    background-color: transparent;
    color: #09191F;
    transform: translateY(-2px);
}

/* Form Styles */
.form-label {
    font-weight: 500;
    color: #333;
    font-size: 0.95rem;
}

.custom-input {
    border: 1.5px solid #e2e8f0;
    border-radius: 6px;
    padding: 8px 12px;
    transition: all 0.2s ease;
}

.custom-input:hover {
    border-color: #09191F;
}

.custom-input:focus {
    outline: none;
    border-color: #09191F;
    box-shadow: 0 0 0 3px rgba(9, 25, 31, 0.1);
}

/* Table Styles */
.table {
    margin-bottom: 0;
}

.table th {
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #e2e8f0;
}

.table td {
    vertical-align: middle;
    color: #444;
    border-bottom: 1px solid #e2e8f0;
}

/* Delete Button */
.delete-btn {
    padding: 6px 10px;
    background-color: #dc3545;
    color: white;
    border: 1.5px solid #dc3545;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.delete-btn:hover {
    background-color: transparent;
    color: #dc3545;
}

/* Card Styles */
.card {
    border: none;
    border-radius: 8px;
    overflow: hidden;
}

.card-header {
    padding: 15px 20px;
    border-bottom: none;
}

/* Responsive */
@media (max-width: 768px) {
    .col-md-8 {
        padding: 0 15px;
    }
    
    .container {
        margin-top: 1rem;
    }
}
</style>

<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const form = this.closest('.delete-form');
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endsection
