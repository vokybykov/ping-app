<?php
	namespace App\Controllers;
	
	use App\Models\Server;
	use App\Core\View;
	use App\Controllers\Controller;
	
	class ServerController extends Controller {
		
		public function create() {
			if (isset($_POST['save'])) {
				$server = new Server();
				$server->setAddress($_POST['address']);
				if (isset($_GET['id'])) {
					$server->setIdGroup($_GET['id']);
				} else {
					$server->setIdGroup($_POST['id_group']);
				}
				$server->createServer();
				View::redirectTo('');
			} 
			View::render('server.create', []);
		}
	}