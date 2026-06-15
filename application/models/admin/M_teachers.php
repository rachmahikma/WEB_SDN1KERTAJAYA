<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_teachers extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('id', 'desc')->get('teachers')->result_array();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->get('teachers')->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('teachers', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('teachers', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('teachers');
    }

    public function exists_nik($nik, $except_id = null)
    {
        $this->db->where('nik', $nik);
        if ($except_id) {
            $this->db->where('id !=', $except_id);
        }
        return $this->db->count_all_results('teachers') > 0;
    }
}
