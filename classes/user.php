<?php
	namespace Core;
	
	class User {
		private $db;
		
		public function __construct() {
			global $db;
			$this->db = $db;
		}
		
		public function register($login, $password) {
			if($this::is_user_exist($login) !== false){
				return false;
			}
			
			$password_hash = password_hash($password, PASSWORD_DEFAULT );
			
			$stmt = $this->db->stmt_init();
			$stmt->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
			$stmt->bind_param( 'ss', $login, $password_hash );
			$stmt->execute();
			$stmt->fetch();
			$userID = $stmt->insert_id;
			$stmt->close();
			
			$this->user_authorization($userID);
			
			return $userID;
		}
		
		public function login($login, $password) {
			$user = $this::is_user_exist($login);
			if ($user === false){
				return 'Wrong login';
			}
			
			if (!password_verify($password, $user['password'])) {
				return 'Wrong password';
			}
			
			if (password_needs_rehash($password, PASSWORD_DEFAULT)) {
				$newHash = password_hash($password, PASSWORD_DEFAULT);
				
				$stmt = $this->db->stmt_init();
				$stmt->prepare("UPDATE users SET `password` = ? WHERE `id` = ?");
				$stmt->bind_param( 'ss', $newHash, $user['id'] );
				$stmt->execute();
				$stmt->close();
			}
			
			$this->user_authorization($user['id']);
			
			return true;
		}
		
		public function logout() {
			if (!$this->check_auth()) {
				return false;
			}
			
			$_SESSION = array();
			session_destroy();
			
			header("Location: /");
			die();
		}
		
		private function is_user_exist($login){
			$stmt = $this->db->stmt_init();
			$stmt->prepare("SELECT * FROM users WHERE `email` = ?");
			$stmt->bind_param( 's', $login );
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			
			$user = $result->fetch_assoc();
			if ( $user === NULL ){
				return false;
			}
			
			return $user;
		}
		
		public function user_authorization($id){
			$_SESSION['user_id'] = $id;
		}
		
		public function get_current_user_id(){
			return $_SESSION['user_id'] ?? false;
		}
		
		public function check_auth(){
			return !!($_SESSION['user_id'] ?? false);
		}
	}