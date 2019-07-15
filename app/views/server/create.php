<? include_once __DIR__.'/../header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-sm">
			<a class="btn btn-back" href="/">&laquo; Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm">
			<h2>Create New Server</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm">
			<form method="post">

				<div class="form-group">
					<label for="address">Address: </label>
					<input type="text" name="address" class="form-control" id="address" placeholder="Address" required>
				</div>
				<?php if (!isset($_GET["id"])) {?>
				<div class="form-group">
					<label for="id_group">Group: </label>
					<input type="text" name="id_group" class="form-control" id="id_group" placeholder="Group">
				</div>
				<?php } ?>
				
				<button type="submit" class="btn btn-primary" name="save" id="save">Save</button>
			</form>
		</div>
	</div>
</div>