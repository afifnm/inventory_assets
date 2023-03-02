<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends MY_Controller{
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
            'title'                 => 'Peminjaman | '.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
        );
        $this->db->select('*')->from('pinjam');
        $this->db->order_by('kode_pinjam','DESC');
        $data2 = $this->db->get()->result_array();
        $data2 = array('pinjam' => $data2);
        $this->template->load('layout/template', 'admin/pinjam_index', array_merge($data,$data2));
    }
    public function buat(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Buat Peminjaman | '.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
        );
        $data2['asets'] = $this->Aset_model->getPinjamAset();
        $data2['temp_pinjam'] = $this->Aset_model->getTempAset();
        $this->template->load('layout/template', 'admin/pinjam_buat', array_merge($data,$data2));
    }
    public function detail($link,$id){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Detail peminjaman '.$id.' | '.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
            'nomor_barang'          => $id,
            'link'                  => $link
        );
        $where = array('kode_peminjaman' => $id);
        $data2['peminjaman'] = $this->Barang_model->edit_data($where,'peminjaman')->result();
        $where = array('kode_peminjaman' => $id);
        $data3['detail'] = $this->Barang_model->edit_data($where,'detail_peminjaman')->result();
        $this->template->load('layout/template', 'mahasiswa/detail', array_merge($data, $data2, $data3));
    }
    public function add($id){
        $barang = array(
        'nomor_inventaris' => $id,
        'username' => $this->session->userdata('username')
        );
        $this->CRUD_model->Insert('temp', $barang);
        $aktif = array('status' => 'Dipinjam');
        $where = array('nomor_inventaris' => $id);
        $this->CRUD_model->Update('aset', $aktif, $where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Nomor inventaris '.$id.' telah ditambahkan kedalam daftar peminjaman.
        </div>
                ');
        redirect('admin/pinjam/buat'); 
    }
    public function delete($id){
        $nomor_inventaris = array('nomor_inventaris' => $id);
        $aktif = array('status' => 'Ada');
        $where = array('nomor_inventaris' => $id);
        $this->CRUD_model->Update('aset', $aktif, $where);
        $this->CRUD_model->Delete('temp', $nomor_inventaris);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Nomor inventaris '.$id.' telah dihapus dalam daftar peminjaman.
        </div>
                ');
        redirect('admin/pinjam/buat'); 
    }
    public function simpan(){
        $label = $_POST['peminjam']." telah meminjam ";
        $kode_pinjam = date('YmdHis');
        $this->db->select('a.*')->from('temp a');
        $this->db->join('aset b', 'b.nomor_inventaris = a.nomor_inventaris','left');
        $this->db->where('username', $this->session->userdata('username')); 
        $temp = $this->db->get()->result_array();
        foreach ($temp as $uu) {
            $detail = array(
                'kode_pinjam' => date('YmdHis'),
                'nomor_inventaris' => $uu['nomor_inventaris'],
                'peminjam' => $_POST['peminjam']
                 );
            $this->CRUD_model->Insert('detail_pinjam', $detail);
            $label .= " ,".$uu['nama'];
         }
         $label .= " pada tanggal ".date('d-M-Y');
        $peminjaman = array(
            'kode_pinjam' => $kode_pinjam,
            'tanggal_pinjam' => date('Y-m-d H:i:s'),
            'peminjam' => $_POST['peminjam'],
            'username' => $this->session->userdata('username'),
            'keterangan' => $this->input->post('keterangan'),
            'status' => 0
             );
        $this->CRUD_model->Insert('pinjam', $peminjaman);
        $hapustemp = array('username' => $this->session->userdata('username'));
        $this->CRUD_model->Delete('temp', $hapustemp);

        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> '.$label.'
        </div>
                ');
        redirect('admin/pinjam');      
    }
} 