<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_models extends CI_Model
{
	public $hash = '<3vn=`#\"NNe>/-t';

	public function get($filter = null, $page = 0, $limit = null)
	{
		$res = null;
		if ($filter) {
			if($filter->id) {
				$this->db->where("id", $filter->id);
			}
			if($filter->user_id) {
				$this->db->where("status", $filter->user_id);
			}
			if($filter->status) {
				$this->db->where("status", $filter->status);
			}
		}
		if($limit) {
			$this->db->limit($limit, $page * $limit);
		}
		$data = $this->db->get("user")->result();
		return $res = $data;
	}

	public function login($data)
	{
		$res = null;
		$this->db->where('username', $data['username']);
		$this->db->where('password', md5($data['password'] . $this->hash));
		$data = $this->db->get("user")->result();
		if (sizeof($data) > 0) {
			$res = $data;
		}
		return $res;
	}
}
