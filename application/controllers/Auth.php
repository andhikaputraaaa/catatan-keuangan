<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function login() {
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $user = $this->User_model->get_by_username($this->input->post('username'));

            if ($user && password_verify($this->input->post('password'), $user->password)) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'nama_lengkap' => $user->nama_lengkap
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau Password salah');
                redirect('auth/login');
            }
        }
    }

    public function register() {
        // Cek apakah form telah disubmit
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]', [
                'is_unique' => 'Username sudah digunakan, silakan pilih username lain.'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
                'min_length' => 'Password minimal harus 6 karakter.'
            ]);
            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
    
            if ($this->form_validation->run() == FALSE) {
                // Jika ada error validasi, simpan pesan error ke dalam flash data
                if (form_error('username')) {
                    $this->session->set_flashdata('error', strip_tags(form_error('username')));
                } elseif (form_error('password')) {
                    $this->session->set_flashdata('error', strip_tags(form_error('password')));
                } elseif (form_error('nama_lengkap')) {
                    $this->session->set_flashdata('error', strip_tags(form_error('nama_lengkap')));
                }
                
                $this->load->view('auth/register');
            } else {
                $data = [
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'nama_lengkap' => $this->input->post('nama_lengkap')
                ];
                $this->User_model->insert($data);
                $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
                redirect('auth/login');
            }
        } else {
            // Jika halaman pertama kali dibuka (bukan submit)
            $this->load->view('auth/register');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
