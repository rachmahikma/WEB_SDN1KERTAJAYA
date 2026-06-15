<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model('admin/M_students');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $data = [
            'message' => $this->session->flashdata('message') ?: '',
            'message_type' => $this->session->flashdata('message_type') ?: 'info',
            'username' => '',
        ];

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->db->where('username', $username)
                             ->where('password', $password)
                             ->get('users')
                             ->row_array();

            if ($user) {
                $sessionData = [
                    'logged_in' => TRUE,
                    'username' => $user['username'],
                    'role' => $user['role'],
                ];

                if ($user['role'] === 'siswa') {
                    $student = $this->M_students->get_by_username($user['username']);
                    if (empty($student)) {
                        $studentName = strtolower(str_replace(' ', '', $user['username']));
                        $student = $this->db
                            ->where("LOWER(REPLACE(name, ' ', '')) =", $studentName)
                            ->get('students')
                            ->row_array();
                    }

                    if ($student) {
                        $sessionData['student_id'] = $student['id'];
                        $sessionData['student_name'] = $student['name'];
                        $sessionData['student_class'] = $student['class'];
                    }
                }

                $this->session->set_userdata($sessionData);

                redirect('dashboard');
                return;
            }

            $data['message'] = 'Username atau password salah. Coba lagi.';
            $data['message_type'] = 'danger';
            $data['username'] = $username;
        }

        $this->load->view('template/login_template', $data);
    }

    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $data = [
            'message' => '',
            'message_type' => 'info',
            'nisn' => '',
            'name' => '',
            'class' => '',
            'class_options' => $this->M_students->get_class_options(),
            'view_file' => 'register',
        ];

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $name = $this->input->post('name', TRUE);
            $nisn = $this->input->post('nisn', TRUE);
            $password = $this->input->post('password', TRUE);
            $confirmPassword = $this->input->post('confirm_password', TRUE);
            $class = $this->input->post('class', TRUE);

            $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
            $this->form_validation->set_rules('nisn', 'NISN', 'required|trim');
            $this->form_validation->set_rules('password', 'Kata Sandi', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Kata Sandi', 'required|matches[password]');
            $this->form_validation->set_rules('class', 'Kelas', 'required|trim');

            if ($this->form_validation->run()) {
                if ($this->M_students->exists_nisn($nisn)) {
                    $data['message'] = 'NISN sudah terdaftar. Gunakan NISN lain atau hubungi admin.';
                    $data['message_type'] = 'danger';
                } else {
                    $username = $this->generateUniqueUsername($name);

                    $this->db->insert('users', [
                        'username' => $username,
                        'password' => $password,
                        'role' => 'siswa',
                        'name' => $name,
                    ]);

                    $this->M_students->insert([
                        'nisn' => $nisn,
                        'name' => $name,
                        'class' => $class,
                        'status' => 'Aktif',
                        'username' => $username,
                    ]);

                    $this->session->set_flashdata('message', 'Akun berhasil dibuat. Username Anda: ' . $username);
                    $this->session->set_flashdata('message_type', 'success');
                    redirect('login');
                    return;
                }
            }

            $data['name'] = $name;
            $data['nisn'] = $nisn;
            $data['class'] = $class;
        }

        $this->load->view('template/login_template', $data);
    }

    private function generateUniqueUsername($name)
    {
        $base = strtolower(preg_replace('/[^a-z0-9]+/', '', trim($name)));
        if ($base === '') {
            $base = 'siswa';
        }

        $username = $base;
        $counter = 1;
        while (
            $this->db->where('username', $username)->count_all_results('users') > 0 ||
            $this->db->where('username', $username)->count_all_results('students') > 0
        ) {
            $username = $base . $counter++;
        }

        return $username;
    }
}
