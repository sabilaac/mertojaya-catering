<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campaign_models extends CI_Model
{
	public function get($filter = null, $page = 0, $limit = null)
	{
		$res = null;
		if ($filter) {
			if (isset($filter['id'])) {
				$this->db->where("id", $filter['id']);
			}
			if (isset($filter['url'])) {
				$this->db->where("url", $filter['url']);
			}
			if (isset($filter['status'])) {
				$this->db->where("status", $filter['status']);
			}
		}
		if ($limit) {
			$this->db->limit($limit, $page * $limit);
		}
		$data = $this->db->get("campaign")->result();
		return $res = $data;
	}
}
