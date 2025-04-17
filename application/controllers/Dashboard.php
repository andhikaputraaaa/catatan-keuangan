<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        $data['total_pemasukan']  = $this->Transaksi_model->sum_by_type($user_id, 'pemasukan');
        $data['total_pengeluaran'] = $this->Transaksi_model->sum_by_type($user_id, 'pengeluaran');
        $data['grafik'] = $this->Transaksi_model->get_monthly_summary($user_id);

        $this->load->view('dashboard', $data);
    }
}
