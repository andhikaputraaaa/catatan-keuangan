<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        $this->load->model('Transaksi_model');
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
    
        // Ambil parameter filter dari request
        $kategori = $this->input->get('kategori');
        $tipe = $this->input->get('tipe');
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');
    
        // Ambil data transaksi berdasarkan filter
        $data['transaksi'] = $this->Transaksi_model->get_filtered_by_user($user_id, $kategori, $tipe, $tanggal_mulai, $tanggal_selesai);
    
        // Ambil data kategori untuk dropdown filter
        $data['kategori'] = $this->Kategori_model->get_all();
    
        $this->load->view('transaksi/index', $data);
    }

    public function create() {
        $data['kategori'] = $this->Kategori_model->get_all();

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('transaksi/create', $data);
        } else {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'kategori_id' => $this->input->post('kategori_id'),
                'tanggal' => $this->input->post('tanggal'),
                'jumlah' => $this->input->post('jumlah'),
                'tipe' => $this->input->post('tipe'),
                'deskripsi' => $this->input->post('deskripsi')
            ];
            $this->Transaksi_model->insert($data);

            $this->session->set_flashdata('success', 'Transaksi berhasil ditambahkan!');

            redirect('transaksi');
        }
    }

    public function edit($id) {
        $data['kategori'] = $this->Kategori_model->get_all();
        $data['transaksi'] = $this->Transaksi_model->get_by_id($id);

        if (!$data['transaksi'] || $data['transaksi']->user_id != $this->session->userdata('user_id')) {
            show_404();
        }

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('transaksi/edit', $data);
        } else {
            $updateData = [
                'kategori_id' => $this->input->post('kategori_id'),
                'tanggal' => $this->input->post('tanggal'),
                'jumlah' => $this->input->post('jumlah'),
                'tipe' => $this->input->post('tipe'),
                'deskripsi' => $this->input->post('deskripsi')
            ];
            $this->Transaksi_model->update($id, $updateData);

            $this->session->set_flashdata('success', 'Transaksi berhasil diperbarui!');

            redirect('transaksi');
        }
    }

    public function delete($id) {
        $transaksi = $this->Transaksi_model->get_by_id($id);

        if (!$transaksi || $transaksi->user_id != $this->session->userdata('user_id')) {
            show_404();
        }

        $this->Transaksi_model->delete($id);

        $this->session->set_flashdata('success', 'Transaksi berhasil dihapus!');

        redirect('transaksi');
    }
}
