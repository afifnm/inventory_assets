<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sumber_dana extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->check_login();
        if (($this->session->userdata('level') != "Admin") AND ($this->session->userdata('level') != "Staff")) {
            redirect('', 'refresh');
        }
    }

    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Sumber Dana | '.$site['nama_website'],
            'site'                  => $site,
            'nav'                   => '
                    <a class="navigasi-link">Daftar Produk</a>
                    &nbsp; / &nbsp; <b> <i>Sumber Dana</i></b>
            '
        );
        $this->db->select('*');
        $this->db->from('sumber_dana');
        $this->db->order_by('sumber_dana','ASC');
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/sumber_dana_index', array_merge($data,$data2));
    }

    public function simpan(){
        $data = array(
            'sumber_dana' => $this->input->post('sumber_dana')
         );  
        $this->CRUD_model->Insert('sumber_dana', $data);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>sumber_dana asset '.$this->input->post('sumber_dana').' berhasil ditambahkan. 
        </div>
                ');
        redirect('admin/sumber_dana');       
    }

    public function hapus($id){
        $where = array(
            'id_sumber_dana' => $id
        );
        $data = $this->CRUD_model->Delete('sumber_dana',$where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> sumber dana asset berhasil dihapus. 
        </div>
                ');
        redirect('admin/sumber_dana/');
    }
    public function editdata($id){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Edit Sumber Dana | '.$site['nama_website'],
            'site'                  => $site,
            'nav'                   => '
                    <a class="navigasi-link">Daftar Produk</a>
                    &nbsp; / &nbsp; <a class="navigasi-link" href="../"> <b> <i>Sumber Dana</i></b></a>
                    &nbsp; / &nbsp; <b> <i>Edit Sumber Dana</i></b>
            '
        );
        $where = array(
            'id_sumber_dana' => $id
         );
        $data2['sumber_dana'] = $this->CRUD_model->edit_data($where,'sumber_dana')->result();
        $this->template->load('layout/template', 'admin/sumber_dana_edit', array_merge($data, $data2));
    }
    public function updatedata(){   
        $data = array(
            'sumber_dana' => $this->input->post('sumber_dana')
         ); 
        $where = array(
            'id_sumber_dana' => $this->input->post('id'),
        );
        $data = $this->CRUD_model->Update('sumber_dana', $data, $where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> sumber dana asset berhasil diperbarui. 
        </div>
                ');
        redirect('admin/sumber_dana');
    }
    public function delete_data($id){
        $id = array('id_sumber_dana' => $id);
        $this->CRUD_model->Delete('sumber_dana', $id);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> sumber dana asset berhasil dihapus. 
        </div>
            ');
        redirect('admin/sumber_dana/');
    }
}
