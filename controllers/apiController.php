<?php
	
	namespace Core\Controllers;
	
	use Core\quiz;
	use Core\User;
	
	class apiController {
		public function __construct() {
			$user = new User();
			if( $user->login( $_GET['login'], $_GET['password'] ) !== true ){
				http_response_code(401);
				echo json_encode(['message' => 'Authentication failed']);
				die();
			}
			
			$quiz = new quiz();
			$rand_quiz = $quiz->getRandomQuiz();
			$rand_quiz = $rand_quiz->fetch_row();
			
			if (empty($rand_quiz) || $rand_quiz == NULL){
				http_response_code(404);
				echo json_encode(['message' => 'Not Found']);
				die();
			}
			
			$response = [
				'id' => $rand_quiz[0],
				'question' => $rand_quiz[1],
				'status' => $rand_quiz[2],
				'date' => $rand_quiz[3],
				'answers' => array_map( function ($val){ return explode( '|', $val ); }, explode( ', ', $rand_quiz[5] ) )
			];
			
			http_response_code(200);
			echo json_encode($response);
			die();
		}
	}