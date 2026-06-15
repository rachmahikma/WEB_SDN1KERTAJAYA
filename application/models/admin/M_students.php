<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_students extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('id', 'desc')->get('students')->result_array();
    }

    public function get_all_grouped_by_class()
    {
        $students = $this->db
            ->order_by('class', 'asc')
            ->order_by('name', 'asc')
            ->get('students')
            ->result_array();

        $grouped = [];
        foreach ($students as $student) {
            $classKey = trim($student['class']);
            if ($classKey === '') {
                $classKey = 'Lainnya';
            }
            $grouped[$classKey][] = $student;
        }

        return $grouped;
    }

    public function exists_username($username, $except_id = null)
    {
        $this->db->where('username', $username);
        if ($except_id) {
            $this->db->where('id !=', $except_id);
        }
        return $this->db->count_all_results('students') > 0;
    }

    public function generate_unique_username($name)
    {
        $base = strtolower(preg_replace('/[^a-z0-9]+/', '', $name));
        if ($base === '') {
            $base = 'siswa';
        }

        $username = $base;
        $counter = 1;

        while (
            $this->db->where('username', $username)->count_all_results('students') > 0 ||
            $this->db->where('username', $username)->count_all_results('users') > 0
        ) {
            $username = $base . $counter++;
        }

        return $username;
    }

    public function get_by_username($username)
    {
        return $this->db->where('username', $username)->get('students')->row_array();
    }

    public function get_class_options()
    {
        return [
            '1' => 'Kelas 1',
            '2' => 'Kelas 2',
            '3' => 'Kelas 3',
            '4' => 'Kelas 4',
            '5' => 'Kelas 5',
            '6' => 'Kelas 6',
        ];
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->get('students')->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('students', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('students', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('students');
    }

    public function exists_nisn($nisn, $except_id = null)
    {
        $this->db->where('nisn', $nisn);
        if ($except_id) {
            $this->db->where('id !=', $except_id);
        }
        return $this->db->count_all_results('students') > 0;
    }
}
