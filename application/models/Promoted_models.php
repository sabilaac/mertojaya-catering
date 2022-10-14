<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promoted_models extends CI_Model
{
	public function insert($data)
	{
		$insert = $this->db->insert("promoted", $data);
		if ($insert) {
			return true;
		}
		return false;
	}

	public function delete($filter = null)
	{
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("id", $filter['id']);
			}
			if (isset($filter['url'])) {
				$this->db->where("url", $filter['url']);
			}
		}
		$delete = $this->db->delete("promoted");
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}
