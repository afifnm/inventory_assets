<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $level = $this->session->userdata('level');
        $this->load->model('CRUD_model');
        $this->load->model('Auth_model');
        $this->check_login();
        if (($this->session->userdata('level') != "Admin") AND ($this->session->userdata('level') != "Staff")) {
            redirect('', 'refresh');
        }
    }
    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Pengguna | '.$site['nama_website'],
            'site'                  => $site,
        );
        $this->db->select('*')->from('user');
        $this->db->where('username !=',$this->session->userdata('username'));
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/user_index', array_merge($data,$data2));
    } 

    public function reset(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Reset Password | '.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
        );
        $this->template->load('layout/template', 'authentication/password', array_merge($data));
    }
    public function profile(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'My Profile | '.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
        );
        $this->template->load('layout/template', 'admin/user_profile', array_merge($data));
    }
    public function simpan(){
        $username = $this->input->post('username');
        $cekusername = $this->db->where('username', $username)->count_all_results('user');
        if ($cekusername > 0) {
        $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Username telah digunakan. 
            </div>
                    ');
             redirect('admin/pengguna'); 
        } else{
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Pengguna berhasil ditambahkan. 
            </div>
                    ');
            $this->Auth_model->register(); 
            redirect('admin/pengguna'); 
        } 
    }
    public function delete_data($id){
        $id = array('id' => $id);
        $this->CRUD_model->Delete('user', $id);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Pengguna berhasil dihapus. 
        </div>
                ');
        redirect('admin/pengguna'); 
    }
    public function update(){
        $data = array(
            'nama'              => $this->input->post('nama'),
            'alamat'            => $this->input->post('alamat'),
            'no_hp'             => $this->input->post('no_hp')
         );  
        $where = array(
            'username' => $this->input->post('username'),
        );
        $data = $this->CRUD_model->Update('user', $data, $where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Pengguna berhasil diperbarui. 
        </div>
                ');
        redirect('admin/pengguna'); 
    }
        public function reset_password($id){
        $data = array(
            'password' => get_hash('1234')
         ); 
        $where = array(
            'id' => $id,
        );
        $data = $this->CRUD_model->Update('user', $data, $where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Password telah direset menjadi 1234 
        </div>
                ');
        redirect('admin/pengguna'); 
    }
}
