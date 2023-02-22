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
        $this->db->order_by('ruang','ASC');
        return $this->db->get()->result_array();
    }
    public function get_jenis($id){ //tampilkan nama berdasarkan id_jenis
        $this->db->select('jenis')->from('jenis');
        $this->db->where('id_jenis',$id);
        return $this->db->get()->row()->jenis;
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
}