<?php
	namespace App\Models;
	
	use App\Core\Database;
	use PDO;
	
	class History {
		
		private $connection;
		private $table = 'history';
		
		private $id;
		private $creationDate;
		private $id_server;
		private $status;
		private $output;
		
		public function __construct() {
			$this->connection = Database::connect();
		}
		
		public function getId() { 
			return $this->id; 
		} 
		public function setId($id) { 
			$this->id = $id; 
		}
		
		public function getCreationDate() { 
			return $this->creationDate; 
		} 
		public function setCreationDate($creationDate) { 
			$this->creationDate = $creationDate; 
		}
		
		public function getIdServer() { 
			return $this->id_server; 
		} 
		public function setIdServer($id_server) { 
			$this->id_server = $id_server; 
		}
		
		public function getStatus() { 
			return $this->status; 
		} 
		public function setStatus($status) { 
			$this->status = $status; 
		}
		
		public function getOutput() { 
			return $this->output; 
		} 
		public function setOutput($output) { 
			$this->output = $output; 
		}
		
		public function getHistoryByGroup($idGroup) {
			$stmt = $this->connection->prepare("SELECT h.id, h.creationDate, h.id_server, h.status, h.output, s.address FROM history as h, servers as s
													WHERE h.id_server = s.id AND h.id_server
														IN (SELECT id FROM servers WHERE id_group = :id)");
			$stmt->bindParam(':id', $idGroup);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function createHistoryRecord() {
			$stmt = $this->connection->prepare("INSERT INTO $this->table (creationDate, id_server, status, output) VALUES (:creationDate, :id_server, :status, :output)");
			$stmt->bindParam(':creationDate', $this->creationDate);
			$stmt->bindParam(':id_server', $this->id_server);
			$stmt->bindParam(':status', $this->status);
			$stmt->bindParam(':output', $this->output);
			return $stmt->execute();
		}
	}