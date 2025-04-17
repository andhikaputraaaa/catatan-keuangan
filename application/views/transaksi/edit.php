<?php $this->load->view('layout/header'); ?>

<h4 class="mb-3">Edit Transaksi</h4>

<form method="post" action="<?= site_url('transaksi/edit/'.$transaksi->id) ?>">
    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= $transaksi->tanggal ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat->id ?>" <?= $transaksi->kategori_id == $kat->id ? 'selected' : '' ?>>
                    <?= $kat->nama_kategori ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="<?= $transaksi->jumlah ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipe Transaksi</label>
        <select name="tipe" class="form-control" required>
            <option value="pemasukan" <?= $transaksi->tipe === 'pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
            <option value="pengeluaran" <?= $transaksi->tipe === 'pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3"><?= $transaksi->deskripsi ?></textarea>
    </div>

    <button type="submit" class="btn btn-hijau">Update</button>
    <a href="<?= site_url('transaksi') ?>" class="btn btn-secondary">Batal</a>
</form>

<?php $this->load->view('layout/footer'); ?>
