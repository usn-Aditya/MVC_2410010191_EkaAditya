<div class="container-fluid px-4 mt-4">
        <div class="card mb-3 shadow-light" style="background-color:rgb(126, 216, 251);">   
            <div class="row g-5">
                <div class="col-md-8">
                    <div class="card-body p-4">
                        <h1 class="card-title">Selamat Datang di</h1>
                        <h1>Aplikasi MVC Mahasiswa</h1>
                        <p>Kelola Data Mahasiswa Dengan Mudah</p>
                    </div>
                    <div>
                        <a href="<?= BASEURL; ?>/mahasiswa/create" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold ms-4">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Mahasiswa
                        </a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <img src="<?= BASEURL; ?>/img/homecard.png" class="img-fluid rounded-start" alt="Home Card">
                </div>
            </div>
        </div>
</div>

<div class="container mt-4">
    <div class="row g-4">
        <div class=" col-md-6 col-lg-3">
            <div class="card p-0 bg-white border-shadow">
                <div class="card-body">
                    <h6 class="text-secondary fw-semibold">TOTAL MAHASIWA</h6>
                    <h1><?= $data['statistik']['total']; ?> </h1>
                    <h6 class="text-secondary">Status Aktif</h6>
                </div>
            </div>
        </div>

        <div class=" col-md-6 col-lg-3">
            <div class="card p-0 bg-white border-shadow">
                <div class="card-body">
                    <h6 class="text-secondary fw-semibold">LAKI-LAKI</h6>
                    <h1><?= $data['statistik']['laki_laki']; ?> </h1>
                    <h6 class="text-secondary">Status Aktif</h6>
                </div>
            </div>
        </div>

        <div class=" col-md-6 col-lg-3">
            <div class="card p-0 bg-white border-shadow">
                <div class="card-body">
                    <h6 class="text-secondary fw-semibold">PEREMPUAN</h6>
                    <h1><?= $data['statistik']['perempuan']; ?> </h1>
                    <h6 class="text-secondary">Status Aktif</h6>
                </div>
            </div>
        </div>

        <div class=" col-md-6 col-lg-3">
            <div class="card p-0 bg-white border-shadow">
                <div class="card-body">
                    <h6 class="text-secondary fw-semibold">STATUS AKTIF</h6>
                    <h1><?= $data['statistik']['aktif']; ?> </h1>
                    <h6 class="text-secondary">Status Aktif</h6>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Load Chart.js dari CDN Resmi -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row mt-4">
    <div class="col-md-6 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold"><i class="bi bi-pie-chart-fill me-2"></i>Grafik Statistik Mahasiswa</h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="position: relative; height:300px; width:100%">
                    <canvas id="statistikChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


  <?php
// Tidak perlu pakai foreach lagi, langsung petakan saja datanya
$labels = ['Total Mahasiswa', 'Laki-Laki', 'Perempuan', 'Status Aktif'];
$counts = [
    $data['statistik']['total'] ?? 0,
    $data['statistik']['laki_laki'] ?? 0,
    $data['statistik']['perempuan'] ?? 0,
    $data['statistik']['aktif'] ?? 0
];
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Konversi array PHP ke JSON agar bisa dibaca JavaScript
    const dataLabels = <?php echo json_encode($labels); ?>;
    const dataCounts = <?php echo json_encode($counts); ?>;

    const ctx = document.getElementById('statistikChart').getContext('2d');
    const statistikChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: dataLabels,
            datasets: [{
                data: dataCounts,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'
                ],
                hoverBackgroundColor: [
                    '#2e59d9', '#17a673', '#2c9faf', '#dfa12d', '#be2617', '#717384'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 15,
                        padding: 20
                    }
                }
            }
        }
    });
});
</script>