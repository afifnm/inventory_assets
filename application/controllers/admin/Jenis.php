<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->check_login();
        if ($this->session->userdata('level') != "Admin") {
            redirect('', 'refresh');
        }
    }

    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Jenis Produk | '.$site['nama_website'],
            'site'                  => $site,
            'nav'                   => '
                    <a class="navigasi-link">Daftar Produk</a>
                    &nbsp; / &nbsp; <b> <i>Jenis Produk</i></b>
            '
        );
        $this->db->select('*');
        $this->db->from('jenis');
        $this->db->order_by('jenis','ASC');
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/jenis_index', array_merge($data,$data2));
    }

    public function simpan(){
        $data = array(
            'jenis' => $this->input->post('jenis')
         );  
        $this->CRUD_model->Insert('jenis', $data);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>Jenis asset '.$this->input->post('jenis').' berhasil ditambahkan. 
        </div>
                ');
        redirect('admin/jenis');       
    }

    public function hapus($id){
        $where = array(
            'id_jenis' => $id
        );
        $data = $this->CRUD_model->Delete('jenis',$where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Jenis asset berhasil dihapus. 
        </div>
                ');
        redirect('admin/jenis/');
    }
    public function editdata($id){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Edit Jenis Produk | '.$site['nama_website'],
            'site'                  => $site,
            'nav'                   => '
                    <a class="navigasi-link">Daftar Produk</a>
                    &nbsp; / &nbsp; <a class="navigasi-link" href="../"> <b> <i>Jenis Produk</i></b></a>
                    &nbsp; / &nbsp; <b> <i>Edit Jenis Produk</i></b>
            '
        );
        $where = array(
            'id_jenis' => $id
         );
        $data2['jenis'] = $this->CRUD_model->edit_data($where,'jenis')->result();
        $this->template->load('layout/template', 'admin/jenis_edit', array_merge($data, $data2));
    }
    public function updatedata(){   
        $data = array(
            'jenis' => $this->input->post('jenis')
         ); 
        $where = array(
            'id_jenis' => $this->input->post('id'),
        );
        $data = $this->CRUD_model->Update('jenis', $data, $where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Jenis asset berhasil diperbarui. 
        </div>
                ');
        redirect('admin/jenis');
    }
    public function delete_data($id){
        $id = array('id_jenis' => $id);
        $this->CRUD_model->Delete('jenis', $id);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Jenis asset berhasil dihapus. 
        </div>
            ');
        redirect('admin/jenis/');
    }
}
