<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_grades extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db
            ->select('grades.*, students.name AS student_name')
            ->from('grades')
            ->join('students', 'students.id = grades.student_id', 'left')
            ->order_by('grades.id', 'desc')
            ->get()
            ->result_array();
    }

    public function get($id)
    {
        return $this->db->where('grades.id', $id)
            ->select('grades.*, students.name AS student_name')
            ->from('grades')
            ->join('students', 'students.id = grades.student_id', 'left')
            ->get()
            ->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('grades', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('grades', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('grades');
    }
}
