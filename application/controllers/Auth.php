<?php defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('Auth_model');
        $this->load->model('CRUD_model');
        $this->load->helper('url');
    }

    public function check_account()
    {
        //validasi login
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        //ambil data dari database untuk validasi login
        $query = $this->Auth_model->check_account($username, $password);

        if ($query === 1) {
            $this->session->set_flashdata('alert', '
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                    <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Username tidak terdaftar. 
                </div>
                    ');
          }
        elseif ($query === 2) {
            $this->session->set_flashdata('alert', '
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                    <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Password salah. 
                </div>
                    ');
        } else {
            //membuat session dengan nama userData yang artinya nanti data ini bisa di ambil sesuai dengan data yang login
            $userdata = array(
              'is_login'    => true,
              'id'          => $query->id,
              'password'    => $query->password,
              'username'    => $query->username,
              'level'       => $query->level,
              'nama'        => $query->nama,
              'alamat'        => $query->alamat,
              'no_hp'        => $query->no_hp,
              'foto'        => $query->foto,
              'last_login'  => $query->last_login
            );
            $this->session->set_userdata($userdata);
            return true;
        }
    }
    public function login()
    {
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'     => 'Login | '.$site['nama_website'],
            'site'      => $site
        );
        //melakukan pengalihan halaman sesuai dengan levelnya
        if ($this->session->userdata('level') == "Admin") {
            redirect('admin/home');
        } 
        if ($this->session->userdata('level') == "Staff") {
            redirect('admin/home');
        } 
        //proses login dan validasi nya
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
            $error = $this->check_account();

            if ($this->form_validation->run() && $error === true) {
                $data = $this->Auth_model->check_account($this->input->post('username'), $this->input->post('password'));
                //jika bernilai TRUE maka alihkan halaman sesuai dengan level nya
                if ($data->level == 'Admin') {
                    redirect('admin/home');
                } elseif ($data->level == 'Staff') {
                    redirect('admin/home');
                }
            } else {
                $this->load->view('authentication/login', $data);
            }
        } else {
            $this->load->view('authentication/login', $data);
        }
    } 
    public function logout(){ 
        $this->session->sess_destroy();
        redirect('home');
    }
    function profile(){
        $data['user'] = $this->Auth_model->tampil_data()->result();
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'My Profile | '.$site['nama_website'],
            'site'                  => $site,
            'nav'                   => '
                <a class="navigasi-link">Account</a>
                    &nbsp; / &nbsp; <b> <i>My Profile</i></b>
            '
        );
        $this->template->load('layout/template', 'authentication/profile', $data);
    }
    function password(){
        $data['user'] = $this->Auth_model->tampil_data()->result();
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Password | '.$site['nama_website'],
            'site'                  => $site,
            'nav'                   => '
                <a class="navigasi-link">Account</a>
                    &nbsp; / &nbsp; <b> <i>Password</i></b>
            '
        );
        $this->template->load('layout/template', 'authentication/password', $data);
    }
    public function updatePassword()
    {
        $id = $this->session->userdata('id');
            if (password_verify($this->input->post('passLama'), $this->session->userdata('password'))) {
                if ($this->input->post('passBaru') != $this->input->post('passKonf')) {
                    $this->session->set_flashdata('alert', '
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                        <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Konfirmasi password salah. 
                    </div>
                            ');
                    redirect('admin/pengguna/reset'); 
                } else {
                    $data = ['password' => get_hash($this->input->post('passBaru'))];
                    $result = $this->Auth_model->update($data, $id);
                    if ($result > 0) {
                        $this->Auth_model->update($data, $data['password'], 'user');
                        $this->session->set_flashdata('alert', '
                        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Password berhasil diubah. 
                        </div>
                                ');
                        $userdata = array(
                            'password' => $data['password']
                        );
                        $this->session->set_userdata($userdata);
                        redirect('admin/pengguna/reset'); 
                    } else {
                        $this->session->set_flashdata('alert', '
                        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Password gagal diubah. 
                        </div>
                                ');
                        redirect('admin/pengguna/reset'); 
                    }
                }
            } else {
                $this->session->set_flashdata('alert', '
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                    <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Password salah. 
                </div>
                        ');
                redirect('admin/pengguna/reset'); 
            }
    }
    public function updateProfile()
    {
        $id = $this->session->userdata('id');
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $no_hp = $this->input->post('no_hp');
        $data = array(
            'nama' => $nama,
            'username' => $username,
            'alamat' => $alamat,
            'no_hp' => $no_hp
        );
        $userdata = array(
            'nama' => $nama,
            'username' => $username,
            'alamat' => $alamat,
            'no_hp' => $no_hp
        );
        $this->session->set_userdata($userdata);
        $result = $this->Auth_model->update($data, $id);
        $this->session->set_flashdata('alert', '
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-1 text-white">
                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Pengguna berhasil diperbarui. 
            </div>
                ');
        redirect('admin/pengguna/profile');
    }

}