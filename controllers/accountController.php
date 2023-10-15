<?php
	
	namespace Core\Controllers;
	
	use Core\baseController;
	
	class accountController extends baseController {
		
		protected function loadSomeData() {
			$data = [
				'title' => 'Account Page',
				'content' => 'Please enter your login & password!'
			];
			
			return $data;
		}
	}