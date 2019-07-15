<?php
	namespace App\Controllers;
	
	use App\Models\History;
	use App\Core\View;
	use App\Controllers\Controller;
	
	class HistoryController extends Controller {
		
		public function index() {
			if (isset($_GET["id"])) {
				$history = new History();
				$records = $history->getHistoryByGroup($_GET["id"]);
				View::render('history.list', ['records' => $records]);
			}
		}
		
		public function export() {
			if (isset($_GET["id"])) {
				$history = new History();
				$records = $history->getHistoryByGroup($_GET["id"]);
				
				$filename = 'pings_'.date('Ymd').'.csv'; 
				header('Content-Encoding: UTF-8');
				header("Content-Description: File Transfer"); 
				header("Content-Disposition: attachment; filename=$filename"); 
				header("Content-Type: application/csv; charset=UTF-8");
				
				$file = fopen('php://output','w');
				foreach ($records as $record) { 
					fputcsv($file, $record);
				}
				fclose($file); 
				exit; 
			}
		}
	}