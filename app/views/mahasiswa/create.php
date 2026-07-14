<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul']; ?></title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="date"], select { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px; }
        .btn-secondary { background-color: #6c757d; text-decoration: none; display: inline-block; text-align: center; }
    </style>
</head>
<body style="padding: 20px; font-family: Arial, sans-serif;">

    <h1>Tambah Data Mahasiswa</h1>
    
    <?php $this->flash(); ?>

    <form action="<?= BASEURL; ?>/mahasiswa/store" method="POST">
        <div class="form-group">
            <label>NPM</label>
            <input type="text" name="npm" required placeholder="Masukkan NPM">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" required placeholder="Masukkan Nama Lengkap">
        </div>
        <div class="form-group">
            <label>Fakultas</label>
            <input type="text" name="fakultas" required value="Teknologi Informasi">
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" required>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" required placeholder="Masukkan Tempat Lahir">
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" required>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <input type="radio" name="jenis_kelamin" value="Laki-laki" checked> Laki-laki
            <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
        </div>
        
        <button type="submit" class="btn">Simpan Data</button>
        <a href="<?= BASEURL; ?>/mahasiswa" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>