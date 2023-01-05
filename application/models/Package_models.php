<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package_models extends CI_Model
{
	public function get($filter = null, $page = 0, $limit = null, $order = array('date_created', 'desc'))
	{
		$res = null;
		$this->db->select('package.*,
		category.name as category_name,
		promoted.id as promoted_id,
		promoted.video_url as promoted_video_url,
		photo_1.uuid as photo_1_uuid,
		photo_2.uuid as photo_2_uuid,
		photo_3.uuid as photo_3_uuid,
		photo_4.uuid as photo_4_uuid,
		');

		$this->db->from('package package');
		$this->db->join('category category', 'category.id = package.category_id', 'left');
		$this->db->join('promoted promoted', 'promoted.package_id = package.id', 'left');
		$this->db->join('storage photo_1', 'photo_1.id = package.photo_1', 'left');
		$this->db->join('storage photo_2', 'photo_2.id = package.photo_2', 'left');
		$this->db->join('storage photo_3', 'photo_3.id = package.photo_3', 'left');
		$this->db->join('storage photo_4', 'photo_4.id = package.photo_4', 'left');
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("package.id", $filter['id']);
			}
			if (isset($filter['category'])) {
				$this->db->where("package.category_id", $filter['category']);
			}
			if (isset($filter['url'])) {
				$this->db->where("package.url", $filter['url']);
			}
			if (isset($filter['status'])) {
				$this->db->where("package.status", $filter['status']);
			}
			if (isset($filter['promoted'])) {
				$this->db->where("promoted.id >", -1);
			}
			if (isset($filter['promoted_id'])) {
				$this->db->where("promoted.id", $filter['promoted_id']);
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
		$insert = $this->db->insert("package", $data);
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
		$update = $this->db->update("package", $data);
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
		$delete = $this->db->delete("package");
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}
