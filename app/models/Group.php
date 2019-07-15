<?php
	namespace App\Models;
	
	use App\Core\Database;
	
	class Group {
		
		private $connection;
		private $table = 'groups';
		
		private $id;
		private $name;
		
		public function __construct() {
			$this->connection = Database::connect();
		}
		
		public function getId() { 
			return $this->id; 
		} 
		public function setId($id) { 
			$this->id = $id; 
		}
		
		public function getName() { 
			return $this->name; 
		} 
		public function setName($name) { 
			$this->name = $name; 
		}
		
		public function getAllGroups() {
			$stmt = $this->connection->prepare("SELECT * FROM $this->table");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		
		public function getGroupById($id) {
			$stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetch();
		}
		
		public function createGroup() {
			if (isset($group->id)) {
				return $this->updateGroup($group);
			}
			$stmt = $this->connection->prepare("INSERT INTO $this->table (name) VALUES (:name)");
			$stmt->bindParam(':name', $this->name);
			return $stmt->execute();
		}
	}