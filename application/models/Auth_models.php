<?php

use Fernet\Fernet;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_models extends CI_Model
{
	private $key = "G%F)Bk6d?&<X34Kc";

	public function getAuth()
	{
		$session_username = $this->session->userdata('username');
		$session_token = $this->session->userdata('token');

		if($session_token && $session_username) {
			$token = JWT::decode($session_token, $this->key, array('HS256'));

			$time = $token->time;
			$username = $token->username;

			if ($time >= time() && $username === $session_username) {
				return true;
			}
		}
		return false;
	}

	public function createToken($data)
	{
		$token = array(
			'id' => $data['id'],
			'username' => $data['username'],
			'time' => time() + (7 * 24 * 60 * 60)
		);

		$token = JWT::encode($token, $this->key);

		if ($token) {
			return $token;
		} else {
			return null;
		}
	}

	public function getMetadata($token) {
		$key = base64_encode($this->key . $this->key);
		$fernet = new Fernet($key);

		$data = $fernet->decode($token);
		if ($data !== null) {
			return $data;
		}
		return false;
	}

	public function createMetadata($data) {
		$key = base64_encode($this->key . $this->key);
		$fernet = new Fernet($key);
		$token = $fernet->encode($data);
		if ($token) {
			return $token;
		} else {
			return null;
		}
	}
}
