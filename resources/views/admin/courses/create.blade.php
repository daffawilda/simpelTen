<div>
    <div class="container">
        <h1>Tambah Course</h1>
    
        <!-- Tampilkan pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <!-- Form tambah course -->
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Course</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>