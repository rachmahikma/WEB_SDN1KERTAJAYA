<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_guru_dashboard extends CI_Model {
    public function get_overview()
    {
        $subjects = $this->db
            ->select('COUNT(DISTINCT subject) AS total')
            ->get('grades')
            ->row();

        $classes = $this->db
            ->select('COUNT(DISTINCT class) AS total')
            ->get('students')
            ->row();

        return [
            'students_count' => (int) $this->db->count_all('students'),
            'classes_count' => (int) ($classes->total ?? 0),
            'grades_count' => (int) $this->db->count_all('grades'),
            'attendance_count' => (int) $this->db->count_all('attendance'),
            'subjects_count' => (int) ($subjects->total ?? 0),
        ];
    }
}
