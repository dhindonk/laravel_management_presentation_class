@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-start mb-4">
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <h1 class="text-center mb-4">Tambah Jadwal Presentasi</h1>

        <form action="{{ route('admin.storeJadwal') }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="tanggal_presentasi">Tanggal Presentasi:</label>
                <input type="date" name="tanggal_presentasi" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="waktu_presentasi">Waktu Presentasi:</label>
                <input type="time" name="waktu_presentasi" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </div>
        </form>

        <h2 class="text-center mb-4">Daftar Jadwal Presentasi</h2>

        <div class="table-responsive" style="border-radius: 15px">
            <table class="table table-bordered table-hover">
                <thead class="bg-dark text-white text-center">
                    <tr>
                        <th>Tanggal Presentasi</th>
                        <th>Waktu Presentasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($jadwals->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">
                                <img src="https://icons.veryicon.com/png/o/business/financial-category/no-data-6.png"
                                    alt="Data Kosong" style="max-width: 300px;">
                                <h5>Data Kosong</h5>
                            </td>
                        </tr>
                    @else
                        @foreach ($jadwals as $jadwal)
                            <tr>
                                <td class="text-center">{{ $jadwal->tanggal_presentasi }}</td>
                                <td class="text-center">{{ $jadwal->waktu_presentasi }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.destroyJadwal', $jadwal->id) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" title="Hapus">
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

    <script>
        // SweetAlert konfirmasi hapus
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim form jika konfirmasi
                    }
                });
            });
        });
    </script>
@endsection
