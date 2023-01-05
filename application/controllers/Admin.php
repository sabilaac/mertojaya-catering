<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	private $data;

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->data = $this->config_models->autoload_navigation_admin();
	}

	public function index()
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() . 'admin/login');
			exit();
		}
		$this->data['data'] = null;
		$this->data['view'] = 'analytics';
		$this->load->view('admin/dashboard', $this->data);
	}

	public function article($route = null, $url = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() . 'admin/login');
			exit();
		}
		$this->data['data'] = null;

		if ($route) {
			$title = $this->input->post('title');
			$path = $this->input->post('path');
			$copyright = $this->input->post('copyright') === "on" ? 1 : 0;
			$content = $this->input->post('content');
			$category_tag = $this->input->post('category_tag');
			$submit = $this->input->post('submit');
			$thumbnail = !empty($_FILES['thumbnail']['name']);
			$error = null;

			if ($route === "add") {
				if ($submit) {
					if ($title && $category_tag && $content) {
						$filename = $this->helper_models->uuid();
						$config['upload_path'] = 'cdn';
						$config['allowed_types'] = 'jpg|jpeg';
						$config['file_name'] = $filename;
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('thumbnail')) {
							$data_storage = array(
								'uuid' => $filename,
								'title' => $title . ' photo hero',
								'copyright' => $copyright,
							);
							$insert_storage = $this->storage_models->insert($data_storage);
							if ($insert_storage) {
								$data_article = array(
									'url' => $path,
									'thumbnail_id' => $insert_storage,
									'title' => $title,
									'content' => $content,
									'category_tag' => $category_tag ? json_encode(preg_split('/(,| , |, )/', $category_tag)) : null,
								);
								$insert_article = $this->article_models->insert($data_article);

								if ($insert_article) {
									$this->session->set_flashdata('article_data', array(
										'success' => true,
										'message' => 'Berhasil menambahkan artikel',
									));
									redirect(base_url('admin/article'));
								} else {
									$this->session->set_flashdata('article_data', array(
										'success' => false,
										'message' => 'Gagal menambahkan artikel',
									));
								}
							} else {
								$error = 'Gagal mengupload foto';
							}
						} else {
							$error = $this->upload->display_errors();
						}
						if ($error) {
							$this->session->set_flashdata('article_data', array(
								'success' => false,
								'message' => $error,
							));
						}
					} else {
						$this->session->set_flashdata('article_data', array(
							'success' => false,
							'message' => 'Mohon isi semua data',
						));
					}
				}
			} else if ($route === "edit") {
				$res_article = $this->article_models->get(array('url' => $url));
				$this->data['article_detail'] = $res_article;
				$insert_storage = $res_article[0]->thumbnail_id;
				if ($submit) {
					if ($title && $category_tag && $content) {
						if ($thumbnail) {
							$filename = $this->helper_models->uuid();
							$config['upload_path'] = 'cdn';
							$config['allowed_types'] = 'jpg|jpeg';
							$config['file_name'] = $filename;
							$this->load->library('upload', $config);

							if ($this->upload->do_upload('thumbnail')) {
								$data_storage = array(
									'uuid' => $filename,
									'title' => $title . ' photo hero',
									'copyright' => $copyright,
								);
								$update_storage = $this->storage_models->update(array(
									'id' => $res_article[0]->thumbnail_id
								), $data_storage);
								if (!$update_storage) {
									$error = 'Gagal mengupload foto';
								}
							} else {
								$error = $this->upload->display_errors();
							}
							if ($error) {
								$this->session->set_flashdata('article_data', array(
									'success' => false,
									'message' => $error,
								));
							}
						}

						$data_article = array(
							'url' => $path,
							'user_id' => $this->data["user_id"],
							'thumbnail_id' => $insert_storage,
							'title' => $title,
							'content' => $content,
							'category_tag' => $category_tag ? json_encode(preg_split('/(,| , |, )/', $category_tag)) : null,
						);
						$update_article = $this->article_models->update(array(
							'url' => $url
						), $data_article);

						if ($update_article) {
							$this->session->set_flashdata('article_data', array(
								'success' => true,
								'message' => 'Berhasil meperbarui artikel',
							));
							redirect(base_url('admin/article'));
						} else {
							$this->session->set_flashdata('article_data', array(
								'success' => false,
								'message' => 'Gagal meperbarui artikel',
							));
						}
					} else {
						$this->session->set_flashdata('article_data', array(
							'success' => false,
							'message' => 'Mohon isi semua data',
						));
					}
				}
			} else if ($route === 'remove') {
				$this->data['data'] = array('title' => 'Loading', 'description' => 'Menghapus data ...', 'url' => base_url() . "admin/package");
				$this->data['view'] = 'process';
				$prefix_path = '';
				$res_article = $this->article_models->get(array('url' => $url));
				if ($res_article) {
					if ($res_article[0]->thumnail_uuid) {
						unlink($prefix_path . 'cdn/' . $res_article[0]->thumnail_uuid . ".jpg");
					}
					$delete_article = $this->article_models->delete(array('url' => $url));
					if ($delete_article) {
						$this->session->set_flashdata('article_data', array(
							'success' => true,
							'message' => 'Artikel telah dihapus'
						));
						redirect(base_url('admin/article'));
					} else {
						$this->session->set_flashdata('article_data', array(
							'success' => false,
							'message' => 'Artikel gagal dihapus'
						));
					}
				} else {
					$this->session->set_flashdata('article_data', array(
						'success' => false,
						'message' => 'Artikel tidak ditemukan'
					));
				}
			} else if ($route === 'visibility') {
				$this->data['data'] = array('title' => 'Loading', 'description' => 'Menghapus data ...', 'url' => base_url() . "admin/package");
				$this->data['view'] = 'process';
				$prefix_path = '';
				$res_article = $this->article_models->get(array('url' => $url));
				$data_article = array(
					'status' => intval($res_article[0]->status) === 1 ? 0 : 1,
				);
				$update_article = $this->article_models->update(array(
					'url' => $url
				), $data_article);

				if ($update_article) {
					$this->session->set_flashdata('article_data', array(
						'success' => true,
						'message' => 'Berhasil menampilkan / menyembunyikan artikel',
					));
					redirect(base_url('admin/article'));
				} else {
					$this->session->set_flashdata('article_data', array(
						'success' => false,
						'message' => 'Gagal menampilkan / menyembunyikan artikel',
					));
				}
			}
			$this->data['mode'] = $route;
			$this->data['view'] = 'article_add';
		} else {
			$res_article = $this->article_models->get();
			$this->data['article_list'] = $res_article;
			$this->data['view'] = 'article';
		}
		$this->load->view('admin/dashboard', $this->data);
	}

	public function education($route = null, $id = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() . 'admin/login');
			exit();
		}
		$this->data['data'] = null;

		if ($route) {
			$title = $this->input->post('title');
			$path = $this->input->post('path');
			$copyright = $this->input->post('copyright') === "on" ? 1 : 0;
			$content = $this->input->post('content');
			$category_tag = $this->input->post('category_tag');
			$submit = $this->input->post('submit');
			$thumbnail = !empty($_FILES['thumbnail']['name']);
			$error = null;

			if ($route === "add") {
				if ($submit) {
					if ($title && $content) {
						$filename = $this->helper_models->uuid();
						$config['upload_path'] = 'cdn';
						$config['allowed_types'] = 'jpg|jpeg';
						$config['file_name'] = $filename;
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('thumbnail')) {
							$data_storage = array(
								'uuid' => $filename,
								'title' => $title . ' photo hero',
								'copyright' => $copyright,
							);
							$insert_storage = $this->storage_models->insert($data_storage);
							if ($insert_storage) {
								$data_education = array(
									'url' => $path,
									'thumbnail_id' => $insert_storage,
									'title' => $title,
									'content' => $content,
									'category_tag' => $category_tag ? json_encode(preg_split('/(,| , |, )/', $category_tag)) : null,
								);
								$insert_education = $this->education_models->insert($data_education);

								if ($insert_education) {
									$this->session->set_flashdata('education_data', array(
										'success' => true,
										'message' => 'Berhasil menambahkan edukasi',
									));
									redirect(base_url('admin/education'));
								} else {
									$this->session->set_flashdata('education_data', array(
										'success' => false,
										'message' => 'Gagal menambahkan edukasi',
									));
								}
							} else {
								$error = 'Gagal mengupload foto';
							}
						} else {
							$error = $this->upload->display_errors();
						}
						if ($error) {
							$this->session->set_flashdata('education_data', array(
								'success' => false,
								'message' => $error,
							));
						}
					} else {
						$this->session->set_flashdata('education_data', array(
							'success' => false,
							'message' => 'Mohon isi semua data',
						));
					}
				}
			} else if ($route === "edit") {
				$res_education = $this->education_models->get(array('id' => $id));
				$this->data['education_detail'] = $res_education;
				$insert_storage = $res_education[0]->thumbnail_id;
				if ($submit) {
					if ($title && $content) {
						if ($thumbnail) {
							$filename = $this->helper_models->uuid();
							$config['upload_path'] = 'cdn';
							$config['allowed_types'] = 'jpg|jpeg';
							$config['file_name'] = $filename;
							$this->load->library('upload', $config);

							if ($this->upload->do_upload('thumbnail')) {
								$data_storage = array(
									'uuid' => $filename,
									'title' => $title . ' photo hero',
									'copyright' => $copyright,
								);
								$update_storage = $this->storage_models->update(array(
									'id' => $res_education[0]->thumbnail_id
								), $data_storage);
								if (!$update_storage) {
									$error = 'Gagal mengupload foto';
								}
							} else {
								$error = $this->upload->display_errors();
							}
							if ($error) {
								$this->session->set_flashdata('education_data', array(
									'success' => false,
									'message' => $error,
								));
							}
						}

						$data_education = array(
							'url' => $path,
							'thumbnail_id' => $insert_storage,
							'title' => $title,
							'content' => $content,
						);
						$update_education = $this->education_models->update(array(
							'id' => $id
						), $data_education);

						if ($update_education) {
							$this->session->set_flashdata('education_data', array(
								'success' => true,
								'message' => 'Berhasil meperbarui artikel',
							));
							redirect(base_url('admin/education'));
						} else {
							$this->session->set_flashdata('education_data', array(
								'success' => false,
								'message' => 'Gagal meperbarui artikel',
							));
						}
					} else {
						$this->session->set_flashdata('education_data', array(
							'success' => false,
							'message' => 'Mohon isi semua data',
						));
					}
				}
			} else if ($route === 'remove') {
				$this->data['data'] = array('title' => 'Loading', 'description' => 'Menghapus data ...', 'url' => base_url() . "admin/package");
				$this->data['view'] = 'process';
				$prefix_path = '';
				$res_education = $this->education_models->get(array('id' => $id));
				if ($res_education) {
					if ($res_education[0]->thumnail_uuid) {
						unlink($prefix_path . 'cdn/' . $res_education[0]->thumnail_uuid . ".jpg");
					}
					$delete_education = $this->education_models->delete(array('id' => $id));
					if ($delete_education) {
						$this->session->set_flashdata('education_data', array(
							'success' => true,
							'message' => 'Artikel telah dihapus'
						));
						redirect(base_url('admin/education'));
					} else {
						$this->session->set_flashdata('education_data', array(
							'success' => false,
							'message' => 'Artikel gagal dihapus'
						));
					}
				} else {
					$this->session->set_flashdata('education_data', array(
						'success' => false,
						'message' => 'Artikel tidak ditemukan'
					));
				}
			} else if ($route === 'visibility') {
				$this->data['data'] = array('title' => 'Loading', 'description' => 'Menghapus data ...', 'url' => base_url() . "admin/package");
				$this->data['view'] = 'process';
				$prefix_path = '';
				$res_education = $this->education_models->get(array('id' => $id));
				$data_education = array(
					'status' => intval($res_education[0]->status) === 1 ? 0 : 1,
				);
				$update_education = $this->education_models->update(array(
					'id' => $id
				), $data_education);

				if ($update_education) {
					$this->session->set_flashdata('education_data', array(
						'success' => true,
						'message' => 'Berhasil menampilkan / menyembunyikan artikel',
					));
					redirect(base_url('admin/education'));
				} else {
					$this->session->set_flashdata('education_data', array(
						'success' => false,
						'message' => 'Gagal menampilkan / menyembunyikan artikel',
					));
				}
			}
			$this->data['mode'] = $route;
			$this->data['view'] = 'education_add';
		} else {
			$res_education = $this->education_models->get();
			$this->data['education_list'] = $res_education;
			$this->data['view'] = 'education';
		}
		$this->load->view('admin/dashboard', $this->data);
	}

	public function feedback($route = null, $id = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() . 'admin/login');
			exit();
		}
		$this->data['data'] = null;

		if ($route) {
			$name = $this->input->post('name');
			$city = $this->input->post('city');
			$review = $this->input->post('review');
			$submit = $this->input->post('submit');

			if ($route === "add") {
				if ($submit) {
					if ($name && $city && $review ) {
						$data_feedback = array(
							'name' => $name,
							'city' => $city,
							'review' => $review,
						);
						$insert_feedback = $this->feedback_models->insert($data_feedback);

						if ($insert_feedback) {
							$this->session->set_flashdata('feedback_data', array(
								'success' => true,
								'message' => 'Berhasil menambahkan ulasan',
							));
							redirect(base_url('admin/feedback'));
						} else {
							$this->session->set_flashdata('feedback_data', array(
								'success' => false,
								'message' => 'Gagal menambahkan ulasan',
							));
						}
					}
				}
			} else if ($route === "edit") {
				$res_feedback = $this->feedback_models->get(array('id' => $id));
				$this->data['feedback_detail'] = $res_feedback;
				if ($submit) {
					if ($name && $city && $review ) {
						$data_feedback = array(
							'name' => $name,
							'city' => $city,
							'review' => $review,
						);
						$update_feedback = $this->feedback_models->update(array(
							'id' => $id
						), $data_feedback);

						if ($update_feedback) {
							$this->session->set_flashdata('feedback_data', array(
								'success' => true,
								'message' => 'Berhasil meperbarui ulasan',
							));
							redirect(base_url('admin/feedback'));
						} else {
							$this->session->set_flashdata('feedback_data', array(
								'success' => false,
								'message' => 'Gagal meperbarui ulasan',
							));
						}
					}
				}
			} else if ($route === 'visibility') {
				$this->data['data'] = array('title' => 'Loading', 'description' => 'Mnegatur visibilitas data ...', 'url' => base_url() . "admin/package");
				$this->data['view'] = 'process';
				$res_feedback = $this->feedback_models->get(array('id' => $id));
				var_dump($res_feedback[0]->status);
				$data_feedback = array(
					'status' => intval($res_feedback[0]->status) === 1 ? 0 : 1,
				);
				$update_feedback = $this->feedback_models->update(array(
					'id' => $id
				), $data_feedback);

				if ($update_feedback) {
					$this->session->set_flashdata('feedback_data', array(
						'success' => true,
						'message' => 'Berhasil menampilkan / menyembunyikan ulasan',
					));
					redirect(base_url('admin/feedback'));
				} else {
					$this->session->set_flashdata('education_data', array(
						'success' => false,
						'message' => 'Gagal menampilkan / menyembunyikan ulasan',
					));
				}
			}
			$this->data['mode'] = $route;
			$this->data['view'] = 'feedback_add';
		} else {
			$res_feedback = $this->feedback_models->get();
			$this->data['feedback_list'] = $res_feedback;
			$this->data['view'] = 'feedback';
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
			redirect(base_url() . 'admin/login');
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
			redirect(base_url() . 'admin/login');
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
			redirect(base_url() . 'admin/login');
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
		} else if ($route === 'remove') {
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

	public function package($route = null, $url = null)
	{
		if (!$this->auth_models->getAuth()) {
			$this->session->set_flashdata('login_data', array(
				'success' => false,
				'message' => 'Anda harus login terlebih dahulu',
			));
			redirect(base_url() . 'admin/login');
			exit();
		}

		$this->data['data'] = null;
		if ($route) {
			$title = $this->input->post('title');
			$category = $this->input->post('category');
			$price = $this->input->post('price');
			$count = $this->input->post('count');
			$content = $this->input->post('content');
			$copyright = $this->input->post('copyright') === "on" ? 1 : 0;
			$path = $this->input->post('path');
			$photo_1 = !empty($_FILES['photo_1']['name']);
			$photo_2 = !empty($_FILES['photo_2']['name']);
			$photo_3 = !empty($_FILES['photo_3']['name']);
			$photo_4 = !empty($_FILES['photo_4']['name']);
			$submit = $this->input->post('submit');
			$photo = array();
			$error = array();
			$error_count = 0;

			if ($route === "add") {
				if ($submit) {
					if ($title && $category && $content && $price && $count && ($photo_1 || $photo_2 || $photo_3 || $photo_4)) {
						for ($i = 1; $i <= 4; $i++) {
							if (!empty($_FILES['photo_' . $i]['name'])) {
								$filename = $this->helper_models->uuid();
								$config['upload_path'] = 'cdn';
								$config['allowed_types'] = 'jpg|jpeg';
								$config['file_name'] = $filename;
								$this->load->library('upload', $config);
								if ($this->upload->do_upload('photo_' . $i)) {
									$upload_data = $this->upload->data();
									if ($upload_data) {
										$data_storage = array(
											'uuid' => $upload_data["raw_name"],
											'title' => $title . ' package photo ' . $i,
											'copyright' => $copyright,
										);
										$insert_storage = $this->storage_models->insert($data_storage);
										if ($insert_storage) {
											$photo['photo_' . $i] = $insert_storage;
										} else {
											$error_count++;
										}
									}
								} else {
									$error = $this->upload->display_errors();
									$error_count++;
								}
							} else {
								$photo['photo_' . $i] = null;
							}
						}
						if ($error_count === 0) {
							$data_package = array(
								'title' => $title,
								'url' => $path,
								'category_id' => $category,
								'price' => $price,
								'count' => $count,
								'content' => $content,
								'photo_1' => $photo['photo_1'],
								'photo_2' => $photo['photo_2'],
								'photo_3' => $photo['photo_3'],
								'photo_4' => $photo['photo_4'],
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
								'message' => $error,
							));
						}
					} else {
						$this->session->set_flashdata('package_data', array(
							'success' => false,
							'message' => 'Mohon isi semua data',
						));
					}
				}
				$this->data['mode'] = $route;
				$this->data['view'] = 'package_add';
			} else if ($route === "edit") {
				$res_package = $this->package_models->get(array('url' => $url));
				$this->data['package_detail'] = $res_package[0];
				if ($submit) {
					if ($title && $category && $content && $price && $count) {
						for ($i = 1; $i <= 4; $i++) {
							if (!empty($_FILES['photo_' . $i]['name'])) {
								$filename = $this->helper_models->uuid();
								$config['upload_path'] = 'cdn';
								$config['allowed_types'] = 'jpg|jpeg';
								$config['file_name'] = $filename;
								$this->load->library('upload', $config);
								if ($this->upload->do_upload('photo_' . $i)) {
									$upload_data = $this->upload->data();
									if ($upload_data) {
										if(file_exists('cdn/' . $res_package[0]->{"photo_" . $i . "_uuid" } . '.jpg')) {
											unlink('cdn/' . $res_package[0]->{"photo_" . $i . "_uuid" } . ".jpg");

											$this->storage_models->delete(array(
												'id' =>$res_package[0]->{"photo_" . $i }
											));
										}
										$data_storage = array(
											'uuid' => $upload_data["raw_name"],
											'title' => $title . ' package photo ' . $i,
											'copyright' => $copyright,
										);
										$insert_storage = $this->storage_models->insert( $data_storage);
										if ($insert_storage) {
											$photo['photo_' . $i] = $insert_storage;
										} else {
											$error_count++;
										}
									}
								} else {
									$error = $this->upload->display_errors();
									$error_count++;
								}
							}
							else {
								if(!isset($photo['photo_' . $i])) {
									if($res_package[0]->{"photo_" . $i}) {
										$photo['photo_' . $i] = $res_package[0]->{"photo_" . $i};
									}
									else {
										$photo['photo_' . $i] = null;
									}
								}
							}
						}
						if ($error_count === 0) {
							$data_package = array(
								'title' => $title,
								'url' => $path,
								'category_id' => $category,
								'price' => $price,
								'count' => $count,
								'content' => $content,
								'photo_1' => $photo['photo_1'],
								'photo_2' => $photo['photo_2'],
								'photo_3' => $photo['photo_3'],
								'photo_4' => $photo['photo_4'],
							);
							$update_package = $this->package_models->update(array(
								'url' => $url
							), $data_package);

							if ($update_package) {
								$this->session->set_flashdata('package_data', array(
									'success' => true,
									'message' => 'Berhasil mengubah paket',
								));
								redirect(base_url('admin/package'));
							} else {
								$this->session->set_flashdata('package_data', array(
									'success' => false,
									'message' => 'Gagal mengubah paket',
								));
							}
						} else {
							$this->session->set_flashdata('package_data', array(
								'success' => false,
								'message' => $error,
							));
						}
					} else {
						$this->session->set_flashdata('package_data', array(
							'success' => false,
							'message' => 'Mohon isi semua data',
						));
					}
				}
				$this->data['mode'] = $route;
				$this->data['view'] = 'package_add';
			} else if ($route === 'remove') {
				$this->data['data'] = array('title' => 'Loading', 'description' => 'Menghapus data ...', 'url' => base_url() . "admin/package");
				$this->data['view'] = 'process';
				$prefix_path = '';
				$res_package = $this->package_models->get(array('url' => $url));
				if ($res_package) {
					if ($res_package[0]->photo_1 && file_exists('cdn/' . $res_package[0]->photo_1_uuid . '.jpg')) {
						unlink($prefix_path . 'cdn/' . $res_package[0]->photo_1_uuid . ".jpg");
					}
					if ($res_package[0]->photo_2 && file_exists('cdn/' . $res_package[0]->photo_1_uuid . '.jpg')) {
						unlink($prefix_path . 'cdn/' . $res_package[0]->photo_2_uuid . ".jpg");
					}
					if ($res_package[0]->photo_3 && file_exists('cdn/' . $res_package[0]->photo_1_uuid . '.jpg')) {
						unlink($prefix_path . 'cdn/' . $res_package[0]->photo_3_uuid . ".jpg");
					}
					if ($res_package[0]->photo_4 && file_exists('cdn/' . $res_package[0]->photo_1_uuid . '.jpg')) {
						unlink($prefix_path . 'cdn/' . $res_package[0]->photo_4_uuid . ".jpg");
					}
					$delete_package = $this->package_models->delete(array('url' => $url));
					if ($delete_package) {
						$this->session->set_flashdata('package_data', array(
							'success' => true,
							'message' => 'Paket telah dihapus'
						));
						redirect(base_url('admin/package'));
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
			}
			$res_category = $this->category_models->get();
			$this->data['category_list'] = $res_category;

//		else if ($route === 'dispatch_recommendation') {
//				$this->data['data'] = array('title' => 'Loading', 'description' => 'Melepas rekomendasi ...', 'url' => base_url() . "admin/package");
//				$this->data['view'] = 'process';
//
//				$id = $this->input->get('id');
//
//				$delete_promoted = $this->promoted_models->delete(array('id' => $id));
//				if ($delete_promoted) {
//					$this->session->set_flashdata('package_data', array(
//						'success' => true,
//						'message' => 'Rekomendasi telah dilepas'
//					));
//				} else {
//					$this->session->set_flashdata('package_data', array(
//						'success' => false,
//						'message' => 'Paket gagal dilepas'
//					));
//				}
		} else {
			$res_package = $this->package_models->get();
			$this->data['package_list'] = $res_package;
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
			'word' => substr(str_shuffle('123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6),
			'img_path' => 'assets/image/captcha/',
			'img_url' => base_url() . 'assets/image/captcha/',
			'img_width' => 150,
			'img_height' => 50,
			'expiration' => 1800,
			'word_length' => 6,
			'font_size' => 36,
			'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors' => [
				'background' => [0, 0, 0],
				'border' => [255, 255, 255],
				'text' => [255, 255, 255],
				'grid' => [200, 200, 200]
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
			if ($captcha_input && $captcha_input === $captcha) {
				if ($username && $password) {
					$res_login = $this->user_models->login(array('username' => $username, 'password' => $password));

					if ($res_login && sizeof($res_login) > 0) {
						$session = array(
							'id' => $res_login[0]->id,
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
			} else {
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
