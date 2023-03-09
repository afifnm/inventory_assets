<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ruang extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Aset_model');
        $this->load->model('CRUD_model');
        $this->load->helper('tgl_indo');
        $this->load->library('Pdf');
        $this->check_login();
        if (($this->session->userdata('level') != "Admin") AND ($this->session->userdata('level') != "Staff")) {
            redirect('', 'refresh');
        }
    } 
    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Ruang | '.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
        );
         $this->db->select('*')->from('ruang');
         $data2 = $this->db->get()->result_array();
         $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/ruang_index', array_merge($data, $data2));
    }
    public function simpan(){
        $data = array(
            'ruang' => $this->input->post('ruang'),
            'keterangan' => $this->input->post('keterangan')
             );
        $data = $this->CRUD_model->Insert('ruang', $data);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>Ruang '.$this->input->post('ruang').' berhasil ditambahkan. 
        </div>
                ');
        redirect('admin/ruang');  
    }
    public function delete_data($id){
        $id = array('id_ruang' => $id);
        $this->CRUD_model->Delete('ruang', $id);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>Ruang telah dihapus. 
        </div>
                ');
        redirect('admin/ruang');
    }
    public function updatedata(){
        $id = $this->input->post('id');
        $data = array(
            'ruang' => $this->input->post('ruang'),
            'keterangan' => $this->input->post('keterangan')
             );
        $where = array(
            'id_ruang' => $id,
        );
        $this->CRUD_model->Update('ruang', $data, $where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>Ruang '.$this->input->post('ruang').' telah diperbarui. 
        </div>
                ');
        redirect('admin/ruang');
    }
    function cetakAllbarcode($id_ruang){ 
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',10);
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('id_ruang', $id_ruang); 
        $this->db->order_by('nama', 'ASC'); 
        $data = $this->db->get()->result_array();
        $nomor_inventaris = 18;
        $logo = 17;
        foreach ($data as $row){
            $pdf->Cell(22,6,$row['prodi'],1,0,'C');
            $pdf->Cell(70,6,$row['nama'],1,1,'C');
            $pdf->Cell(22,21,'',1,0,'C');
            $pdf->Cell(70,21,'',1,1,'C');
            $pdf->Cell(1,1,'',0,1,'C');
            $pdf->Image('assets/upload/images/logo.png',12,$logo,-300);
            $pdf->Image('assets/upload/barcode/'.$row['nomor_inventaris'].'.jpg',35,$nomor_inventaris);
            $logo = $logo+28;
            $nomor_inventaris = $nomor_inventaris+28;
        }
        $pdf->Output();
    }
    function cetakbarcode($nomor_inventaris){ 
        $pdf = new FPDF('L','mm',array(58,110));
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',10);
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('nomor_inventaris', $nomor_inventaris); 
        $this->db->order_by('nama', 'ASC'); 
        $data = $this->db->get()->result_array();
        $nomor_inventaris = 18;
        $logo = 17;
        foreach ($data as $row){
            $pdf->Cell(22,6,$row['prodi'],1,0,'C');
            $pdf->Cell(70,6,$row['nama'],1,1,'C');
            $pdf->Cell(22,21,'',1,0,'C');
            $pdf->Cell(70,21,'',1,1,'C');
            $pdf->Image('assets/upload/images/logo.png',12,17,-300);
            $pdf->Image('assets/upload/barcode/'.$row['nomor_inventaris'].'.jpg',35,18);
        }
        $pdf->Output();
    }

    public function aset($id){
        $namaruang = $this->Aset_model->get_ruang($id);
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Data Aset Ruang | '.$namaruang,
            'site'                  => $site,
            'namajenis'             => 'Aset di dalam ruang : '.$namaruang
        );
        $this->db->select('a.*,b.ruang,c.jenis')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','left');
        $this->db->order_by('a.tanggal_masuk','DESC');
        $this->db->or_like('a.id_ruang',$id);
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/aset_index', array_merge($data,$data2));
    }
}
