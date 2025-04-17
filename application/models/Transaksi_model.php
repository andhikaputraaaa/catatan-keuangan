<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function get_by_id($id) {
        return $this->db->get_where('transaksi', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('transaksi', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('transaksi', $data);
    }

    public function delete($id) {
        return $this->db->delete('transaksi', ['id' => $id]);
    }

    public function get_filtered_by_user($user_id, $kategori = null, $tipe = null, $tanggal_mulai = null, $tanggal_selesai = null) {
        $this->db->select('transaksi.*, kategori.nama_kategori');
        $this->db->from('transaksi');
        $this->db->join('kategori', 'transaksi.kategori_id = kategori.id', 'left');
        $this->db->where('transaksi.user_id', $user_id);
    
        if ($kategori) {
            $this->db->where('transaksi.kategori_id', $kategori);
        }
        if ($tipe) {
            $this->db->where('transaksi.tipe', $tipe);
        }
        if ($tanggal_mulai) {
            $this->db->where('transaksi.tanggal >=', $tanggal_mulai);
        }
        if ($tanggal_selesai) {
            $this->db->where('transaksi.tanggal <=', $tanggal_selesai);
        }
    
        return $this->db->get()->result();
    }

    public function sum_by_type($user_id, $tipe){
    $this->db->select_sum('jumlah');
    $this->db->where('user_id', $user_id);
    $this->db->where('tipe', $tipe);
    return $this->db->get('transaksi')->row()->jumlah ?? 0;
    }

    public function get_monthly_summary($user_id){
    $this->db->select("DATE_FORMAT(tanggal, '%Y-%m') AS bulan,
                       SUM(CASE WHEN tipe = 'pemasukan' THEN jumlah ELSE 0 END) AS pemasukan,
                       SUM(CASE WHEN tipe = 'pengeluaran' THEN jumlah ELSE 0 END) AS pengeluaran");
    $this->db->from('transaksi');
    $this->db->where('user_id', $user_id);
    $this->db->group_by("bulan");
    $this->db->order_by("bulan", "ASC");

    return $this->db->get()->result();
    }

}
