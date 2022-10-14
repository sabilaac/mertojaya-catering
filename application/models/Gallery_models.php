<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery_models extends CI_Model
{
	public function get($filter = null, $page = 0, $limit = null, $order = array('date_created', 'desc'))
	{
		$res = null;
		$this->db->select('gallery.*,
		user.name as full_name,
		');

		$this->db->from('gallery gallery');
		$this->db->join('user user', 'user.id = gallery.user_id', 'left');
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("gallery.id", $filter['id']);
			}
			if (isset($filter['city'])) {
				$this->db->where("gallery.city", $filter['city']);
			}
			if (isset($filter['status'])) {
				$this->db->where("gallery.status", $filter['status']);
			}
		}
		if ($limit) {
			$this->db->limit($limit, $page * $limit);
		}
		$this->db->order_by($order[0], $order[1]);
		$data = $this->db->get()->result();
		return $res = $data;
	}

	public function insert($data)
	{
		$insert = $this->db->insert("gallery", $data);
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
		$update = $this->db->update("gallery", $data);
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
		$delete = $this->db->delete("gallery");
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}
