<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_employees extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('id', 'desc')->get('employees')->result_array();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->get('employees')->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('employees', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('employees', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('employees');
    }

    public function exists_nik($nik, $except_id = null)
    {
        $this->db->where('nik', $nik);
        if ($except_id) {
            $this->db->where('id !=', $except_id);
        }
        return $this->db->count_all_results('employees') > 0;
    }
}
