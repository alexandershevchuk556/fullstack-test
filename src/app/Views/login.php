<?php helper('form'); ?>

<!DOCTYPE html>
<html>

<head>
	<title>Registration</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
	<div id="form" class="d-flex flex-column justify-content-center">

		<div>
			<h2 class="text-center">Login Form</h2>
		</div>

		<div class="align-self-center">
			<?php echo form_open('auth/login'); ?>
			<label for="email">Email:</label>
			<input type="email" name="email" required>
			<br>
			<label for="password">Password:</label>
			<input type="password" name="password" required>
			<br>
			<div class="row justify-content-center">
				<button type="submit" class="btn btn-primary">Login</button>
			</div>
			<?php echo form_close(); ?>
		</div>
		<div class="align-self-center"><a href="/register">Register</a></div>

		<!-- Validation errors -->
		<?php if (isset($errors)) : ?>
			<div class="validation-errors text-danger align-self-center">
				<?= $errors; ?>
			</div>
		<?php endif; ?>
	</div>

</body>

</html>