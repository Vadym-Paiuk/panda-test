<?php
	namespace Core;
	
	class app {
		public function __construct() {
			session_start();
			global $db;
			
			$db = new DB( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );
			$db = $db->db_connect();
			
			$router = new Router();
			$router->addRoute('/', 'home');
			$router->addRoute('/login', 'login');
			$router->addRoute('/logout', 'logout');
			$router->addRoute('/registration', 'registration');
			$router->addRoute('/account', 'account');
			
			$url = $_SERVER['REQUEST_URI'];
			$router->handleRequest($url);
		}
	}