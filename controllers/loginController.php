<?php
	namespace Core\Controllers;
	
	use Core\baseController;
	use Core\User;
	
	class loginController extends baseController {
		protected function loadSomeData() {
			$data = [
				'title' => 'Login Page',
				'content' => 'Please enter your login & password!',
				'errors' => $this::form()
			];
			
			return $data;
		}
		
		private function form(){
			if ( empty($_POST) ){
				return false;
			}
			
			$error_messages = [];
			
			if( empty( $_POST['email'] ) ){
				$error_messages[] = 'Empty Email';
			}
			
			if( empty( $_POST['password'] ) ){
				$error_messages[] = 'Empty Password';
			}
			
			if( empty( $error_messages ) ){
				$user = new User();
				$response = $user->login($_POST['email'], $_POST['password']);
				
				if ( $response === true ) {
					header('Location: /account');
					die;
				}
				
				$error_messages[] = $response;
			}
			
			return $error_messages;
		}
	}