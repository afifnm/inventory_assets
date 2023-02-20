<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset_model extends CI_Model{
    
    public function jenis(){ //tampilkan semua jenis aset
        $this->db->select('*')->from('jenis');
        $this->db->order_by('jenis','ASC');
        return $this->db->get()->result_array();
    }
    public function ruang(){ //tampilkan semua ruang
        $this->db->select('*')->from('ruang');
        $this->db->order_by('ruang','ASC');
        return $this->db->get()->result_array();
    }
    public function get_jenis($id){ //tampilkan nama berdasarkan id_jenis
        $this->db->select('jenis')->from('jenis');
        $this->db->where('id_jenis',$id);
        return $this->db->get()->row()->jenis;
    }
    public function foto_produk($nomor_inventaris){ //tampilkan semua foto berdasarkan nomor_inventaris
        $this->db->select('*')->from('foto');
        $this->db->where('nomor_inventaris',$nomor_inventaris);
        return $this->db->get()->result_array();
    }
}