<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('id', 'desc')->get('users')->result_array();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->get('users')->row_array();
    }

    public function get_by_username($username)
    {
        return $this->db->where('username', $username)->get('users')->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('users');
    }

    public function exists_username($username, $except_id = null)
    {
        $this->db->where('username', $username);
        if ($except_id) {
            $this->db->where('id !=', $except_id);
        }
        return $this->db->count_all_results('users') > 0;
    }
}
