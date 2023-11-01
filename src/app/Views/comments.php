<?php
helper('form');

$userModel = model(User::class);
$user = $userModel->where('email', session()->get('email'))->first();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Тестовое задание</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<style>
		nav {
			display: flex;
			justify-content: center;
		}

		.pagination {
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
		}

		.pagination li {
			margin: 10px 7px;
		}
		.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
	margin: 5px;
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
	</style>

<body>
	<div id="comments">
		<div style="background-color: #eee;">
			<div class="container my-5 py-5">
				<div class="row d-flex justify-content-center d-flex">
					<div class="sort d-flex flex-column">
											<div class="dropdown">
						<button class="dropbtn bg-primary">Sorty by:</button>
						<div class="dropdown-content">
							<a href="/?sortType=created_at&sortDir=<?= $sort['sortDir'] ?: 'desc' ?>">Creation time</a>
							<a href="/?sortType=id&sortDir=<?= $sort['sortDir'] ?: 'desc' ?>">Comment id</a>
						</div>
					</div>
					<div class="dropdown">
						<button class="dropbtn bg-primary">Sort direction:</button>
						<div class="dropdown-content">
							<a href="/?sortDir=asc&sortType=<?= $sort['sortType'] ?: 'desc' ?>">Ascending</a>
							<a href="/?sortDir=desc&sortType=<?= $sort['sortType'] ?: 'desc' ?>">Descending</a>
						</div>
					</div>
					</div>

					<div class="col-md-12 col-lg-10 col-xl-8">
						<div class="card">
							<?php

							use App\Models\Comment;
							use App\Models\User;

							foreach ($comments as $comment) :
								$commentUser = model(User::class)->find($comment['user_id']);
							?>
								<div class="card-body">

									<div class="d-flex flex-start align-items-center">
										<div>
											<h6 class="fw-bold text-primary mb-1"><?= $commentUser['email']; ?></h6>
											<p class="text-muted small mb-0">
												<?php echo $comment['created_at']; ?>
											</p>
										</div>

									</div>

									<p class="mt-3 mb-4 pb-2">
										<?= $comment['text']; ?>
									</p>
									<?php if ($commentUser['email'] == session()->get('email')) : ?>
										<div>
											<a class="text-danger" href="/deleteComment?id=<?= $comment['id'] ?>">Delete comment</a>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
							<?= $pager->links(); ?>
							<div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
								<?php echo form_open('/addComment'); ?>
								<div class="d-flex flex-start w-100">
									<div class="form-outline w-100">
										<textarea class="form-control" name="text" id="textAreaExample" rows="4" style="background: #fff;"></textarea>
										<label class="form-label" for="text">Message</label>
									</div>
								</div>

								<input type="hidden" name="user_id" value="<?= $user['id'] ?>">
								<div class="float-end mt-2 pt-1">
									<button type="submit" class="btn btn-primary btn-sm">Post comment</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<footer>
	</footer>

	<!-- SCRIPTS -->

	<script>
	</script>

</body>

</html>