<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends MY_Controller{
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
    public function jenis($id){
        $namajenis = $this->Aset_model->get_jenis($id);
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => $namajenis.' | '.$site['nama_website'],
            'site'                  => $site,
            'namajenis'             => $namajenis,
            'id_jenis'                    => $id
        );
        $this->db->select('a.*,b.ruang,c.jenis')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','left');
        $this->db->order_by('a.tanggal_masuk','DESC');
        $this->db->where('a.id_jenis',$id);
        $data2 = $this->db->get()->result_array();
        $data2 = array('data2' => $data2);
        $this->template->load('layout/template', 'admin/aset_index', array_merge($data,$data2));
    }
    public function simpan(){      
        if($this->input->post('aset')=='Tetap'){
            $stok = 1;
        } else {
            $stok = $this->input->post('stok');
        }
        $nomor_inventaris = $this->input->post('nomor_inventaris');
        $ceknomor = $this->db->where('nomor_inventaris', $nomor_inventaris)->count_all_results('aset');
        if ($ceknomor > 0) {
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Nomor inventaris '.$nomor_inventaris.' telah digunakan.
            </div>
                    ');
             redirect('admin/aset/jenis/'.$this->input->post('id_jenis')); 
        } 
        else {
            $data = array(
                'nama'              => $this->input->post('nama'),
                'aset'              => $this->input->post('aset'),
                'stok'              => $stok,
                'nomor_inventaris'  => $nomor_inventaris,
                'merk'              => $this->input->post('merk'),
                'id_jenis'          => $this->input->post('id_jenis'),
                'tanggal_masuk'     => $this->input->post('tanggal_masuk'),
                'id_ruang'          => $this->input->post('id_ruang'),
                'status'            => 'Ada',
                'kondisi'           => 'Baik',
                'active'            => 1
             );  
            $this->CRUD_model->Insert('aset', $data);
            $data = array(
                'keterangan' => 'Ditambahkan',
                'nomor_inventaris' => $nomor_inventaris,
                'username' => $this->session->userdata('username'),
                'IP' => $this->input->ip_address()
             );  
            $this->CRUD_model->Insert('logs_aset', $data);
            $this->load->library('zend');  
            $this->zend->load('Zend/Barcode'); 
            $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$nomor_inventaris), array())->draw();
            $imageName = $nomor_inventaris.'.jpg';
            $imagePath = 'assets/upload/barcode/'; // penyimpanan file barcode
            imagejpeg($imageResource, $imagePath.$imageName); 
            $pathBarcode = $imagePath.$imageName; //Menyimpan path image bardcode kedatabase
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Aset '.$this->input->post('nama').' telah berhasil ditambahkan. Klik icon foto untuk menambahkan foto aset. 
            </div>
                    ');
            redirect('admin/aset/jenis/'.$this->input->post('id_jenis'));     
        }
    }
    public function uploadfoto(){
        $foto1 = $this->db->where('namafile', $this->input->post('nomor_inventaris').'1.jpg')->count_all_results('foto');
        $foto2 = $this->db->where('namafile', $this->input->post('nomor_inventaris').'2.jpg')->count_all_results('foto');
        $foto3 = $this->db->where('namafile', $this->input->post('nomor_inventaris').'3.jpg')->count_all_results('foto');
        if ($foto1 == 0) {
            $namafile = $this->input->post('nomor_inventaris').'1.jpg';
        } elseif ($foto2 == 0) {
            $namafile = $this->input->post('nomor_inventaris').'2.jpg';
        } elseif ($foto3 == 0) {
            $namafile = $this->input->post('nomor_inventaris').'3.jpg';
        } else {
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white mt-5">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Foto yang diupload hanya bisa 3 foto. 
            </div>
                    ');
            redirect('admin/aset/foto/'.$this->input->post('id_jenis').'/'.$this->input->post('nomor_inventaris'));            
        }

        $config['upload_path']          = 'assets/upload/aset/';
        $config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;
        $config['file_name']            = $namafile;
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 500 * 1024){
            $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white mt-5">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Foto yang diupload melebihi batas maksimal. Maksimal 500 KB. 
            </div>
                    ');
            redirect('admin/aset/foto/'.$this->input->post('id_jenis').'/'.$this->input->post('nomor_inventaris'));
        }  elseif( ! $this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
        }   

        $data = array(
            'nomor_inventaris' => $this->input->post('nomor_inventaris'),
            'namafile' => $namafile
         );  
        $this->CRUD_model->Insert('foto', $data);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white mt-5">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Foto berhasil diupload. 
        </div>
                ');
        redirect('admin/aset/foto/'.$this->input->post('id_jenis').'/'.$this->input->post('nomor_inventaris'));    
    }

    public function delete_data($id_jenis,$nomor_inventaris){
        foreach($this->Aset_model->foto_produk($nomor_inventaris) as $foto) {
            $filename=FCPATH.'/assets/upload/aset/'.$foto['namafile'];
            if (file_exists($filename)){
                unlink("./assets/upload/aset/".$foto['namafile']);
            }
        }
        $filename=FCPATH.'/assets/upload/barcode/'.$nomor_inventaris.'.jpg';
        if (file_exists($filename)){
            unlink("./assets/upload/barcode/".$nomor_inventaris.".jpg");
        }
        $where = array(
            'nomor_inventaris' => $nomor_inventaris
        );
        $data = $this->CRUD_model->Delete('aset',$where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Aset telah berhasil dihapus. 
        </div>
                ');
        redirect('admin/aset/jenis/'.$id_jenis);
    }
    public function delete_foto($id_jenis,$namafile,$kode_produk){
        $filename=FCPATH.'/assets/upload/aset/'.$namafile;
        if (file_exists($filename)){
            unlink("./assets/upload/aset/".$namafile);
        }
        $where = array(
            'namafile' => $namafile
        );
        $data = $this->CRUD_model->Delete('foto',$where);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-primary alert-dismissible" role="alert">
            Foto aset berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                ');
        redirect('admin/aset/foto/'.$id_jenis.'/'.$kode_produk);
    }
    public function foto($id_jenis,$nomor_inventaris){
        $nama = $this->Aset_model->get_jenis($id_jenis);
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Foto Aset | '.$site['nama_website'],
            'site'                  => $site,
            'nomor_inventaris'      => $nomor_inventaris
        );
        $this->db->select('*')->from('jenis');
        $this->db->order_by('jenis','ASC');
        $data2['jenis'] = $this->db->get()->result_array();
        $where = array('nomor_inventaris' => $nomor_inventaris);
        $data2['aset'] = $this->CRUD_model->edit_data($where,'aset')->result();
        $this->template->load('layout/template', 'admin/aset_foto', array_merge($data, $data2));
    }
    public function updatedata(){   
        if($this->input->post('aset')=="Tetap"){
            $stok = 1;
        } else {
            $stok = $this->input->post('stok');
        }
        $data = array(
            'nama'              => $this->input->post('nama'),
            'stok'              => $stok,
            'merk'              => $this->input->post('merk'),
            'id_jenis'          => $this->input->post('id_jenis'),
            'tanggal_masuk'     => $this->input->post('tanggal_masuk'),
            'id_ruang'          => $this->input->post('id_ruang'),
            'kondisi'           => $this->input->post('kondisi')
         );  
        $where = array(
            'nomor_inventaris' => $this->input->post('nomor_inventaris'),
        );
        $data = $this->CRUD_model->Update('aset', $data, $where);
        $this->session->set_flashdata('alert', '
        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white mt-5">
            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Aset '.$this->input->post('nama').' telah berhasil diperbarui. 
        </div>
                ');
        redirect('admin/aset/foto/'.$this->input->post('id_jenis').'/'.$this->input->post('nomor_inventaris'));
    }
    public function active($id_jenis,$kode_produk){
        $data = array('active' => 1); 
        $where = array('kode_produk' => $kode_produk);
        $data = $this->CRUD_model->Update('aset', $data, $where);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-primary alert-dismissible" role="alert">
            Produk yang dipilih telah ditampilkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                ');
        redirect('admin/aset/jenis/'.$id_jenis);
    }
    public function non_active($id_jenis,$kode_produk){
        $data = array('active' => 0); 
        $where = array('kode_produk' => $kode_produk);
        $data = $this->CRUD_model->Update('aset', $data, $where);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-primary alert-dismissible" role="alert">
            Produk yang dipilih telah disembunyikan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                ');
        redirect('admin/aset/jenis/'.$id_jenis);
    }
}
