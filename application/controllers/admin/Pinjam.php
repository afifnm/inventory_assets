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
        $this->db->order_by('tanggal_pinjam','DESC');
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
     $this->db->select('*');
     $this->db->from('barang');
     $this->db->like('nomor_inventaris', $id); 
     $data = $this->db->get()->result_array();
     $data = array('data' => $data);
     foreach ($data['data'] as $uu) {
        $nama = $uu['nama'];
        $status = $uu['active'];
     }
     if($status==1){
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-plus"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Nomor inventaris '.$id.' sudah terlebih dahulu dipinjam oleh mahasiswa lain.</div>
        </div>
        </p>
        ');
        redirect('mahasiswa/peminjaman');            
        } else {
         $barang = array(
            'nama' => $nama,
            'nomor_inventaris' => $id,
            'username' => $this->session->userdata('username')
            );
            $this->Barang_model->Insert('temp', $barang);
            $aktif = array('active' => 1);
            $where = array('nomor_inventaris' => $id);
            $this->Barang_model->Update('barang', $aktif, $where);
            $data = array(
                'keterangan' => 'ditambahkan kedaftar pinjaman mahasiswa',
                'id_barang' => $id,
                'username' => $this->session->userdata('username'),
                'IP' => $this->input->ip_address()
             );  
            $this->Barang_model->Insert('logs_barang', $data);
            $userdata = array('nomor_inventaris' => $id);
            $this->session->set_userdata($userdata);
            $this->session->set_flashdata('alert', '<p class="box-msg">
            <div class="info-box alert-success">
            <div class="info-box-icon">
            <i class="fa fa-plus"></i>
            </div>
            <div class="info-box-content" style="font-size:14">
            <b style="font-size: 20px">SUCCESS</b><br>Nomor inventaris '.$id.' ditambahkan ke daftar barang yang akan dipinjam</div>
            </div>
            </p>
            ');
            redirect('mahasiswa/peminjaman');
        }
    }
    public function hapus($id){
        $nomor_inventaris = array('nomor_inventaris' => $id);
        $aktif = array('active' => 0);
        $where = array('nomor_inventaris' => $id);
        $this->Barang_model->Update('barang', $aktif, $where);
        $this->Barang_model->Delete('temp', $nomor_inventaris);
            $data = array(
                'keterangan' => 'dihapus dari daftar pinjaman mahasiswa',
                'id_barang' => $id,
                'username' => $this->session->userdata('username'),
                'IP' => $this->input->ip_address()
             );  
            $this->Barang_model->Insert('logs_barang', $data);
        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-trash"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">SUCCESS</b><br>Nomor inventaris '.$id.' dihapus dari daftar barang yang akan dipinjam.</div>
        </div>
        </p>
        ');
        redirect('mahasiswa/peminjaman');
    }
    public function pinjam(){
        $count = $this->db->count_all_results('peminjaman');
        $this->db->select('*');
        $this->db->from('temp');
        $this->db->where('username', $this->session->userdata('username')); 
        $data = $this->db->get()->result_array();
        $data = array('data' => $data);
        foreach ($data['data'] as $uu) {
            $detail = array(
                'kode_peminjaman' => 'SIIBNRJPTK-'.$count,
                'nomor_inventaris' => $uu['nomor_inventaris'],
                'nama' => $uu['nama']
                 );
            $this->Barang_model->Insert('detail_peminjaman', $detail);
            $data = array(
                'keterangan' => 'akan dipinjam mahasiswa',
                'id_barang' => $uu['nomor_inventaris'],
                'username' => $this->session->userdata('username'),
                'IP' => $this->input->ip_address()
             );  
            $this->Barang_model->Insert('logs_barang', $data);
         }
        $peminjaman = array(
            'kode_peminjaman' => 'SIIBNRJPTK-'.$count,
            'username' => $this->session->userdata('username'),
            'tanggal_pinjam' => date('Y-m-d H:i:s'),
            'keperluan' => $this->input->post('keperluan'),
            'prodi' => $this->session->userdata('prodi'),
            'status' => 0
             );
        $this->Barang_model->Insert('peminjaman', $peminjaman);
        $hapustemp = array('username' => $this->session->userdata('username'));
        $this->Barang_model->Delete('temp', $hapustemp);

        $data = array('pinjam' => '1'); //1 belum diverifikasi
        $where = array('username' => $this->session->userdata('username'));
        $this->Barang_model->Update('user', $data, $where);

        $this->session->set_flashdata('alert', '<p class="box-msg">
        <div class="info-box alert-success">
        <div class="info-box-icon">
        <i class="fa fa-check"></i>
        </div>
        <div class="info-box-content" style="font-size:14">
        <b style="font-size: 20px">PROSES</b><br> Segera menuju bagian Admin untuk meminta persetujuan peminjaman.</div>
        </div>
        </p>
        ');
        redirect('mahasiswa/home');        
    }
} 