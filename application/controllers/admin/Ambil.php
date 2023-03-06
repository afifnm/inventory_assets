<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ambil extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->load->model('Aset_model');
        $this->check_login();
        if ($this->session->userdata('level') != "Admin") {
            redirect('', 'refresh');
        }
    }
    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pemgambilan Aset | '.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
        );
        $this->db->select('*')->from('ambil');
        $this->db->order_by('id_ambil','DESC');
        $data2 = $this->db->get()->result_array();
        $data2 = array('ambil' => $data2);
        $this->template->load('layout/template', 'admin/ambil_index', array_merge($data,$data2));
    }
    public function batal($id_ambil){
        $this->db->select('*')->from('ambil')->where('id_ambil',$id_ambil);
        $rows = $this->db->get()->result_array();
        foreach ($rows as $row) {
            $this->db->select('stok')->from('aset')->where('nomor_inventaris',$row['nomor_inventaris']);
            $stok_lama = $this->db->get()->row()->stok;
            $jumlah = $stok_lama+$row['jumlah'];
            //update jumlah pada bagian aset
            $data = array('stok' => $jumlah);
            $where = array('nomor_inventaris' => $row['nomor_inventaris']);
            $this->CRUD_model->Update('aset', $data, $where);

            //update pada bagian tabel ambil
            $data = array('status' => 0);
            $where = array('id_ambil' => $id_ambil);
            $this->CRUD_model->Update('ambil', $data, $where);

            $label = $this->session->userdata('nama').' telah membatalkan pengambilan aset dengan nomor inventaris '.$row['nomor_inventaris'].' sejumlah '.$row['jumlah'];
            $data = array(
                'tabel'             => 'aset',
                'keterangan'        => $label,
                'nomor_inventaris'  => $row['nomor_inventaris'],
                'username'          => $this->session->userdata('username'),
                'IP'                => $this->input->ip_address()
                );  
            $this->CRUD_model->Insert('logs', $data);
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Pengambilan aset berhasil dibatalkan.
            </div>
                    ');
            redirect('admin/ambil'); 
        }
    }
} 