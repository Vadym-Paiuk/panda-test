<?php
	require_once ROOT_PATH . 'views/header.php';
?>
	<div class="container-fluid">
		<div class="row">
			<?php
				require_once ROOT_PATH . 'views/sidebar.php';
			?>
			
			<main class="col-9 ms-sm-auto px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Dashboard</h1>
					<div class="btn-toolbar  mb-2 mb-md-0">
						<form action="" method="post" class="d-flex flex-row gap-3">
							<div class="form-floating">
								<select name="orderby" class="form-select">
									<option value="date" <?php if(!empty($_POST['orderby']) && $_POST['orderby'] == 'date') echo 'selected'; ?>>Date</option>
									<option value="title" <?php if(!empty($_POST['orderby']) && $_POST['orderby'] == 'title') echo 'selected'; ?>>Title</option>
									<option value="status" <?php if(!empty($_POST['orderby']) && $_POST['orderby'] == 'status') echo 'selected'; ?>>Status</option>
								</select>
								<label>Sort by</label>
							</div>
							<div class="form-floating">
								<select name="order" class="form-select">
									<option value="ASC" <?php if(!empty($_POST['order']) && $_POST['order'] == 'ASC') echo 'selected'; ?>>ASC</option>
									<option value="DESC" <?php if(!empty($_POST['order']) && $_POST['order'] == 'DESC') echo 'selected'; ?>>DESC</option>
								</select>
								<label>Sort</label>
							</div>
							<button class="btn btn-outline-primary">SORT</button>
						</form>
					</div>
				</div>
				
				<h2>Quizzes</h2>
				<div class="table-responsive small">
					<?php
						if( !empty( $data['quizzes'] ) ){?>
							<table class="table table-striped table-sm">
								<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Title</th>
									<th scope="col">Date</th>
									<th scope="col">Status</th>
									<th scope="col">Edit</th>
									<th scope="col">Delete</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($data['quizzes'] as $quiz): ?>
								<tr>
									<td><?php echo $quiz['id']; ?></td>
									<td><?php echo $quiz['title']; ?></td>
									<td><?php echo $quiz['date']; ?></td>
									<td><?php echo $quiz['status']; ?></td>
									<td><a href="/quiz?id=<?php echo $quiz['id']; ?>">Edit</a></td>
									<td><a href="/quiz?delete=<?php echo $quiz['id']; ?>">Delete</a></td>
								</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						<?php }else{
							echo 'Quizzes not found';
						}
					?>
				</div>
			</main>
		</div>
	</div>
	<main class="w-100 m-auto">
	
	</main>

<?php
	require_once ROOT_PATH . 'views/footer.php';