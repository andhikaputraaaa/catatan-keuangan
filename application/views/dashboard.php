<?php $this->load->view('layout/header'); ?>

<h4 class="mb-4">Dashboard</h4>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-coins fa-3x"></i>
                </div>
                <div>
                    <h5 class="card-title">Total Pemasukan</h5>
                    <p class="card-text fs-4">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-shopping-cart fa-3x"></i>
                </div>
                <div>
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <p class="card-text fs-4">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-wallet fa-3x"></i>
                </div>
                <div>
                    <h5 class="card-title">Sisa Saldo</h5>
                    <p class="card-text fs-4">Rp <?= number_format($total_pemasukan - $total_pengeluaran, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<canvas id="chartKeuangan" height="100"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Ambil data grafik dan batasi hanya 12 bulan terakhir
const grafik = <?= json_encode($grafik) ?>;
const grafikTerbatas = grafik.slice(-12); // Ambil 12 bulan terakhir

const ctx = document.getElementById('chartKeuangan').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: grafikTerbatas.map(item => item.bulan), // Ambil label bulan
        datasets: [
            {
                label: 'Pemasukan',
                backgroundColor: 'rgba(40, 167, 69, 0.8)', // Hijau transparan
                borderColor: '#28a745', // Hijau solid
                borderWidth: 2,
                data: grafikTerbatas.map(item => item.pemasukan) // Data pemasukan
            },
            {
                label: 'Pengeluaran',
                backgroundColor: 'rgba(220, 53, 69, 0.8)', // Merah transparan
                borderColor: '#dc3545', // Merah solid
                borderWidth: 2,
                data: grafikTerbatas.map(item => item.pengeluaran) // Data pengeluaran
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Grafik Pemasukan & Pengeluaran (12 Bulan Terakhir)',
                font: {
                    size: 18,
                    weight: 'bold'
                },
                color: '#333' // Warna teks judul
            },
            legend: {
                labels: {
                    font: {
                        size: 14
                    },
                    color: '#555' // Warna teks legenda
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)', // Warna latar belakang tooltip
                titleFont: {
                    size: 14,
                    weight: 'bold'
                },
                bodyFont: {
                    size: 12
                },
                bodyColor: '#fff', // Warna teks tooltip
                borderColor: '#ccc',
                borderWidth: 1
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Bulan',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#333' // Warna teks sumbu X
                },
                ticks: {
                    color: '#555' // Warna label sumbu X
                },
                grid: {
                    color: 'rgba(200, 200, 200, 0.2)' // Warna grid sumbu X
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Jumlah (Rp)',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#333' // Warna teks sumbu Y
                },
                ticks: {
                    color: '#555' // Warna label sumbu Y
                },
                grid: {
                    color: 'rgba(200, 200, 200, 0.2)' // Warna grid sumbu Y
                }
            }
        }
    }
});
</script>

<?php $this->load->view('layout/footer'); ?>
