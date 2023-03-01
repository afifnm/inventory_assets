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
		 $this->db->where('active', 0); 
		 $this->db->where('status', 'Ada'); 
		 return $this->db->get()->result_array();
	}

    public function getTempAset(){
		 $this->db->select('*')->from('temp');
		 $this->db->where('username', $this->session->userdata('username'));
		 return $this->db->get()->result_array();
	}

}
