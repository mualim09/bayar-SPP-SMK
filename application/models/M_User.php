<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {

   //Membuat var global untuk tabel 
   private $_tableSiswa = 'siswa';
   private $_tablePetugas = 'petugas'; 

   public function login()
   {
       //Membuat var $post untuk mempersingkat penulisan
       $post = $this->input->post();

       //CARI NIS sesuai yang User input
       $this->db->where('nis', $post['username']);
       $siswa = $this->db->get($this->_tableSiswa)->row_array();
    
       //CARI Username sesuai yang User input yang Levelnya "ADMIN"
       $this->db->where('username', $post['username']);
       $this->db->where('level', 'admin');
       $admin = $this->db->get($this->_tablePetugas)->row_array();

        //CARI Username sesuai yang User input yang Levelnya "PETUGAS"
       $this->db->where('username', $post['username']);
       $this->db->where('level', 'petugas');
       $petugas = $this->db->get($this->_tablePetugas)->row_array();

       //Masukan kedalam array $who agar nama var nya sama
       $who = [
           $siswa, $admin, $petugas
       ];
       
       //Ambil array yang bernilai NULL lalu masukan kedalam var baru
       $result = array_search(!NULL, $who);
       $user = $who[$result];

       //Jika USERnya ada CEK ROLE
       if($user) {
           if ($user['role'] == 1 || $user['role'] == 2)
           {
               //CEK PW
                if(password_verify($post['password'], $user['password'])) 
                {
                    //SIMPAN SESSION KE DALAM $data
                    $data = [
                        'username' => $user['username'],
                        'nama' => $user['nama'],
                        'level' => $user['level'],
                        'role' => $user['role']
                    ];
                    $this->session->set_userdata($data);

                    if ($user['level'] == "admin")
                    {
                        redirect('administrator');
                    } else {
                        redirect('petugas');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata sandi salah!</div>');
                    redirect('auth');
                }
           } else {
            $data = [
                'username' => $user['nisn'],
                'username' => $user['nis'],
                'nama' => $user['nama'],
                'role' => $user['role']
            ];
            $this->session->set_userdata($data);
              redirect('siswa');
           }
       } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
        redirect('auth');
       }
   }

   public function dataSiswa()
   {
       return $this->db->get($this->_tableSiswa)->result_array();
   }

}