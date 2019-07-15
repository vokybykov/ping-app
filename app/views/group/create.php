<? include_once __DIR__.'/../header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-sm">
			<a class="btn btn-back" href="/">&laquo; Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm">
			<h2>Create New Server Group</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm">
			<form method="post">
				<div class="form-group">
					<label for="name">Name: </label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
				</div>
				<button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
			</form>
		</div>
	</div>
</div>