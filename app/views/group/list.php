<? include_once __DIR__.'/../header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-sm">
			<h2>Groups</h2>
			<a class="btn-new-group" href="groups/create">New Group</a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm">
		<?php if (!empty($groups)) { ?>
			<div class="accordion" id="accordionGroups">
				<?php foreach($groups as $group) { ?>
					  <div class="card">
						<div class="card-header" id="heading">
							<button class="btn btn-group" type="button" data-toggle="collapse" 
									data-target="#collapse<?php echo $group['id']; ?>" aria-expanded="true" 
									aria-controls="collapse<?php echo $group['id']; ?>">
							  <h3><?php echo $group['name'] ?></h3>
							</button>
							<a class="btn btn-group-history" href="/history?id=<?php echo $group['id']; ?>">History</a>
							<a class="btn btn-group-add" href="servers/create?id=<?php echo $group['id']; ?>">+</a>
						</div>
						
						
						<div id="collapse<?php echo $group['id']; ?>" class="collapse show" aria-labelledby="heading" data-parent="#accordionGroups">
						  <div class="card-body">
							<?php if (!empty($group['servers'])) { ?>
							<table class="table">
								<th>IP</th>
								<th>Status</th>
								<th>Last Check</th>
								<th></th>
								<?php foreach($group['servers'] as $server) { ?>
									<tr>
										
											<td><?php echo $server['address'] ?></td>
											<td id="status-<?php echo $server['id'] ?>">
											<?php 
												if ($server['ping'][0]['status'] == 0 && !empty($server['ping'])) {
													echo "Live";
												} elseif ($server['ping'][0]['status'] == 1) {
													echo "Down";		
												} else {
													echo "N/A";		
												} 
											?>
												<div id="spinner-<?php echo $server['id'] ?>"></div>
											</td>
											<td id="date-<?php echo $server['id'] ?>"><?php echo $server['ping'][0]['creationDate'] ?></td>
											<form id="<?php echo $server['id'] ?>" method="post" class="ping-form">
											<input type="hidden" name="address" value="<?php echo $server['address'] ?>" id="address" class="address" readonly>
											
											<td>
												<button type="submit" class="btn btn-group-ping" name="ping" id="ping">Ping</button>
											</td>
											</form>
										
									</tr>
								<?php } ?>
								</table>
							<?php } else { ?>
							<p>No servers here...</p>
							<?php } ?>
						  </div>
						</div>
					  </div>
				<?php } ?>	
			</div>
		<?php } else echo "No Groups Found..."; ?>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.ping-form').submit(function(e) {
		
		let id = $(this).attr('id');
		let address = $('#'+id).find("input");
		
		$( "#spinner-" + id).addClass( "spinner-border spinner-border-sm" );
		
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/groups/ping',
            data: {id: id, address: address['prevObject'][0][0]['value']},
            success: function(response) {
				$( "#spinner-" + id).removeClass( "spinner-border spinner-border-sm" );
				
                var ping = JSON.parse(response);
				if (ping['status'] == '0') {
					$('#status-' + ping['id_server'] ).text('Live');
				} else {
					$('#status-' + ping['id_server'] ).text('Down');
				}
				$('#date-' + ping['id_server'] ).text(ping['date']);
				console.log(ping);
            }
       });
     });
});
</script>