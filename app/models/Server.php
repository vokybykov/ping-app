<?php
	namespace App\Models;
	
	use App\Core\Database;
	use PDO;
	
	class Server {
		
		private $connection;
		private $table = 'servers';
		
		private $id;
		private $address;
		private $id_group;
		
		public function __construct() {
			$this->connection = Database::connect();
		}
		
		public function getId() { 
			return $this->id; 
		} 
		public function setId($id) { 
			$this->id = $id; 
		}
		
		public function getAddress() { 
			return $this->address; 
		} 
		public function setAddress($address) { 
			$this->address = $address; 
		}
		
		public function getIdGroup() { 
			return $this->id_group; 
		} 
		public function setIdGroup($id_group) { 
			$this->id_group = $id_group; 
		}
		
		public function getServerById($id) {
			$stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetch();
		}
			
		public function getServersByGroupId($id) {
			$stmt = $this->connection->prepare("SELECT id, address FROM $this->table WHERE id_group = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		
		public function getLastPing($id) {
			$stmt = $this->connection->prepare("SELECT status, creationDate FROM history WHERE id_server = :id ORDER BY creationDate DESC LIMIT 1");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function createServer() {
			$stmt = $this->connection->prepare("INSERT INTO $this->table (address, id_group) VALUES (:address, :id_group)");
			$stmt->bindParam(':address', $this->address);
			$stmt->bindParam(':id_group', $this->id_group);
			return $stmt->execute();
		}
	}