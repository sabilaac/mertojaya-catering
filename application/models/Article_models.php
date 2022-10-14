<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article_models extends CI_Model
{
	public function get($filter = null, $page = 0, $limit = null, $order = array('date_created', 'desc'))
	{
		$res = null;
		$this->db->select('article.*,
		user.name as full_name,
		');

		$this->db->from('article article');
		$this->db->join('user user', 'user.id = article.user_id', 'left');
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("article.id", $filter['id']);
			}
			if (isset($filter['url'])) {
				$this->db->where("article.url", $filter['url']);
			}
			if (isset($filter['status'])) {
				$this->db->where("article.status", $filter['status']);
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

		$data = $this->db->get()->result();
		return $res = $data;
	}

	public function insert($data)
	{
		$insert = $this->db->insert("article", $data);
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
		$update = $this->db->update("article", $data);
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
		$delete = $this->db->delete("article");
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}
