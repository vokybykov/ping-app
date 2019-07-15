<? include_once __DIR__.'/../header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-sm">
			<a class="btn btn-back" href="/">&laquo; Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm">
			<h2>Requests History</h2>
			<a class="btn btn-export" href="history/export?id=<?php echo $_GET["id"]; ?>">Export to CSV</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm">
			<table class="table">
				<tr align="center">
					<th>Server IP</th>
					<th>Status</th>
					<th>Date</th>
					<th>Output</th>
				</tr>
				<?php foreach($records as $record) { ?>
					<tr>
						<td><?php echo $record['address'] ?></td>
						<td><?php echo ($record['status']) ? "Down" : "Live"; ?>
						</td>
						<td width="170"><?php echo $record['creationDate'] ?></td>
						<td><?php echo $record['output'] ?></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>