<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php $this->load->view('admin/component/head'); ?>
<body class="bg-gradient-primary">

<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center align-items-center vh-100">

		<div class="col-xl-10 col-lg-12 col-md-9">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h5 text-gray-900 mb-4">Mertojaya Catering Admin</h1>
								</div>
								<?php $this->load->view('admin/component/alert', array('data' => $this->session->flashdata('login_data'))) ?>
								<form class="user" action="" method="post">
									<div class="form-group">
										<input type="username" name="username" class="form-control form-control-user"
											   id="username" aria-describedby="username"
											   placeholder="Email atau Username...">
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control form-control-user"
											   id="password" placeholder="Kata Sandi">
									</div>
									<div class="d-flex align-items-center mb-3">
										<?= $captcha ?>
										<input type="text" name="captcha" class="ml-2 form-control form-control-user"
											   id="captcha" aria-describedby="captcha"
											   placeholder="Masukan kode captcha">
									</div>
									<button type="submit" name="login" class="btn btn-primary btn-user btn-block btn-icon-split">
										Masuk
									</button>
								</form>
								<hr>
								<div class="text-center">
									<a class="small" href="forgot-password.html">Lupa kata sandi?</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

<?php $this->load->view('admin/component/foot'); ?>
</body>

</html>
