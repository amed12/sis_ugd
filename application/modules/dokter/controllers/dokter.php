<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokter extends CI_Controller {

    public function index() {
        if ($this->session->userdata('tipe') == 'tbl_pengguna') {
            $data['header'] = 'header';
            $data['content'] = 'logindokter';
            $data['footer'] = 'footer';
            $data['tipe'] = $this->session->userdata('tipe');
            $this->load->view('mainview', $data);
        } else {
            $data['header'] = 'header';
            $data['content'] = 'dokter';
            $data['footer'] = 'footer';
            $this->load->view('mainview', $data);
        }
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric');
        if ($this->form_validation->run() == FALSE) {
            $data['header'] = 'header';
            $data['content'] = 'dokter';
            $data['footer'] = 'footer';
            $this->load->view('mainview', $data);
        } else {
            $this->load->model('modeldokter');
            $valid_user = $this->modeldokter->login_dokter();
            if ($valid_user == FALSE) {
                $data['header'] = 'header';
                $data['content'] = 'dokter';
                $data['footer'] = 'footer';
                $this->load->view('mainview', $data);
            } else {
                $this->session->set_userdata('username', $valid_user->USERNAME);
                $this->session->set_userdata('level', $valid_user->LEVEL);

                switch ($valid_user->level) {
                    case 1: //dokter
                        echo 'Login sukses';
//                        if ($this->session->userdata('level') == 'tbl_pengguna') {
//                            $data['header'] = 'header';
//                            $data['content'] = 'logindokter';
//                            $data['footer'] = 'footer';
//                            $data['tipe'] = $this->session->userdata('tipe');
//                            $this->load->view('mainview', $data);
//                        } else {
//                            $data['header'] = 'header';
//                            $data['content'] = 'dokter';
//                            $data['footer'] = 'footer';
//                            $this->load->view('mainview', $data);
//                        }
                        break;

                    default:
                        break;
                }
            }
        }
    }

}
