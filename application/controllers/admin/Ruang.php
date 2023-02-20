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
        if ($this->session->userdata('level') != "Admin") {
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

    public function barang($id){
         $data2['data'] = $this->Ruang_model->barangdalamruang($id);
         $ruang['ruang'] = $this->Ruang_model->namaruang($id);
         $site = $this->Konfigurasi_model->listing();
         $data = array(
            'title'                 => 'Daftar barang |'.$site['nama_website'],
            'favicon'               => $site['favicon'],
            'site'                  => $site,
            'link'                  => $id
         );
        $this->template->load('layout/template', 'admin/ruang/detailbarang', array_merge($data, $data2,$ruang));
    }
    function cetaklaporan($jenis){ 
        $ruang = $this->Ruang_model->nama($jenis);    
        foreach ($ruang as $baris){ 
            $prodi = $baris['prodi2'];
            $ruang = $baris['ruang'];
        }  
        if($prodi=='PTIK'){
            $prodi = 'Program Studi Pendidikan Teknik Informatika & Komputer';
        } elseif($prodi=='PTM'){
            $prodi = 'Program Studi Pendidikan Teknik Mesin';
        } elseif($prodi=='PTB'){
            $prodi = 'Program Studi Pendidikan Teknik Bangunan';
        } else {
            $prodi = 'Jurusan Pendidikan Teknik Kejuruan';
        }
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Times','',11);
        $pdf->Image('assets/upload/images/logo.png',18,11,18);
        $pdf->Cell(31,0,'',0,0);
        $pdf->Cell(0,5,'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN',10,5,'L');
        $pdf->Cell(0,5,'UNIVERSITAS SEBELAS MARET',10,5,'L');
        $pdf->Cell(0,5,'FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN',0,1,'l');
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(31,0,'',0,0);
        $pdf->Cell(0,5,'JURUSAN PENDIDIKAN TEKNIK DAN KEJURUAN',0,1,'l');
        $pdf->Cell(31,2,'_____________________________________________________________________________________',0,1);
        $pdf->SetFont('Times','',11);
        $pdf->Cell(0,15,'DAFTAR BARANG RUANGAN',0,1,'C');

        $pdf->Cell(5,6,'',0,0,'C');
        $pdf->Cell(25,5,'Nama UAKB',0,0,'L');
        $pdf->Cell(20,5,': FKIP UNS',0,1,'L');
        $pdf->Cell(5,6,'',0,0,'C');
        $pdf->Cell(25,8,'Ruang',0,0,'L');
        $pdf->Cell(20,8,': '.$ruang,0,1,'L');
        // $pdf->Cell(0,7,$ruang,0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(5,6,'',0,0,'C');
        $pdf->Cell(10,6,'No.',1,0,'C');
        $pdf->Cell(35,6,'Nomor Inventaris',1,0,'C');
        $pdf->Cell(50,6,'Nama Barang',1,0,'C');
        $pdf->Cell(30,6,'Keterangan',1,0,'C');
        $pdf->Cell(15,6,'NUP',1,0,'C');
        $pdf->Cell(20,6,'Status',1,0,'C');
        $pdf->Cell(20,6,'Kondisi',1,1,'C');
        $pdf->SetFont('Times','',9);
        $this->db->select('*');
        $this->db->from('barang a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','right');
        $this->db->order_by('nama', 'ASC'); 
        $this->db->where('a.id_ruang', $jenis); 
         if($this->session->userdata('prodi')!=='Jurusan'){
         $this->db->where('a.prodi', $this->session->userdata('prodi')); }
        $data = $this->db->get()->result_array();
        $no = 1;
        foreach ($data as $row){
            $pdf->Cell(5,6,'',0,0,'C');
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->SetFont('Times','',7);
            $pdf->Cell(35,6,$row['nomor_inventaris'],1,0,'C');
            $pdf->Cell(50,6,$row['nama'],1,0,'L');
            $pdf->Cell(30,6,$row['merk'],1,0,'C');
            $pdf->Cell(15,6,$row['nup'],1,0,'C');
            $pdf->Cell(20,6,$row['status'],1,0,'C'); 
            $pdf->Cell(20,6,$row['kondisi'],1,1,'C'); 
            $no++;
        }
        $pdf->Cell(177,10,'',0,1,'R'); //space 
        $pdf->SetFont('Times','',9);
        $pdf->Cell(177,6,'Surakarta, '.date_indo('Y-m-d'),0,1,'R');    

        $pdf->Cell(5,0,'',0,0,'L');  //space 
        $pdf->Cell(135,5,'Koordinator PTK.,',0,0,'L');
        $pdf->Cell(10,5,'Korminjur PTK.,',0,1,'L');
        $pdf->Cell(177,10,'',0,1,'R'); //space 
        $pdf->Cell(5,6,'',0,0,'L');  //space 
        $pdf->SetFont('Times','B',9);
        $pdf->Cell(135,6,'Drs. Sutrisno, ST., M.Pd.',0,0,'L');
        $pdf->Cell(10,6,'Senen',0,1,'L');
        $pdf->SetFont('Times','',9);
        $pdf->Cell(5,6,'',0,0,'L');  //space 
        $pdf->Cell(135,1,'NIP. 19530727 198003 1 002',0,0,'L');
        $pdf->Cell(10,1,'NIP.  19630118 198702 1 001',0,1,'L');
        $pdf->Output();
    }
}
