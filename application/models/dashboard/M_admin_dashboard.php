<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin_dashboard extends CI_Model {
    public function get_counts()
    {
        return [
            'students_count' => (int) $this->db->count_all('students'),
            'teachers_count' => (int) $this->db->count_all('teachers'),
            'employees_count' => (int) $this->db->count_all('employees'),
            'users_count' => (int) $this->db->count_all('users'),
            'grades_count' => (int) $this->db->count_all('grades'),
            'attendance_count' => (int) $this->db->count_all('attendance'),
            'achievements_count' => (int) $this->db->count_all('achievements'),
        ];
    }
}
