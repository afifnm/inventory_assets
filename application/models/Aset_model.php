<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset_model extends CI_Model{
    
    public function jenis(){ //tampilkan semua jenis aset
        $this->db->select('*')->from('jenis');
        $this->db->order_by('jenis','ASC');
        return $this->db->get()->result_array();
    }
    public function logs(){ //tampilkan semua jenis aset
        $this->db->select('*')->from('logs');
        $this->db->order_by('id_logs','DESC');
        return $this->db->get()->result_array();
    }
    public function ruang(){ //tampilkan semua ruang
        $this->db->select('*')->from('ruang');
        $this->db->oeskrder_by('ruang','ASC');
        return $this->db->get()->result_array();
    }
    public function sumber_dana(){ //tampilkan semua ruang
        $this->db->select('*')->from('sumber_dana');
        $this->db->order_by('sumber_dana','ASC');
        return $this->db->get()->result_array();
    }
    public function get_jenis($id=NULL){ //tampilkan nama berdasarkan id_jenis
        $this->db->select('jenis')->from('jenis');
        $this->db->where('id_jenis',$id);
        return $this->db->get()->row()->jenis;
    }
    public function get_sumber_dana($id=NULL){ //tampilkan nama berdasarkan id_jenis
        $this->db->select('sumber_dana')->from('sumber_dana');
        $this->db->where('id_sumber_dana',$id);
        return $this->db->get()->row()->sumber_dana;
    }
    public function get_ruang($id){ //tampilkan nama berdasarkan id_jenis
        $this->db->select('ruang')->from('ruang');
        $this->db->where('id_ruang',$id);
        return $this->db->get()->row()->ruang;
    }
    public function get_nama_aset($id){ //tampilkan nama berdasarkan nomor_inventaris
        $this->db->select('nama')->from('aset');
        $this->db->where('nomor_inventaris',$id);
        return $this->db->get()->row()->nama;
    }
    public function get_nama($id){ //tampilkan nama berdasarkan nomor_inventaris
        $this->db->select('nama')->from('user');
        $this->db->where('username',$id);
        return $this->db->get()->row()->nama;
    }
    public function get_aset($nomor_inventaris){ //tampilkan semua foto berdasarkan nomor_inventaris
        $this->db->select('*')->from('aset');
        $this->db->where('nomor_inventaris',$nomor_inventaris);
        return $this->db->get()->result_array();
    }
    public function foto_aset($nomor_inventaris){ //tampilkan semua foto berdasarkan nomor_inventaris
        $this->db->select('*')->from('foto');
        $this->db->where('nomor_inventaris',$nomor_inventaris);
        return $this->db->get()->result_array();
    }
    public function logs_aset($nomor_inventaris){ //tampilkan semua logs berdasarkan nomor_inventaris
        $this->db->select('*')->from('logs');
        $this->db->where('nomor_inventaris',$nomor_inventaris);
        $this->db->order_by('datetime','DESC');
        return $this->db->get()->result_array();
    }
    public function count_foto_aset($nomor_inventaris){ //tampilkan semua foto berdasarkan nomor_inventaris
        $this->db->select('*')->from('foto');
        $this->db->where('nomor_inventaris',$nomor_inventaris);
        return $this->db->count_all_results();
    }
    public function count_jenis_aset($id_jenis){ //tampilkan semua foto berdasarkan nomor_inventaris
        $this->db->select('*')->from('aset');
        $this->db->where('id_jenis',$id_jenis);
        return $this->db->count_all_results();
    }
    public function count_ruang_aset($id_ruang){ //tampilkan semua foto berdasarkan nomor_inventaris
        $this->db->select('*')->from('aset');
        $this->db->where('id_ruang',$id_ruang);
        return $this->db->count_all_results();
    }
    public function compressImage($source, $destination, $quality) {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
        imagejpeg($image, $destination, $quality);
    }
    public function getPinjamAset(){
        $this->db->select('*')->from('aset a');
        $this->db->join('ruang b', 'b.id_ruang = a.id_ruang','left');
        $this->db->join('jenis c', 'c.id_jenis = a.id_jenis','right');
        $this->db->where('a.aset', 'Tetap'); 
        $this->db->where('a.status', 'Ada'); 
        $this->db->order_by('a.nama','ASC');
        return $this->db->get()->result_array();
   }
    public function getDipinjamAset($id){
        $this->db->select('b.*, a.nama')->from('detail_pinjam b');
        $this->db->join('aset a', 'b.nomor_inventaris = a.nomor_inventaris','left');
        $this->db->where('b.kode_pinjam', $id); 
        return $this->db->get()->result_array();
    }

    public function getTempAset(){
        $this->db->select('*')->from('temp a');
        $this->db->join('aset b', 'b.nomor_inventaris = a.nomor_inventaris','left');
        $this->db->join('jenis c', 'c.id_jenis = b.id_jenis','right');
        $this->db->join('ruang d', 'd.id_ruang = b.id_ruang','left');
        $this->db->where('username', $this->session->userdata('username'));
        return $this->db->get()->result_array();
   }
    public function getTempAsetKembali(){
        $this->db->select('*')->from('temp_kembali a');
        $this->db->join('aset b', 'b.nomor_inventaris = a.nomor_inventaris','left');
        $this->db->join('jenis c', 'c.id_jenis = b.id_jenis','right');
        $this->db->join('ruang d', 'd.id_ruang = b.id_ruang','left');
        $this->db->where('username', $this->session->userdata('username'));
        return $this->db->get()->result_array();
    }

    public function get_aset_dipinjam($id){ //tampilkan nama berdasarkan nomor_inventaris
        $nama = '';
        $this->db->select('b.nama')->from('detail_pinjam a');
        $this->db->join('aset b', 'b.nomor_inventaris = a.nomor_inventaris','left');
        $this->db->where('a.kode_pinjam',$id);
        $rows = $this->db->get()->result_array();
        foreach ($rows as $row){ $nama .= $row['nama'].', '; }
        return $nama;
    }

}
