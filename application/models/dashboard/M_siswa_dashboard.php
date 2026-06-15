<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa_dashboard extends CI_Model {
    public function get_summary($student_id = null)
    {
        if ($student_id === null) {
            return [
                'grades_count' => 0,
                'attendance_count' => 0,
                'achievements_count' => 0,
            ];
        }

        return [
            'grades_count' => (int) $this->db->where('student_id', $student_id)->count_all_results('grades'),
            'attendance_count' => (int) $this->db->where('student_id', $student_id)->count_all_results('attendance'),
            'achievements_count' => (int) $this->db->where('student_id', $student_id)->count_all_results('achievements'),
        ];
    }

    public function find_student_by_username($username)
    {
        $normalized = strtolower(str_replace(' ', '', $username));
        return $this->db
            ->where("LOWER(REPLACE(name, ' ', '')) =", $normalized)
            ->get('students')
            ->row_array();
    }
}
