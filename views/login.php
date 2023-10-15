<?php
	require_once ROOT_PATH . 'views/header.php';
?>
	<main class="form-signin w-100 m-auto">
		<form method="POST" action="">
			<h1 class="h3 mb-3 fw-normal"><?php echo $data['content']; ?></h1>
			
			<?php if( !empty( $data['errors'] ) ): ?>
				<?php foreach ( $data['errors'] as $message ): ?>
					<p class="error_message"><?php echo $message; ?></p>
				<?php endforeach; ?>
			<?php endif; ?>
			
			<div class="form-floating">
				<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
				<label for="floatingInput">Email address</label>
			</div>
			<div class="form-floating">
				<input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Password</label>
			</div>
			
			<div class="form-check text-start my-3">
				<input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
				<label class="form-check-label" for="flexCheckDefault">
					Remember me
				</label>
			</div>
			<button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
		</form>
	</main>

<?php
	require_once ROOT_PATH . 'views/footer.php';