<?php
	
	namespace Core\Controllers;
	
	use Core\baseController;
	
	class accountController extends baseController {
		
		protected function loadSomeData() {
			$quiz = new \Core\quiz();
			$orderby = 'id';
			$order = 'ASC';
			
			if( !empty( $_POST['orderby'] ) ){
				$orderby = $_POST['orderby'];
			}
			
			if( !empty( $_POST['order'] ) ){
				$order = $_POST['order'];
			}
			
			$quizzes = $quiz->getUserQuizzes( $orderby, $order );
			$quizzes_new = [];
			foreach ($quizzes->fetch_all() as $quiz){
				$quizzes_new[$quiz[0]]['id'] =  $quiz[0];
				$quizzes_new[$quiz[0]]['title'] =  $quiz[1];
				$quizzes_new[$quiz[0]]['status'] =  $quiz[2];
				$quizzes_new[$quiz[0]]['date'] =  $quiz[3];
			}
			
			$data = [
				'title' => 'Account Page',
				'content' => 'Please enter your login & password!',
				'quizzes' => $quizzes_new
			];
			
			return $data;
		}
	}