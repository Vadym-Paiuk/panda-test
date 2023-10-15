<?php
	namespace Core;
	use \Core\baseController;
	use \Core\controllers\homeController;
	
	class Router {
		private $routes = [];
		
		public function addRoute($url, $controller) {
			$this->routes[$url] = $controller;
		}
		
		public function handleRequest($url) {
			if (array_key_exists($url, $this->routes)) {
				$controller = $this->routes[$url];
				
				$class = $controller . 'Controller';
				// Assuming controllers are in a 'controllers' directory.
				require_once( ROOT_PATH . 'controllers/' . $class . '.php');
				
				// Instantiate the controller and call the specified method.
				$path = '\Core\controllers\\' . $controller . 'Controller';
				$controllerInstance = new $path($controller);
			} else {
				// Handle 404 - Not Found
				$this->error404();
			}
		}
		
		public function error404(){
			include('views/404.php');
		}
	}