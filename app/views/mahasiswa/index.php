<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $data['judul']; ?></title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn-tambah { padding: 8px 12px; background-color:rgb(0, 110, 255); color: white; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 10px; }
    </style>
</head>
<body style="padding: 20px; font-family: Arial, sans-serif;">

    <h1 class="mt-4 fw-bold">
        <i class="bi bi-clipboard2-data text-primary "></i>Daftar Mahasiswa
    </h1>
    <p class="ms-1">Data Seluruh Mahasiswa</p>
    
    <?php $this->flash(); ?>
    
    <form action="<?= BASEURL; ?>/mahasiswa" method="GET" style="margin-bottom: 20px; background-color: #f8f9fa; padding: 15px; border-radius: 4px; border: 1px solid #e3e6f0;">
        <input type="text" name="search" placeholder="Cari NPM atau Nama..." value="<?= isset($data['search_value']) ? $data['search_value'] : ''; ?>" style="padding: 3px 10px; width: 230px; margin-right: 10px;">
        
        <select name="jurusan" style="padding: 6px 10px; margin-right: 10px;">
            <option value="">-- Semua Jurusan --</option>
            <option value="Teknik Informatika" <?= (isset($data['jurusan_value']) && $data['jurusan_value'] == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
            <option value="Sistem Informasi" <?= (isset($data['jurusan_value']) && $data['jurusan_value'] == 'Sistem Informasi') ? 'selected' : ''; ?>>Sistem Informasi</option>
        </select>
        
        <button type="submit" style="padding: 6px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Cari</button>
        
        <a href="<?= BASEURL; ?>/mahasiswa" style="padding: 6px 15px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px; margin-left: 5px; display: inline-block;">Reset</a>
    </form>

    <div class="mt-5">
        <div class="row mb-3">
            <div class="col-md-6 d-flex gap-2">
                <a href="<?= BASEURL; ?>/mahasiswa/create" class="btn btn-primary">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Mahasiswa
                </a>
                <!-- Tombol Cetak PDF -->
                <a href="<?= BASEURL; ?>/mahasiswa/exportPdf" target="_blank" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF
                </a>
            </div>
        </div>
    </div>


    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered table-hover align-middle bg-white m-0">
            <thead class="table-primary"">
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama Lengkap</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['mhs'])): ?>
                    <tr>
                        <td colspan="10" class="text-center text-muted py-3">Data mahasiswa tidak ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach($data['mhs'] as $mhs) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong><?= $mhs['npm']; ?></strong></td>
                        <td><?= $mhs['nama_lengkap']; ?></td>
                        <td><?= $mhs['fakultas']; ?></td>
                        <td><?= $mhs['jurusan']; ?></td>
                        <td><?= $mhs['tempat_lahir']; ?></td>
                        <td><?= $mhs['tanggal_lahir']; ?></td>
                        <td><?= $mhs['jenis_kelamin']; ?></td>
                        <td>
                            <span class="badge bg-<?= ($mhs['status_id'] == 1) ? 'success' : 'danger'; ?>">
                                <?= ($mhs['status_id'] == 1) ? 'Aktif' : 'Nonaktif'; ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?= BASEURL; ?>/mahasiswa/edit/<?= $mhs['id']; ?>" class="btn btn-warning " title="Edit Data">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= BASEURL; ?>/mahasiswa/delete/<?= $mhs['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-danger" title="Hapus Data" >
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>