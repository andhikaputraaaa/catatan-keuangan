<?php $this->load->view('layout/header'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Transaksi</h4>
    <a href="<?= site_url('transaksi/create') ?>" class="btn btn-hijau">+ Tambah Transaksi</a>
</div>

<!-- Filter Form -->
<div class="card mb-3">
    <div class="card-body">
        <form method="get" action="<?= site_url('transaksi') ?>">
            <div class="row">
                <div class="col-md-4">
                    <label for="kategori" class="form-label">Filter Kategori</label>
                    <select name="kategori" id="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                            <option value="<?= $kat->id ?>" <?= isset($_GET['kategori']) && $_GET['kategori'] == $kat->id ? 'selected' : '' ?>>
                                <?= $kat->nama_kategori ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?= isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '' ?>">
                </div>
                <div class="col-md-4">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?= isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : '' ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-secondary me-2">Filter</button>
                    <a href="<?= site_url('transaksi') ?>" class="btn btn-light">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show"><?= $this->session->flashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabelTransaksi" class="table table-striped table-bordered mb-0">
                <thead class="table-success">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $row): ?>
                    <tr>
                        <td><?= $row->tanggal ?></td>
                        <td><?= $row->nama_kategori ?></td>
                        <td>Rp<?= number_format($row->jumlah, 0, ',', '.') ?></td>
                        <td>
                            <span class="badge <?= $row->tipe === 'pemasukan' ? 'bg-success' : 'bg-danger' ?>">
                                <?= ucfirst($row->tipe) ?>
                            </span>
                        </td>
                        <td><?= $row->deskripsi ?></td>
                        <td>
                            <a href="<?= site_url('transaksi/edit/'.$row->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= site_url('transaksi/delete/'.$row->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#tabelTransaksi').DataTable({
        paging: true,
        searching: false,
        ordering: false,
        info: false,
        language: {
            paginate: {
                previous: "<<",
                next: ">>"
            },
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data tersedia"
        },
        drawCallback: function () {
            $('.dataTables_paginate .pagination').addClass('justify-content-end');
            // Panggil fungsi styling di sini, setiap kali table di-draw
            applyCustomPaginationStyle();
        },
        // Tambahkan initComplete callback untuk mengatasi inisialisasi pertama kali
        initComplete: function() {
            applyCustomPaginationStyle();
        }
    });

    function applyCustomPaginationStyle() {
        // Hapus timeout dan langsung terapkan style
        // Default style (putih)
        $('.dataTables_paginate .paginate_button, .dataTables_paginate .page-link').css({
            'background-color': 'white',
            'color': '#198754',
            'border-color': '#dee2e6',
            'outline': 'none'
        });
        
        // Style untuk state active/current (hijau)
        $('.dataTables_paginate .paginate_button.current, .dataTables_paginate .page-item.active .page-link').css({
            'background-color': '#198754',
            'color': 'white',
            'border-color': '#198754',
            'border-radius': '0.25rem',
            'outline': 'none'
        });
        
        // Tambahkan hover effect menggunakan event handler
        $('.dataTables_paginate .paginate_button, .dataTables_paginate .page-link').hover(
            function() {
                // Hover in - ubah ke hijau
                $(this).css({
                    'background-color': '#198754',
                    'color': 'white',
                    'border-color': '#198754',
                    'border-radius': '0.25rem'
                });
            },
            function() {
                // Hover out - kembalikan ke putih kecuali untuk yang active
                if(!$(this).hasClass('current') && !$(this).parent().hasClass('active')) {
                    $(this).css({
                        'background-color': 'white',
                        'color': '#198754',
                        'border-color': '#dee2e6',
                        'border-radius': '0.25rem'
                    });
                }
            }
        );
        
        // Tambahkan CSS untuk menangani fokus (ketika diklik) - dengan prioritas tinggi
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                .dataTables_paginate .paginate_button:focus,
                .dataTables_paginate .page-link:focus,
                .dataTables_paginate .paginate_button:active,
                .dataTables_paginate .page-link:active {
                    background-color: #198754 !important;
                    color: white !important;
                    border-color: #198754 !important;
                    outline: none !important;
                    box-shadow: none !important;
                }
            `)
            .appendTo('head');
            
        // Reset focus handler dengan prioritas tinggi
        $('.dataTables_paginate .paginate_button, .dataTables_paginate .page-link').on('focus mousedown mouseup', function() {
            $(this).css({
                'background-color': '#198754',
                'color': 'white',
                'border-color': '#198754',
                'box-shadow': 'none'
            });
        });
        
        // Reset semua styling Bootstrap yang mungkin mengganggu
        $('.page-link').css('box-shadow', 'none');
    }
    
    // Tambahkan juga listener untuk MutationObserver untuk mendeteksi perubahan DOM
    var observer = new MutationObserver(function() {
        applyCustomPaginationStyle();
    });
    
    // Mulai observasi pada elemen yang mengandung pagination
    observer.observe(document.querySelector('.dataTables_wrapper'), {
        childList: true,
        subtree: true
    });
});
</script>



<?php $this->load->view('layout/footer'); ?>