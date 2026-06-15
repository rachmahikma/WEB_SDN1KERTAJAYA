<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model([
            'admin/M_students',
            'admin/M_teachers',
            'admin/M_employees',
            'admin/M_users',
            'admin/M_grades',
            'dashboard/M_admin_dashboard',
            'dashboard/M_guru_dashboard',
            'dashboard/M_kepala_dashboard',
            'dashboard/M_siswa_dashboard',
        ]);

        if ( ! $this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    private function getUserData()
    {
        $role = $this->session->userdata('role');
        $labels = [
            'admin' => 'Admin / Tata Usaha',
            'guru' => 'Guru',
            'kepala' => 'Kepala Sekolah',
            'siswa' => 'Siswa',
        ];

        return [
            'username' => $this->session->userdata('username'),
            'role' => $role,
            'role_label' => isset($labels[$role]) ? $labels[$role] : ucfirst($role),
        ];
    }

    public function index()
    {
        $role = $this->session->userdata('role');

        switch ($role) {
            case 'admin':
                return $this->admin();
            case 'guru':
                return $this->guru();
            case 'kepala':
                return $this->kepala();
            case 'siswa':
                return $this->siswa();
            default:
                show_error('Hak akses tidak dikenali.', 403);
        }
    }

    public function admin()
    {
        $data = $this->getUserData();
        $data = array_merge($data, $this->M_admin_dashboard->get_counts());
        $this->load->view('dashboard/admin', $data);
    }

    public function guru()
    {
        $data = $this->getUserData();
        $data = array_merge($data, $this->M_guru_dashboard->get_overview());
        $this->load->view('dashboard/guru', $data);
    }

    public function kepala()
    {
        $data = $this->getUserData();
        $data = array_merge($data, $this->M_kepala_dashboard->get_summary());
        $this->load->view('dashboard/kepala', $data);
    }

    public function kepala_students()
    {
        $data = $this->getUserData();
        $data['students'] = $this->M_students->get_all();
        $this->load->view('dashboard/kepala_students', $data);
    }

    public function kepala_teachers()
    {
        $data = $this->getUserData();
        $data['teachers'] = $this->M_teachers->get_all();
        $this->load->view('dashboard/kepala_teachers', $data);
    }

    public function kepala_staff()
    {
        $data = $this->getUserData();
        $data['employees'] = $this->M_employees->get_all();
        $this->load->view('dashboard/kepala_staff', $data);
    }

    public function kepala_users()
    {
        $data = $this->getUserData();
        $data['users'] = $this->M_users->get_all();
        $this->load->view('dashboard/kepala_users', $data);
    }

    public function siswa()
    {
        $data = $this->getUserData();
        $student_id = $this->session->userdata('student_id');

        if ($data['role'] === 'siswa' && ! $student_id) {
            $student = $this->M_siswa_dashboard->find_student_by_username($data['username']);
            if ($student) {
                $student_id = $student['id'];
                $this->session->set_userdata([
                    'student_id' => $student_id,
                    'student_name' => $student['name'],
                    'student_class' => $student['class'],
                ]);
                $data['student_name'] = $student['name'];
                $data['student_class'] = $student['class'];
            }
        }

        if (! empty($this->session->userdata('student_name'))) {
            $data['student_name'] = $this->session->userdata('student_name');
        }

        if (! empty($this->session->userdata('student_class'))) {
            $data['student_class'] = $this->session->userdata('student_class');
        }

        $data = array_merge($data, $this->M_siswa_dashboard->get_summary($student_id));
        $this->load->view('dashboard/siswa', $data);
    }

    public function siswa_data()
    {
        $student_id = $this->session->userdata('student_id');
        $data = $this->getUserData();

        if (! $student_id || $data['role'] !== 'siswa') {
            redirect('dashboard');
            return;
        }

        $student = $this->M_students->get($student_id);
        if (! $student) {
            show_404();
        }

        // Get student_class dari session atau dari student data
        $student_class = $this->session->userdata('student_class');
        if (empty($student_class)) {
            $student_class = $student['class'];
        }

        $data['page_title'] = 'Data Siswa';
        $data['student'] = $student;
        
        // Get grades dari siswa dengan filter kelas yang sama (dari data guru kelas)
        $data['student_grades'] = $this->db
            ->select('grades.*, students.name as student_name, students.class')
            ->from('grades')
            ->join('students', 'students.id = grades.student_id', 'left')
            ->where('grades.student_id', $student_id)
            ->where('students.class', $student_class)
            ->order_by('grades.id', 'desc')
            ->get()
            ->result_array();
            
        $data['student_attendance'] = $this->db
            ->where('student_id', $student_id)
            ->order_by('date', 'desc')
            ->get('attendance')
            ->result_array();
            
        $data['student_achievements'] = $this->db
            ->where('student_id', $student_id)
            ->order_by('date', 'desc')
            ->get('achievements')
            ->result_array();

        foreach ($data['student_grades'] as &$grade) {
            $grade['classification'] = $this->getClassificationCategory((int) ($grade['final_score'] ?? 0));
        }
        unset($grade);

        $this->load->view('dashboard/siswa_data', $data);
    }

    public function manage_students($action = '', $id = null)
    {
        $data = $this->getUserData();
        $data['page_title'] = 'Kelola Data Siswa';
        $data['message'] = $this->session->flashdata('message');
        $data['message_type'] = $this->session->flashdata('message_type') ?: 'success';

        if ($action === 'add' || $action === 'edit') {
            $data['class_options'] = $this->M_students->get_class_options();

            if ($action === 'edit' && $id) {
                $data['form_data'] = $this->M_students->get($id);
                if (empty($data['form_data'])) {
                    show_404();
                }
            }

            if ($this->input->post()) {
                $this->form_validation->set_rules('nisn', 'NISN', 'required|trim');
                $this->form_validation->set_rules('name', 'Nama Siswa', 'required|trim');
                $this->form_validation->set_rules('class', 'Kelas', 'required|trim');
                $this->form_validation->set_rules('status', 'Status', 'required|trim');

                if ($this->form_validation->run()) {
                    $nisn = $this->input->post('nisn', TRUE);
                    if ($this->M_students->exists_nisn($nisn, $action === 'edit' ? $id : null)) {
                        $data['message'] = 'NISN sudah terdaftar.';
                        $data['message_type'] = 'danger';
                    } else {
                        $student = [
                            'nisn' => $nisn,
                            'name' => $this->input->post('name', TRUE),
                            'class' => $this->input->post('class', TRUE),
                            'status' => $this->input->post('status', TRUE),
                        ];

                        if ($action === 'add') {
                            $student['username'] = $this->M_students->generate_unique_username($student['name']);
                            $this->M_students->insert($student);
                            $this->M_users->insert([
                                'username' => $student['username'],
                                'password' => $nisn,
                                'role' => 'siswa',
                                'name' => $student['name'],
                            ]);
                            $this->session->set_flashdata('message', 'Data siswa berhasil ditambahkan dan username dibuat: ' . htmlspecialchars($student['username']));
                        } else {
                            $existingStudent = $this->M_students->get($id);
                            if (empty($existingStudent['username'])) {
                                $student['username'] = $this->M_students->generate_unique_username($student['name']);
                            }
                            $this->M_students->update($id, $student);
                            $this->session->set_flashdata('message', 'Data siswa berhasil diperbarui.');
                        }

                        $this->session->set_flashdata('message_type', 'success');
                        redirect('dashboard/manage_students');
                        return;
                    }
                }
            }

            $data['view_mode'] = 'form';
            $data['form_action'] = site_url('dashboard/manage_students/' . $action . ($id ? '/' . $id : ''));
            $data['submit_label'] = $action === 'edit' ? 'Simpan Perubahan' : 'Tambah Siswa';
            $this->load->view('manage/manage_students', $data);
            return;
        }

        if ($action === 'delete' && $id) {
            $this->M_students->delete($id);
            $this->session->set_flashdata('message', 'Data siswa berhasil dihapus.');
            $this->session->set_flashdata('message_type', 'success');
            redirect('dashboard/manage_students');
            return;
        }

        if ($action === 'generate_usernames') {
            $students = $this->M_students->get_all();
            $createdUsers = 0;
            $updatedStudents = 0;

            foreach ($students as $student) {
                $username = $student['username'] ?? '';
                if (empty($username)) {
                    $username = $this->M_students->generate_unique_username($student['name']);
                    $this->M_students->update($student['id'], ['username' => $username]);
                    $updatedStudents++;
                }

                if (! $this->M_users->exists_username($username)) {
                    $this->M_users->insert([
                        'username' => $username,
                        'password' => $student['nisn'],
                        'role' => 'siswa',
                        'name' => $student['name'],
                    ]);
                    $createdUsers++;
                }
            }

            $this->session->set_flashdata('message', 'Username siswa dibuat untuk ' . $updatedStudents . ' siswa dan ' . $createdUsers . ' akun baru ditambahkan.');
            $this->session->set_flashdata('message_type', 'success');
            redirect('dashboard/manage_students');
            return;
        }

        $data['students_by_class'] = $this->M_students->get_all_grouped_by_class();
        $data['class_options'] = $this->M_students->get_class_options();
        $data['view_mode'] = 'list';
        $this->load->view('manage/manage_students', $data);
    }

    public function manage_teachers($action = '', $id = null)
    {
        $data = $this->getUserData();
        $data['page_title'] = 'Kelola Data Guru';
        $data['message'] = $this->session->flashdata('message');
        $data['message_type'] = $this->session->flashdata('message_type') ?: 'success';

        if ($action === 'add' || $action === 'edit') {
            if ($action === 'edit' && $id) {
                $data['form_data'] = $this->M_teachers->get($id);
                if (empty($data['form_data'])) {
                    show_404();
                }
            }

            if ($this->input->post()) {
                $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
                $this->form_validation->set_rules('name', 'Nama Guru', 'required|trim');
                $this->form_validation->set_rules('subject', 'Mata Pelajaran', 'required|trim');

                if ($this->form_validation->run()) {
                    $nik = $this->input->post('nik', TRUE);
                    if ($this->M_teachers->exists_nik($nik, $action === 'edit' ? $id : null)) {
                        $data['message'] = 'NIK sudah terdaftar.';
                        $data['message_type'] = 'danger';
                    } else {
                        $teacher = [
                            'nik' => $nik,
                            'name' => $this->input->post('name', TRUE),
                            'subject' => $this->input->post('subject', TRUE),
                        ];

                        if ($action === 'add') {
                            $this->M_teachers->insert($teacher);
                            $this->session->set_flashdata('message', 'Data guru berhasil ditambahkan.');
                        } else {
                            $this->M_teachers->update($id, $teacher);
                            $this->session->set_flashdata('message', 'Data guru berhasil diperbarui.');
                        }

                        $this->session->set_flashdata('message_type', 'success');
                        redirect('dashboard/manage_teachers');
                        return;
                    }
                }
            }

            $data['view_mode'] = 'form';
            $data['form_action'] = site_url('dashboard/manage_teachers/' . $action . ($id ? '/' . $id : ''));
            $data['submit_label'] = $action === 'edit' ? 'Simpan Perubahan' : 'Tambah Guru';
            $this->load->view('manage/manage_teachers', $data);
            return;
        }

        if ($action === 'delete' && $id) {
            $this->M_teachers->delete($id);
            $this->session->set_flashdata('message', 'Data guru berhasil dihapus.');
            $this->session->set_flashdata('message_type', 'success');
            redirect('dashboard/manage_teachers');
            return;
        }

        $data['teachers'] = $this->M_teachers->get_all();
        $data['view_mode'] = 'list';
        $this->load->view('manage/manage_teachers', $data);
    }

    public function manage_staff($action = '', $id = null)
    {
        $data = $this->getUserData();
        $data['page_title'] = 'Kelola Data Karyawan';
        $data['message'] = $this->session->flashdata('message');
        $data['message_type'] = $this->session->flashdata('message_type') ?: 'success';

        if ($action === 'add' || $action === 'edit') {
            if ($action === 'edit' && $id) {
                $data['form_data'] = $this->M_employees->get($id);
                if (empty($data['form_data'])) {
                    show_404();
                }
            }

            if ($this->input->post()) {
                $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
                $this->form_validation->set_rules('name', 'Nama Karyawan', 'required|trim');
                $this->form_validation->set_rules('position', 'Jabatan', 'required|trim');

                if ($this->form_validation->run()) {
                    $nik = $this->input->post('nik', TRUE);
                    if ($this->M_employees->exists_nik($nik, $action === 'edit' ? $id : null)) {
                        $data['message'] = 'NIK sudah terdaftar.';
                        $data['message_type'] = 'danger';
                    } else {
                        $employee = [
                            'nik' => $nik,
                            'name' => $this->input->post('name', TRUE),
                            'position' => $this->input->post('position', TRUE),
                        ];

                        if ($action === 'add') {
                            $this->M_employees->insert($employee);
                            $this->session->set_flashdata('message', 'Data karyawan berhasil ditambahkan.');
                        } else {
                            $this->M_employees->update($id, $employee);
                            $this->session->set_flashdata('message', 'Data karyawan berhasil diperbarui.');
                        }

                        $this->session->set_flashdata('message_type', 'success');
                        redirect('dashboard/manage_staff');
                        return;
                    }
                }
            }

            $data['view_mode'] = 'form';
            $data['form_action'] = site_url('dashboard/manage_staff/' . $action . ($id ? '/' . $id : ''));
            $data['submit_label'] = $action === 'edit' ? 'Simpan Perubahan' : 'Tambah Karyawan';
            $this->load->view('manage/manage_staff', $data);
            return;
        }

        if ($action === 'delete' && $id) {
            $this->M_employees->delete($id);
            $this->session->set_flashdata('message', 'Data karyawan berhasil dihapus.');
            $this->session->set_flashdata('message_type', 'success');
            redirect('dashboard/manage_staff');
            return;
        }

        $data['employees'] = $this->M_employees->get_all();
        $data['view_mode'] = 'list';
        $this->load->view('manage/manage_staff', $data);
    }

    public function manage_users($action = '', $id = null)
    {
        $data = $this->getUserData();
        $data['page_title'] = 'Kelola Pengguna';
        $data['message'] = $this->session->flashdata('message');
        $data['message_type'] = $this->session->flashdata('message_type') ?: 'success';
        $data['roles'] = ['admin' => 'Admin', 'guru' => 'Guru', 'kepala' => 'Kepala Sekolah', 'siswa' => 'Siswa'];

        if ($action === 'add' || $action === 'edit') {
            if ($action === 'edit' && $id) {
                $data['form_data'] = $this->M_users->get($id);
                if (empty($data['form_data'])) {
                    show_404();
                }
            }

            if ($this->input->post()) {
                $this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim');
                $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
                $this->form_validation->set_rules('role', 'Peran', 'required|trim|in_list[admin,guru,kepala,siswa]');
                if ($action === 'add') {
                    $this->form_validation->set_rules('password', 'Kata Sandi', 'required|trim');
                }

                if ($this->form_validation->run()) {
                    $username = $this->input->post('username', TRUE);
                    if ($this->M_users->exists_username($username, $action === 'edit' ? $id : null)) {
                        $data['message'] = 'Nama pengguna sudah digunakan.';
                        $data['message_type'] = 'danger';
                    } else {
                        $user = [
                            'username' => $username,
                            'name' => $this->input->post('name', TRUE),
                            'role' => $this->input->post('role', TRUE),
                        ];

                        $password = $this->input->post('password', TRUE);
                        if ($action === 'add' || !empty($password)) {
                            $user['password'] = $password;
                        }

                        if ($action === 'add') {
                            $this->M_users->insert($user);
                            $this->session->set_flashdata('message', 'Pengguna berhasil ditambahkan.');
                        } else {
                            $this->M_users->update($id, $user);
                            $this->session->set_flashdata('message', 'Pengguna berhasil diperbarui.');
                        }

                        $this->session->set_flashdata('message_type', 'success');
                        redirect('dashboard/manage_users');
                        return;
                    }
                }
            }

            $data['view_mode'] = 'form';
            $data['form_action'] = site_url('dashboard/manage_users/' . $action . ($id ? '/' . $id : ''));
            $data['submit_label'] = $action === 'edit' ? 'Simpan Perubahan' : 'Tambah Pengguna';
            $this->load->view('manage/manage_users', $data);
            return;
        }

        if ($action === 'delete' && $id) {
            $this->M_users->delete($id);
            $this->session->set_flashdata('message', 'Pengguna berhasil dihapus.');
            $this->session->set_flashdata('message_type', 'success');
            redirect('dashboard/manage_users');
            return;
        }

        $data['users'] = $this->M_users->get_all();
        $data['view_mode'] = 'list';
        $this->load->view('manage/manage_users', $data);
    }

    public function academic_data($action = '', $id = null)
    {
        $data = $this->getUserData();
        $data['page_title'] = 'Data Akademik';
        $data['message'] = $this->session->flashdata('message');
        $data['message_type'] = $this->session->flashdata('message_type') ?: 'success';
        $data['students'] = $this->M_students->get_all();

        if ($action === 'add' || $action === 'edit') {
            if ($action === 'edit' && $id) {
                $data['form_data'] = $this->M_grades->get($id);
                if (empty($data['form_data'])) {
                    show_404();
                }
            }

            if ($this->input->post()) {
                $this->form_validation->set_rules('student_id', 'Nama Siswa', 'required|integer');
                $this->form_validation->set_rules('subject', 'Mata Pelajaran', 'required|trim');
                $this->form_validation->set_rules('score', 'Nilai Akademik', 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]');
                $this->form_validation->set_rules('attendance_score', 'Skor Absensi', 'integer|greater_than_equal_to[0]|less_than_equal_to[100]');
                $this->form_validation->set_rules('attitude_score', 'Skor Sikap', 'integer|greater_than_equal_to[0]|less_than_equal_to[100]');
                $this->form_validation->set_rules('extracurricular_score', 'Skor Ekstrakulikuler', 'integer|greater_than_equal_to[0]|less_than_equal_to[100]');
                $this->form_validation->set_rules('semester', 'Semester', 'required|trim');

                if ($this->form_validation->run()) {
                    // Collect component scores
                    $academic = (int) $this->input->post('score', TRUE);
                    $attendance = (int) $this->input->post('attendance_score', TRUE) ?: 0;
                    $attitude = (int) $this->input->post('attitude_score', TRUE) ?: 0;
                    $extracurricular = (int) $this->input->post('extracurricular_score', TRUE) ?: 0;

                    // Default weights: akademik 60%, absensi 10%, sikap 15%, ekstrakulikuler 15%
                    $final = (int) round($academic * 0.6 + $attendance * 0.1 + $attitude * 0.15 + $extracurricular * 0.15);

                    $grade = [
                        'student_id' => $this->input->post('student_id', TRUE),
                        'subject' => $this->input->post('subject', TRUE),
                        'score' => $academic,
                        'attendance_score' => $attendance,
                        'attitude_score' => $attitude,
                        'extracurricular_score' => $extracurricular,
                        'final_score' => $final,
                        'semester' => $this->input->post('semester', TRUE),
                    ];

                    if ($action === 'add') {
                        $this->M_grades->insert($grade);
                        $this->session->set_flashdata('message', 'Nilai akademik berhasil ditambahkan.');
                    } else {
                        $this->M_grades->update($id, $grade);
                        $this->session->set_flashdata('message', 'Nilai akademik berhasil diperbarui.');
                    }

                    $this->session->set_flashdata('message_type', 'success');
                    redirect('dashboard/academic_data');
                    return;
                }
            }

            $data['view_mode'] = 'form';
            $data['form_action'] = site_url('dashboard/academic_data/' . $action . ($id ? '/' . $id : ''));
            $data['submit_label'] = $action === 'edit' ? 'Simpan Perubahan' : 'Tambah Nilai';
            $this->load->view('manage/academic_data', $data);
            return;
        }

        if ($action === 'delete' && $id) {
            $this->M_grades->delete($id);
            $this->session->set_flashdata('message', 'Catatan akademik berhasil dihapus.');
            $this->session->set_flashdata('message_type', 'success');
            redirect('dashboard/academic_data');
            return;
        }

        $grades = $this->M_grades->get_all();
        foreach ($grades as &$grade) {
            $grade['classification'] = $this->getClassificationCategory((int) ($grade['final_score'] ?? 0));
        }
        unset($grade);

        $data['grades'] = $grades;
        $data['view_mode'] = 'list';
        $this->load->view('manage/academic_data', $data);
    }

    private function getClassificationCategory($score)
    {
        if ($score >= 85) {
            return 'Tinggi';
        }

        if ($score >= 70) {
            return 'Sedang';
        }

        return 'Rendah';
    }

    public function logout()
    {
        $redirect = $this->input->get('redirect');
        $this->session->sess_destroy();

        if ($redirect === 'home') {
            redirect('home');
        }

        redirect('login?logout=1');
    }
}
