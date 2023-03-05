<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
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
            'title'                 => 'Dashboard | '.$site['nama_website'],
            'site'                  => $site,
        );
        $this->db->select('*')->from('pinjam');
        $this->db->order_by('kode_pinjam','DESC');
        $this->db->limit(10);
        $data2 = $this->db->get()->result_array();
        $data2 = array('pinjam' => $data2);
        $this->template->load('layout/template', 'admin/dashboard', array_merge($data,$data2));
    }
    public function pencarian($id){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pencarian | '.$site['nama_website'],
            'site'                  => $site,
            'namajenis'             => 'Pencarian Aset: '.$id
        );
        $this->db->select('a.*,b.ruang,c.jenis')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','left');
        $this->db->order_by('a.tanggal_masuk','DESC');
        $this->db->or_like('a.nomor_inventaris',$id);
        $this->db->or_like('a.nama',$id);
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/aset_index', array_merge($data,$data2));
    }
}
 