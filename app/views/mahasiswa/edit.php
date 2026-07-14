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

    <h1>Edit Data Mahasiswa</h1>
    
    <?php $this->flash(); ?>

    <form action="<?= BASEURL; ?>/mahasiswa/update/<?= $data['mhs']['id']; ?>" method="POST">
        <div class="form-group">
            <label>NPM</label>
            <input type="text" name="npm" required value="<?= $data['mhs']['npm']; ?>">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" required value="<?= $data['mhs']['nama_lengkap']; ?>">
        </div>
        <div class="form-group">
            <label>Fakultas</label>
            <input type="text" name="fakultas" required value="<?= $data['mhs']['fakultas']; ?>">
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" required>
                <option value="Teknik Informatika" <?= ($data['mhs']['jurusan'] == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                <option value="Sistem Informasi" <?= ($data['mhs']['jurusan'] == 'Sistem Informasi') ? 'selected' : ''; ?>>Sistem Informasi</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" required value="<?= $data['mhs']['tempat_lahir']; ?>">
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" required value="<?= $data['mhs']['tanggal_lahir']; ?>">
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= ($data['mhs']['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki
            <input type="radio" name="jenis_kelamin" value="Perempuan" <?= ($data['mhs']['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan
        </div>
        
        <button type="submit" class="btn" style="background-color: #ffc107; color: black; font-weight: bold;">Simpan Perubahan</button>
        <a href="<?= BASEURL; ?>/mahasiswa" class="btn btn-secondary">Batal</a>
    </form>

</body>
</html>

