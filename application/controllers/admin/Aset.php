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
        $this->db->select('a.*,b.ruang')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
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
        date_default_timezone_set("Asia/Jakarta");
        $time = date('YmdHis').'.jpg';
        $config['upload_path']          = 'assets/upload/images/aset/';
        $config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;
        $config['file_name']            = $time;
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 500 * 1024){
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger alert-dismissible" role="alert">
                Ukuran foto terlalu besar, upload ulang foto dengan ukuran yang kurang dari 500 KB.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                    ');
            redirect('admin/aset/foto/'.$this->input->post('kode_produk'));  
        }  elseif( ! $this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
        }   

        $data = array(
            'kode_produk' => $this->input->post('kode_produk'),
            'namafile' => $time
         );  
        $this->CRUD_model->Insert('foto', $data);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-primary alert-dismissible" role="alert">
            Foto aset berhasil ditambahkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                ');
        redirect('admin/aset/foto/'.$this->input->post('id_jenis').'/'.$this->input->post('kode_produk'));       
    }

    public function delete_data($id_jenis,$nomor_inventaris){
        foreach($this->Aset_model->foto_produk($nomor_inventaris) as $foto) {
            $filename=FCPATH.'/assets/upload/images/aset/'.$foto['namafile'];
            if (file_exists($filename)){
                unlink("./assets/upload/images/aset/".$foto['namafile']);
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
        $filename=FCPATH.'/assets/upload/images/aset/'.$namafile;
        if (file_exists($filename)){
            unlink("./assets/upload/images/aset/".$namafile);
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
    public function editdata($id_jenis,$id){
        $nama = $this->CRUD_model->get_jenis($id_jenis);
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Perbarui Produk | '.$site['nama_website'],
            'site'                  => $site,
            'nav'                   => '
                <a class="navigasi-link"> Produk</a>
                &nbsp; / &nbsp; <a class="navigasi-link" href="'.site_url('admin/aset/jenis/'.$id_jenis).'">'.$nama.'</a>
                &nbsp; / &nbsp; '.$id.'
            '
        );
        $this->db->select('*')->from('jenis');
        $this->db->order_by('jenis','ASC');
        $data2['jenis'] = $this->db->get()->result_array();
        $where = array('kode_produk' => $id);
        $data2['aset'] = $this->CRUD_model->edit_data($where,'aset')->result();
        $this->template->load('layout/template', 'admin/produk_edit', array_merge($data, $data2));
    }
    public function foto($id_jenis,$id){
        $nama = $this->CRUD_model->get_jenis($id_jenis);
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Foto Produk | '.$site['nama_website'],
            'site'                  => $site,
            'nav'                   => '
                <a class="navigasi-link"> Produk</a>
                &nbsp; / &nbsp; <a class="navigasi-link" href="'.site_url('admin/aset/jenis/'.$id_jenis).'">'.$nama.'</a>
                &nbsp; / &nbsp; '.$id.'
            '
        );
        $this->db->select('*')->from('jenis');
        $this->db->order_by('jenis','ASC');
        $data2['jenis'] = $this->db->get()->result_array();
        $where = array('kode_produk' => $id);
        $data2['aset'] = $this->CRUD_model->edit_data($where,'aset')->result();
        $this->template->load('layout/template', 'admin/produk_foto', array_merge($data, $data2));
    }
    public function updatedata(){   
        $data = array(
            'nama' => $this->input->post('nama'),
            'id_jenis' => $this->input->post('jenis'),
            'harga' => $this->input->post('harga'),
            'deskripsi' => $this->input->post('deskripsi'),
         ); 
        $where = array(
            'id_produk' => $this->input->post('id'),
        );
        $data = $this->CRUD_model->Update('aset', $data, $where);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-primary alert-dismissible" role="alert">
            Produk berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                ');
        redirect('admin/aset/jenis/'.$this->input->post('jenis'));
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
