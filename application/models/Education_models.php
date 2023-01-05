<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Education_models extends CI_Model
{
	public function get($filter = null, $page = 0, $limit = null, $order = array('education.date_created', 'desc'))
	{
		$res = null;
		$this->db->select('education.*,
		storage.uuid as thumbnail_uuid,
		storage.copyright as thumbnail_copyright,
		');

		$this->db->from('education education');
		$this->db->join('storage storage', 'storage.id = education.thumbnail_id', 'left');
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("education.id", $filter['id']);
			}
			if (isset($filter['url'])) {
				$this->db->where("education.url", $filter['url']);
			}
			if (isset($filter['status'])) {
				$this->db->where("education.status", $filter['status']);
			}
		}
		if ($limit) {
			$this->db->limit($limit, $page * $limit);
		}
		if($order !== 'random') {
			$this->db->order_by($order[0], $order[1]);
		}
		else {
			$this->db->order_by('rand()');
		}
		$res = $this->db->get()->result();
		return $res;
	}

	public function insert($data)
	{
		$insert = $this->db->insert("education", $data);
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
			if (isset($filter['url'])) {
				$this->db->where("url", $filter['url']);
			}
		}
		$update = $this->db->update("education", $data);
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
			if (isset($filter['url'])) {
				$this->db->where("url", $filter['url']);
			}
		}
		$delete = $this->db->delete("education");
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}
