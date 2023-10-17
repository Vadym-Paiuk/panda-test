<?php
	require_once ROOT_PATH . 'views/header.php';
?>
	<div class="container-fluid">
		<div class="row">
			
			<?php
				require_once ROOT_PATH . 'views/sidebar.php';
			?>
			
			<main class="col-9 ms-sm-auto px-md-4">
				<h1><?php echo $data['content'];?></h1>
				<div class="">
					<form action="" method="post">
						<input type="hidden" name="action" value="add">
						<div class="row mb-3">
							<div class="col-10">
								<label for="question" class="form-label">Question</label>
								<input type="text" name="question" class="form-control" id="question" placeholder="Question">
							</div>
							<div class="col-2">
								<label for="floatingSelect">Status</label>
								<select class="form-select" name="status">
									<option value="publish" selected>Publish</option>
									<option value="draft">Draft</option>
								</select>
							</div>
						</div>
						<div class="d-flex flex-column w-100 mb-3 js-wrapper">
							<div class="row w-100 mb-3 js-row">
								<div class="col-10">
									<label class="form-label">Answer</label>
									<textarea class="form-control" name="answers[]" rows="1"></textarea>
								</div>
								<div class="col-2">
									<label class="form-label">Votes</label>
									<input type="number" name="votes[]" class="form-control" value="0">
								</div>
							</div>
						</div>
						<div class="mb-3 d-flex flex-row justify-content-end gap-5">
							<button type="button" class="btn btn-outline-primary js-add-row">
								Add Answer
							</button>
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
						</div>
					</form>
				</div>
			</main>
		</div>
	</div>

<?php
	require_once ROOT_PATH . 'views/footer.php';