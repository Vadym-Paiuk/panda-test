<?php
	namespace Core;
	
	abstract class baseController {
		public function __construct() {
			$data = $this->loadSomeData();
			$this->loadView('home', $data);
		}
		
		protected function loadView($viewName, $data = []) {
			ob_start();
			include('views/' . $viewName . '.php');
			echo ob_get_clean();
		}
		
		abstract protected function loadSomeData();
	}