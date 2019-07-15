<?php
	namespace App\Controllers;
	
	use App\Models\Group;
	use App\Models\Server;
	use App\Models\History;
	use App\Core\View;
	use App\Controllers\Controller;
	use \DateTime;
	
	class GroupController extends Controller {
		
		public function index() {
			$group = new Group();
			$groups = $group->getAllGroups();
			
			for($i = 0; $i < count($groups); $i++) {
				$server = new Server;
				$servers = $server->getServersByGroupId($groups[$i]['id']);
				$groups[$i]['servers'] = $servers;
				
				for($j = 0; $j < count($servers); $j++) {
					$lastPing = $server->getLastPing($groups[$i]['servers'][$j]['id']);
					$groups[$i]['servers'][$j]['ping'] = $lastPing;
				}
			}
			View::render('group.list', ['groups' => $groups]);
		}
		
		public function create() {
		
			if (isset($_POST['save'])) {
				$group = new Group();
				$group->setName($_POST['name']);
				$group->createGroup();

				View::redirectTo('');
			} 
			View::render('group.create', []);
		}
		
		public function ping() {
			
			if (isset($_POST['id']) && isset($_POST['address'])) {
				$ip = $_POST['address'];
				$pingreply = exec("ping -n 2 " .$ip, $output, $result);
				$creationDate = new DateTime();
				
				$record = new History();
				$record->setCreationDate($creationDate->format('Y-m-d H:i:s'));
				$record->setIdServer($_POST['id']);
				$record->setStatus(iconv("CP866", "UTF-8", $result));
				$record->setOutput(iconv("CP866", "UTF-8", implode("|",$output)));
				$record->createHistoryRecord();
				echo json_encode(array( 'status' => $record->getStatus(),
										'date' => $record->getCreationDate(),
										'id_server' => $_POST['id']));
			}
		}
	}