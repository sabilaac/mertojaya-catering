<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model("user_models");
		$this->load->model("auth_models");
		$this->load->model("config_models");
		$this->load->model("helper_models");
		$this->load->model("package_models");
		$this->load->model("category_models");
		$this->load->model("promoted_models");
		$this->data = $this->config_models->autoload_navigation_admin();
	}

	public function index()
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() .'admin/login');
			exit();
		}
		$this->data['data'] = null;
		$this->data['view'] = 'analytics';
		$this->load->view('admin/dashboard', $this->data);
	}

	public function article($route = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() .'admin/login');
			exit();
		}
		$this->data['data'] = null;
		if ($route === 'add') {
			$this->data['view'] = 'article_add';
		} else {
			$this->data['view'] = 'article';
		}
		$this->load->view('admin/dashboard', $this->data);
	}

	public function education($route = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() .'admin/login');
			exit();
		}
		$this->data['data'] = null;
		if ($route === 'add') {
			$this->data['view'] = 'education_add';
		} else {
			$this->data['view'] = 'education';
		}
		$this->load->view('admin/dashboard', $this->data);
	}

	public function gallery($route = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() .'admin/login');
			exit();
		}
		$this->data['data'] = null;
		if ($route === 'add') {
			$this->data['view'] = 'gallery_add';
		} else {
			$this->data['view'] = 'gallery';
		}
		$this->load->view('admin/dashboard', $this->data);
	}

	public function config()
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() .'admin/login');
			exit();
		}
		$this->data['data'] = null;
		$this->data['view'] = 'config';
		$this->load->view('admin/dashboard', $this->data);
	}

	public function category($route = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() .'admin/login');
			exit();
		}

		$this->data['data'] = null;
		$res_category = $this->category_models->get();
		$this->data['category_list'] = $res_category;
		$this->data['view'] = 'category';

		$id = $this->input->get('id');
		$name = $this->input->post('name');

		if ($route === 'add') {
			if (strtolower($res_category[0]->name) !== strtolower($name)) {
				$data_category = array('name' => $name);
				$insert_category = $this->category_models->insert($data_category);

				if ($insert_category) {
					$this->session->set_flashdata('category_data', array(
						'success' => true,
						'message' => 'Berhasil menambahkan kategori<br>Silahkan kembali untuk menambahkan paket',
					));
					redirect(base_url() . 'admin/category');
				} else {
					$this->session->set_flashdata('category_data', array(
						'success' => false,
						'message' => 'Gagal menambahkan kategori',
					));
				}
			} else {
				$this->session->set_flashdata('category_data', array(
					'success' => false,
					'message' => 'Kategori sudah ada',
				));
			}
		}
		else if ($route === 'remove') {
			$delete_category = $this->category_models->delete(array('id' => $id));

			if ($delete_category) {
				$this->session->set_flashdata('category_data', array(
					'success' => true,
					'message' => 'Berhasil menghapus kategori',
				));
				redirect(base_url() . 'admin/category');
			} else {
				$this->session->set_flashdata('category_data', array(
					'success' => false,
					'message' => 'Gagal menghapus kategori',
				));
			}
		}
		$this->load->view('admin/dashboard', $this->data);
	}

	public function package($route = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() .'admin/login');
			exit();
		}
		$this->data['data'] = $this->config_models->autoload_config_public();
		$res_package = $this->package_models->get();
		$this->data['package_list_force_status'] = $res_package;

		$url = $this->input->get('url');

		if ($route === 'add' || $route === 'edit') {
			$title = $this->input->post('title');
			$category = $this->input->post('category');
			$price = $this->input->post('price');
			$count = $this->input->post('count');
			$content = $this->input->post('content');
			$path = $this->input->post('path');
			$add = $this->input->post('add');
			$edit = $this->input->post('edit');
			$photo = array();
			$error = array();
			$error_count = 0;

			$this->data['mode'] = isset($url) ? 'edit' : 'add';

			if (isset($url)) {
				$res_package = $this->package_models->get(array('url' => $url));
				$this->data['package_detail'] = $res_package[0];
			}

			if (isset($add)) {
				if ($title && $category && $price && $count && $content && $path) {
					for ($i = 1; $i <= 4; $i++) {
						$filename = $this->helper_models->uuid();
						$config['upload_path'] = 'cdn';
						$config['allowed_types'] = 'gif|jpg|jpeg|bmp|png';
						$config['file_name'] = $filename;
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('photo_' . $i)) {
							$photo['photo_' . $i] = $this->upload->data();
						} else {
							$error['photo_' . $i] = array('error' => $this->upload->display_errors());
							$error_count++;
						}
					}
					if (4 - $error_count === sizeof($photo)) {
						$data_package = array(
							'title' => $title,
							'url' => $path,
							'category_id' => $category,
							'price' => $price,
							'count' => $count,
							'content' => $content,
							'photo_1' => isset($photo['photo_1']) ? $photo['photo_1']['file_name'] : null,
							'photo_2' => isset($photo['photo_2']) ? $photo['photo_2']['file_name'] : null,
							'photo_3' => isset($photo['photo_3']) ? $photo['photo_3']['file_name'] : null,
							'photo_4' => isset($photo['photo_4']) ? $photo['photo_4']['file_name'] : null,
						);
						$insert_package = $this->package_models->insert($data_package);

						if ($insert_package) {
							$this->session->set_flashdata('package_data', array(
								'success' => true,
								'message' => 'Berhasil menambahkan paket',
							));
						} else {
							$this->session->set_flashdata('package_data', array(
								'success' => false,
								'message' => 'Gagal menambahkan paket',
							));
						}
					} else {
						$this->session->set_flashdata('package_data', array(
							'success' => false,
							'message' => 'Gagal melakukan upload ke server'
						));
					}
				} else {
					$this->session->set_flashdata('package_data', array(
						'success' => false,
						'message' => 'Mohon isi semua data',
					));
				}
			}
			$res_category = $this->category_models->get();
			$this->data['category_list'] = $res_category;
			$this->data['view'] = 'package_add';
		} else if ($route === 'remove') {
			$this->data['data'] = array('title' => 'Loading', 'description' => 'Menghapus data ...', 'url' => base_url() . "admin/package");
			$this->data['view'] = 'process';
//			$prefix_path = 'www/sabila.studio/mertojaya-catering/';
			$prefix_path = '';
			$res_package = $this->package_models->get(array('url' => $url));
			if ($res_package) {
				if ($res_package[0]->photo_1) {
					unlink($prefix_path . 'cdn/' . $res_package[0]->photo_1);
				}
				if ($res_package[0]->photo_2) {
					unlink($prefix_path . 'cdn/' . $res_package[0]->photo_2);
				}
				if ($res_package[0]->photo_3) {
					unlink($prefix_path . 'cdn/' . $res_package[0]->photo_3);
				}
				if ($res_package[0]->photo_4) {
					unlink($prefix_path . 'cdn/' . $res_package[0]->photo_4);
				}
				$delete_package = $this->package_models->delete(array('url' => $url));
				if ($delete_package) {
					$this->session->set_flashdata('package_data', array(
						'success' => true,
						'message' => 'Paket telah dihapus'
					));
				} else {
					$this->session->set_flashdata('package_data', array(
						'success' => false,
						'message' => 'Paket gagal dihapus'
					));
				}
			} else {
				$this->session->set_flashdata('package_data', array(
					'success' => false,
					'message' => 'Paket tidak ditemukan'
				));
			}
		} else if ($route === 'dispatch_recommendation') {
			$this->data['data'] = array('title' => 'Loading', 'description' => 'Melepas rekomendasi ...', 'url' => base_url() . "admin/package");
			$this->data['view'] = 'process';

			$id = $this->input->get('id');

			$delete_promoted = $this->promoted_models->delete(array('id' => $id));
			if ($delete_promoted) {
				$this->session->set_flashdata('package_data', array(
					'success' => true,
					'message' => 'Rekomendasi telah dilepas'
				));
			} else {
				$this->session->set_flashdata('package_data', array(
					'success' => false,
					'message' => 'Paket gagal dilepas'
				));
			}
		} else if ($route === 'visibility') {
			$this->data['data'] = array('title' => 'Loading', 'description' => 'Mengganti status data ...', 'url' => base_url() . "admin/package");
			$this->data['view'] = 'process';
			$res_package = $this->package_models->get(array('url' => $url));

			if ($res_package) {
				$update_package = $this->package_models->update(
					array('url' => $url),
					array('status' => $res_package[0]->status === '1' ? '0' : '1')
				);
				if ($update_package) {
					$this->session->set_flashdata('package_data', array(
						'success' => true,
						'message' => 'Visibilitas di update'
					));
				} else {
					$this->session->set_flashdata('package_data', array(
						'success' => false,
						'message' => 'Visibilitas gagal di update'
					));
				}
			} else {
				$this->session->set_flashdata('package_data', array(
					'success' => false,
					'message' => 'Paket tidak ditemukan'
				));
			}

		} else {
			$this->data['view'] = 'package';
		}

		$this->load->view('admin/dashboard', $this->data);
	}

	public
	function logout()
	{
		$session = array(
			'username' => null,
			'token' => null
		);
		echo 'Sedang logout akun, mohon menunggu ...';

		$this->session->set_userdata($session);
		redirect(base_url() . "admin/login");
	}

	public
	function login()
	{
		$vals = [
			// 'word' -> nantinya akan digunakan sebagai random teks yang akan keluar di captchanya
			'word'          => substr(str_shuffle('123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6),
			'img_path'      => 'assets/image/captcha/',
			'img_url'       => base_url() . 'assets/image/captcha/',
			'img_width'     => 150,
			'img_height'    => 50,
			'expiration'    => 1800,
			'word_length'   => 6,
			'font_size'     => 36,
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors'        => [
				'background'=> [0, 0, 0],
				'border'    => [255, 255, 255],
				'text'      => [255, 255, 255],
				'grid'      => [200, 200, 200]
			]
		];

		$captcha_output = create_captcha($vals);

		$username = filter_var($this->input->post("username"), FILTER_VALIDATE_EMAIL);
		$password = $this->input->post('password');
		$login = $this->input->post('login');
		$captcha = $this->session->flashdata('captcha');
		$captcha_input = $this->input->post('captcha');

		if ($this->auth_models->getAuth()) {
			redirect(base_url() . 'admin');
			exit();
		}

		if (isset($login)) {
			if($captcha_input && $captcha_input === $captcha) {
				if ($username && $password) {
					$res_login = $this->user_models->login(array('username' => $username, 'password' => $password));

					if ($res_login && sizeof($res_login) > 0) {
						$session = array(
							'username' => $res_login[0]->username,
							'token' => $this->auth_models->createToken(array(
								'id' => $res_login[0]->id,
								'username' => $res_login[0]->username,
							))
						);
						$this->session->set_userdata($session);
						redirect(base_url() . 'admin', 'refresh');
					} else {
						$this->session->set_flashdata('login_data', array(
							'success' => false,
							'message' => 'Email atau Kata sandi salah',
						));
					}
				} else {
					$this->session->set_flashdata('login_data', array(
						'success' => false,
						'message' => 'Email atau Kata sandi kosong',
					));
				}
			}
			else {
				$this->session->set_flashdata('login_data', array(
					'success' => false,
					'message' => 'Captcha salah',
				));
			}

		}
		$this->session->set_flashdata('captcha', $captcha_output['word']);
		$this->data['captcha'] = $captcha_output['image'];
		$this->load->view('admin/login', $this->data);
	}
}
