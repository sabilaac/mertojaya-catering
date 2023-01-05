<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Storage_models extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('helper_models');
	}

	public function get($filter = null, $page = 0, $limit = null, $order = array('storage.date_created', 'desc'))
	{
		$res = null;
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("id", $filter['id']);
			}
			if (isset($filter['uuid'])) {
				$this->db->where("uuid", $filter['uuid']);
			}
			if (isset($filter['copyright'])) {
				$this->db->where("copyright =", $filter['copyright']);
			}
			if (isset($filter['status'])) {
				$this->db->where("status", $filter['status']);
			}
		}
		if ($limit) {
			$this->db->limit($limit, $page * $limit);
		}
		$this->db->order_by($order[0], $order[1]);

		$data = $this->db->get('storage')->result();
		return $res = $data;
	}

	public function insert($data)
	{
		$insert = $this->db->insert("storage", $data);
		if ($insert) {
			return $this->db->insert_id();
		}
		return false;
	}

	public function update($filter, $data)
	{
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("id", $filter['id']);
			}
			if (isset($filter['uuid'])) {
				$this->db->where("uuid", $filter['uuid']);
			}
		}
		$update = $this->db->update("storage", $data);
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
			if (isset($filter['uuid'])) {
				$this->db->where("uuid", $filter['uuid']);
			}
		}
		$delete = $this->db->delete("storage");
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}

}
