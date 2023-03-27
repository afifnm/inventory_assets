<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('CRUD_model');
        $this->load->model('Aset_model');
    }

    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Dashboard | '.$site['nama_website'],
            'site'                  => $site,
        );
        $this->load->view('dashboard', array_merge($data));
    }
    public function pinjam(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Dashboard | '.$site['nama_website'],
            'site'                  => $site,
        );
        $this->db->select('*')->from('pinjam');
        $this->db->order_by('kode_pinjam','DESC')->limit(10);
        $pinjam = $this->db->get()->result_array();
        $data2 = array('pinjam' => $pinjam);
        $this->load->view('pinjam', array_merge($data,$data2));
    }
    public function ambil(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Dashboard | '.$site['nama_website'],
            'site'                  => $site,
        );
        $this->db->select('*')->from('ambil');
        $this->db->order_by('id_ambil','DESC')->limit(10);
        $ambil = $this->db->get()->result_array();
        $data3 = array('ambil' => $ambil);
        $this->load->view('ambil', array_merge($data,$data3));
    }
    public function pencarian(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Pencarian | '.$site['nama_website'],
            'site'                  => $site,
            'label'                 => 'Pencarian Aset '
        );
        $this->db->select('a.*,b.ruang,c.jenis,d.sumber_dana')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','left');
        $this->db->join('sumber_dana d', 'd.id_sumber_dana = a.id_sumber_dana','left');
        $this->db->order_by('a.tanggal_masuk','DESC');
        if($this->input->post('nama')!==""){
            $this->db->or_like('a.nama',$this->input->post('nama'));
        }
        if($this->input->post('nomor_inventaris')!==""){
            $this->db->or_like('a.nomor_inventaris',$this->input->post('nomor_inventaris'));
        }
        if($this->input->post('merk')!==""){
            $this->db->or_like('a.merk',$this->input->post('merk'));
        }
        if($this->input->post('id_jenis')>0){
            $this->db->or_like('a.id_jenis',$this->input->post('id_jenis'));
        }
        if($this->input->post('id_ruang')>0){
            $this->db->or_like('a.id_ruang',$this->input->post('id_ruang'));
        }
        if($this->input->post('id_sumber_dana')>0){
            $this->db->or_like('a.id_sumber_dana',$this->input->post('id_sumber_dana'));
        }
        if($this->input->post('tahun_perolehan')>0){
            $this->db->or_like('a.tahun_perolehan',$this->input->post('tahun_perolehan'));
        }
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->load->view('aset', array_merge($data,$data2));
    }
    public function jenis($id){  
        if($id==0){
            $label = 'Jenis asset belum dipilih.';
        } else {
            $label = $this->Aset_model->get_jenis($id);
        }
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => $label.' | '.$site['nama_website'],
            'site'                  => $site,
            'label'                 => $label
        );
        $this->db->select('a.*,b.ruang,c.jenis,d.sumber_dana')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','left');
        $this->db->join('sumber_dana d', 'd.id_sumber_dana = a.id_sumber_dana','left');
        $this->db->order_by('a.tanggal_masuk','DESC');
        $this->db->where('a.id_jenis',$id);
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->load->view('aset', array_merge($data,$data2));
    }
     public function ruang($id){  
        if($id==0){
            $label = 'Ruang belum dipilih.';
        } else {
            $label = $this->Aset_model->get_ruang($id);
        }
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => $label.' | '.$site['nama_website'],
            'site'                  => $site,
            'label'                 => $label
        );
        $this->db->select('a.*,b.ruang,c.jenis,d.sumber_dana')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','left');
        $this->db->join('sumber_dana d', 'd.id_sumber_dana = a.id_sumber_dana','left');
        $this->db->order_by('a.tanggal_masuk','DESC');
        $this->db->where('a.id_ruang',$id);
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->load->view('aset', array_merge($data,$data2));
    }
}