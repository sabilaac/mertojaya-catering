<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback_models extends CI_Model
{

	public function get($filter = null, $page = 0, $limit = null)
	{
		$res = null;
		if ($filter) {
			if(isset($filter['id'])) {
				$this->db->where("id", $filter['id']);
			}
			if(isset($filter['status'])) {
				$this->db->where("status", $filter['status']);
			}
		}
		if($limit) {
			$this->db->limit($limit, $page * $limit);
		}
		$data = $this->db->get("feedback")->result();
		return $res = $data;
	}

	public function insert($data)
	{
		$insert = $this->db->insert("feedback", $data);
		if ($insert) {
			return true;
		}
		return false;
	}

	public function update($filter, $data)
	{
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("id", $filter['id']);
			}
		}
		$update = $this->db->update("feedback", $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($filter = null)
	{
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("id", $filter['id']);
			}
		}
		$delete = $this->db->delete("feedback");
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}
