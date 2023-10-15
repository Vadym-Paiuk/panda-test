<?php
	namespace Core\Controllers;
	
	use Core\baseController;
	use Core\User;
	
	class registrationController extends baseController {
		protected function loadSomeData() {
			$data = [
				'title' => 'Registration Page',
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
				$response = $user->register($_POST['email'], $_POST['password']);
				
				if ( $response === false ) {
					$error_messages[] = 'User already exist';
				}
				
				if ( $response === 0 ) {
					$error_messages[] = 'Error';
				}
				
				if( empty( $error_messages ) ){
					header('Location: /account');
					die;
				}
			}
			
			return $error_messages;
		}
	}
