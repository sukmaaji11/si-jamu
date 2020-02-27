<?php
if ($this->session->userdata('role_id') == 1) {
	redirect('admin/admin');
} else if ($this->session->userdata('role_id') == 2) {
	redirect('user/user');
}
?>
<form method="POST" action="<?= base_url() . 'auth' ?>" class="form-signin">
	<img class="mb-4" src="assets/login/images/logo.png" alt="" width="120" height="120">
	<h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Login</h1>
	<?= $this->session->flashdata('message'); ?>
	<label for="username" class="sr-only">Email address</label>
	<span><?= form_error('username', '<small class="text-danger">', '</small>'); ?></span>
	<input value="<?= set_value('username'); ?>" class="form-control" id="username" type="text" name="username" placeholder="Username">

	<label for="inputPassword" class="sr-only">Password</label>
	<span><?= form_error('password', '<small class="text-danger">', '</small>'); ?></span>
	<input type="password" id="password" name="password" class="form-control" placeholder="Password">

	<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	<p class="mt-5 mb-3 text-muted" style="text-align: center">&copy; 2020 SI JAMU</p>
	<p class="mb-3 text-muted" style="text-align: center">By Sukma Aji Yudantomo</p>
</form>