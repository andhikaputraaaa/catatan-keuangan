<?php $this->load->view('layout/header'); ?>

<h4 class="mb-3">Tambah Transaksi</h4>

<form method="post" action="<?= site_url('transaksi/create') ?>">
    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat->id ?>"><?= $kat->nama_kategori ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipe Transaksi</label>
        <select name="tipe" class="form-control" required>
            <option value="pemasukan">Pemasukan</option>
            <option value="pengeluaran">Pengeluaran</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-hijau">Simpan</button>
    <a href="<?= site_url('transaksi') ?>" class="btn btn-secondary">Batal</a>
</form>

<?php $this->load->view('layout/footer'); ?>
