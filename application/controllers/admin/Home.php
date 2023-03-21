<?php

defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->load->model('Aset_model');
        $this->check_login();
        if (($this->session->userdata('level') != "Admin") AND ($this->session->userdata('level') != "Staff")) {
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
        $this->db->order_by('kode_pinjam','DESC')->limit(10);
        $pinjam = $this->db->get()->result_array();
        $data2 = array('pinjam' => $pinjam);
        $this->db->select('*')->from('ambil');
        $this->db->order_by('id_ambil','DESC')->limit(10);
        $ambil = $this->db->get()->result_array();
        $data3 = array('ambil' => $ambil);
        $this->template->load('layout/template', 'admin/dashboard', array_merge($data,$data2,$data3));
    }
    public function pencarian($id=NULL){
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
    public function excel(){
        $id_jenis = $this->input->get('id_jenis');
        $id_ruang = $this->input->get('id_ruang');
        $this->db->select('a.*,b.ruang,c.jenis,d.sumber_dana')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','left');
        $this->db->join('sumber_dana d', 'd.id_sumber_dana = a.id_sumber_dana','left');
        $this->db->order_by('a.nama','DESC');
        if($id_jenis!=""){
            $this->db->where('a.id_jenis',$id_jenis);
        }
        if($id_ruang!=""){
            $this->db->where('a.id_ruang',$id_ruang);
        }
        $asets = $this->db->get()->result_array();
        $data2 = array('asets' => $asets);
        $this->load->view('admin/excel', $data2);
    }
    public function import_excel()	{
        $file_mimes = array(
            'application/octet-stream', 
            'application/vnd.ms-excel', 
            'application/x-csv', 
            'text/x-csv', 
            'text/csv', 
            'application/csv', 
            'application/excel', 
            'application/vnd.msexcel', 
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for($i = 1;$i < count($sheetData);$i++){
                $nama = $sheetData[$i]['0'];
                $aset = $sheetData[$i]['1'];
                $stok = $sheetData[$i]['2'];
                $nomor_inventaris = $sheetData[$i]['3'];
                $merk = $sheetData[$i]['4'];
                $harga = $sheetData[$i]['5'];
                $tahun_perolehan = $sheetData[$i]['6'];
                $ceknomor = $this->db->where('nomor_inventaris', $nomor_inventaris)->count_all_results('aset');
                if ($ceknomor > 0) {
                    $this->session->set_flashdata('alert', '
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                        <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Gagal melakukan import dikarenakan nomor inventaris '.$nomor_inventaris.' telah digunakan.
                    </div>
                            ');
                     redirect('admin/home/'); 
                } 
                $data = array(
                    'nama'              => $nama,
                    'aset'              => $aset,
                    'stok'              => $stok,
                    'nomor_inventaris'  => $nomor_inventaris,
                    'merk'              => $merk,
                    'harga'             => $harga,
                    'tahun_perolehan'   => $tahun_perolehan,
                    'id_jenis'          => 0,
                    'tanggal_masuk'     => date('Y-m-d'),
                    'id_ruang'          => 0,
                    'id_sumber_dana'    => 1,
                    'status'            => 'Ada',
                    'kondisi'           => 'Baik',
                    'active'            => 1
                    );  
                $this->CRUD_model->Insert('aset', $data);
            }
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Berhasil mengimport. Silahkan atur jenis aset dan ruang untuk langkah selanjutnya.
            </div>
                    ');
             redirect('admin/home/'); 
        } else {
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> File yang dipilih tidak valid. Pilih file excel yang disediakan untuk mengimport data.
            </div>
                    ');
             redirect('admin/home/'); 
        }
	}
}