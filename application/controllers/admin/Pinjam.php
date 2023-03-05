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
    public function detail($kode_pinjam){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Detail Pinjam | '.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
            'kode_pinjam'           => $kode_pinjam
        );
        $where = array('kode_pinjam' => $kode_pinjam);
        $data2['pinjam'] = $this->CRUD_model->edit_data($where,'pinjam')->result();
        $this->template->load('layout/template', 'admin/pinjam_detail', array_merge($data, $data2));
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
    public function add2($id,$kode_pinjam){
        $ceknomor = $this->db->where('nomor_inventaris', $id)->count_all_results('temp_kembali');
        if ($ceknomor > 0) {
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Aset sudah dimasukan ke dalam daftar pengembalian.
            </div>
                    ');
                redirect('admin/pinjam/detail/'.$kode_pinjam); 
        } 
        $barang = array(
        'nomor_inventaris' => $id,
        'username' => $this->session->userdata('username')
        );
        $this->CRUD_model->Insert('temp_kembali', $barang);
        $aktif = array('status' => 'Dipinjam');
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Nomor inventaris '.$id.' telah ditambahkan kedalam daftar pengembalian.
        </div>
                ');
        redirect('admin/pinjam/detail/'.$kode_pinjam); 
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
    public function delete2($id,$kode_pinjam){
        $nomor_inventaris = array('nomor_inventaris' => $id);
        $this->CRUD_model->Delete('temp_kembali', $nomor_inventaris);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Nomor inventaris '.$id.' telah dihapus dalam daftar pengembalian.
        </div>
                ');
        redirect('admin/pinjam/detail/'.$kode_pinjam); 
    }
    public function simpan(){
        $ceknomor = $this->db->where('username', $this->session->userdata('username'))->count_all_results('temp');
        if ($ceknomor == 0) {
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Masukan dulu daftar aset yang akan dipinjam.
            </div>
                    ');
             redirect('admin/pinjam/buat/'); 
        } 
        $kode_pinjam = date('YmdHis');
        $this->db->select('a.*,b.nama')->from('temp a');
        $this->db->join('aset b', 'b.nomor_inventaris = a.nomor_inventaris','left');
        $this->db->where('username', $this->session->userdata('username')); 
        $temp = $this->db->get()->result_array();
        foreach ($temp as $uu) {
            $detail = array(
                'kode_pinjam' => date('YmdHis'),
                'nomor_inventaris' => $uu['nomor_inventaris'],
                'tanggal_pinjam' => date('Y-m-d'),
                'status' => 0
                 );
            $this->CRUD_model->Insert('detail_pinjam', $detail);
            $label = $_POST['peminjam']." telah meminjam ".$uu['nama']." dengan nomor inventaris ". $uu['nomor_inventaris']." pada tanggal ".date('d-M-Y');
            $data = array(
                'tabel'             => 'aset',
                'keterangan'        => $label,
                'nomor_inventaris'  => $uu['nomor_inventaris'],
                'username'          => $this->session->userdata('username'),
                'IP'                => $this->input->ip_address()
             );  
            $this->CRUD_model->Insert('logs', $data);
         }
        $peminjaman = array(
            'kode_pinjam' => $kode_pinjam,
            'peminjam' => $_POST['peminjam'],
            'tanggal_pinjam' => date('Y-m-d'),
            'username' => $this->session->userdata('username'),
            'keterangan' => $this->input->post('keterangan')
             );
        $this->CRUD_model->Insert('pinjam', $peminjaman);
        $hapustemp = array('username' => $this->session->userdata('username'));
        $this->CRUD_model->Delete('temp', $hapustemp);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Berhasil melakukan pinjaman aset.
        </div>
                ');
        redirect('admin/pinjam');      
    }
    public function kembalikan(){
        $jumlah = $this->input->post('jumlah');
        $peminjam = $this->input->post('peminjam');
        $kode_pinjam = $this->input->post('kode_pinjam');
        if ($jumlah == 0) {
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Masukan dulu daftar aset yang akan dikembalikan.
            </div>
                    ');
            redirect('admin/pinjam/detail/'.$kode_pinjam); 
        } 
        for ($i=0; $i < $jumlah; $i++) {
            $nomor_inventaris = $this->input->post('nomor_inventaris['.$i.']');
            $keadaan = $this->input->post('kondisi['.$i.']');
            //update bagian aset
            $data = array(
                'status' => 'Ada',
                'kondisi' => $keadaan
            );
            $where = array('nomor_inventaris' => $nomor_inventaris);
            $this->CRUD_model->Update('aset', $data, $where);

            //update bagian detail_pinjam
            $data = array(
                'status' => 1,
                'kondisi' => $keadaan,
                'tanggal_kembali' => date('Y-m-d')
            );
            $where = array('nomor_inventaris' => $nomor_inventaris);
            $this->CRUD_model->Update('detail_pinjam', $data, $where);
            $label = $peminjam." telah mengembalikan aset dengan nomor inventaris ". $nomor_inventaris." pada tanggal ".date('d-M-Y'). " dalam keadaan ".$keadaan;
            $data = array(
                'tabel'             => 'aset',
                'keterangan'        => $label,
                'nomor_inventaris'  => $nomor_inventaris,
                'username'          => $this->session->userdata('username'),
                'IP'                => $this->input->ip_address()
             );  
            $this->CRUD_model->Insert('logs', $data);
        }
        $hapustemp = array('username' => $this->session->userdata('username'));
        $this->CRUD_model->Delete('temp_kembali', $hapustemp);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Berhasil mengembalikan pinjaman aset.
        </div>
                ');
        redirect('admin/pinjam/detail/'.$kode_pinjam);    
    }
} 