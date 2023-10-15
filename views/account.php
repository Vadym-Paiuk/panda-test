<?php
	require_once ROOT_PATH . 'views/header.php';
?>
	<div class="container-fluid">
		<div class="row">
			<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
				<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
					<svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
					<span class="fs-4">Sidebar</span>
				</a>
				<hr>
				<ul class="nav nav-pills flex-column mb-auto">
					<li class="nav-item">
						<a href="/account" class="nav-link active" aria-current="page">
							Quizzes
						</a>
					</li>
					<li>
						<a href="/add-quiz" class="nav-link text-white">
							Add Quiz
						</a>
					</li>
					<li>
						<a href="/logout" class="nav-link text-white">
							Logout
						</a>
					</li>
				</ul>
			</div>
			
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Dashboard</h1>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="form-floating">
							<select class="form-select" id="floatingSelect" aria-label="Floating label select example">
								<option selected>Date</option>
								<option value="1">Title</option>
								<option value="2">Status</option>
							</select>
							<label for="floatingSelect">Sort</label>
						</div>
					</div>
				</div>
				
				<h2>Quizzes</h2>
				<div class="table-responsive small">
					<table class="table table-striped table-sm">
						<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Title</th>
							<th scope="col">Date</th>
							<th scope="col">Status</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>1,001</td>
							<td>random</td>
							<td>data</td>
							<td>placeholder</td>
						</tr>
						</tbody>
					</table>
				</div>
			</main>
		</div>
	</div>
	<main class="w-100 m-auto">
	
	</main>

<?php
	require_once ROOT_PATH . 'views/footer.php';