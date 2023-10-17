<?php
	
	namespace Core\Controllers;
	
	use Core\baseController;
	use Core\quiz;
	use Core\Router;
	
	class quizController extends baseController {
		private $quiz;
		public function __construct($slug) {
			$this->quiz = new quiz();
			$this->checkPermissions();
			
			$this::add();
			$this::update();
			$this::delete();
			$data = $this->loadSomeData();
			$this->loadView($slug, $data);
		}
		
		protected function loadView($viewName, $data = []) {
			if ( isset( $_GET['id'] ) ){
				$viewName .= '-edit';
			}
			ob_start();
			include('views/' . $viewName . '.php');
			echo ob_get_clean();
		}
		
		protected function loadSomeData() {
			$data = [
				'title' => 'Quiz Page',
				'content' => 'Add new Quiz'
			];
			
			if( isset( $_GET['id'] ) ){
				$quiz = $this->quiz->getQuiz( $_GET['id'] );
				
				if( $quiz->num_rows === 0 ){
					$data = [
						'title' => 'Edit Quiz',
						'content' => 'Edit Quiz',
						'quiz' => 'Error'
					];
					return $data;
				}
				
				foreach ($quiz->fetch_all() as $quiz){
					$quiz_new['id'] =  $quiz[0];
					$quiz_new['title'] =  $quiz[1];
					$quiz_new['status'] =  $quiz[2];
					$quiz_new['date'] =  $quiz[3];
					
					if (!empty($quiz[4])){
						$quiz_new['answers'][] = [
							'id' => $quiz[4],
							'title' => $quiz[5],
							'votes' => $quiz[7]
						];
					}
				}
				
				$data = [
					'title' => 'Edit Quiz',
					'content' => 'Edit Quiz',
					'quiz' => $quiz_new
				];
			}
			
			return $data;
		}
		
		private function add(){
			if ( empty( $_POST['action'] ) ){
				return;
			}
			
			if ( $_POST['action'] !== 'add' ){
				return;
			}
			
			$data = [
				'title' => $_POST['question'],
				'status' => $_POST['status']
			];
			$quizID = $this->quiz->createQuiz( $data );
			
			if ( !empty($_POST['answers']) ){
				foreach ( $_POST['answers'] as $key => $answer ){
					$data = [
						'title' => $answer,
						'parent' => $quizID,
						'votes' => $_POST['votes'][$key]
					];
					$this->quiz->createAnswer( $data );
				}
			}
			
			header("Location: /quiz?id=" . $quizID);
			die();
		}
		
		private function update(){
			if ( empty( $_POST['action'] ) || empty( $_GET['id'] ) ){
				return;
			}
			
			if ( $_POST['action'] !== 'update' ){
				return;
			}
			
			$data = [
				'id' => $_GET['id'],
				'title' => $_POST['question'],
				'status' => $_POST['status']
			];
			$this->quiz->updateQuiz( $data );
			
			$data = [
				'parent' => $_GET['id'],
				'ids' => $_POST['answer_id']
			];
			$this->quiz->leaveAnswers($data);
			
			foreach ( $_POST['answer_id'] as $key => $id ) {
				if ( (int)$id !== 0 ){
					$update_answers = [
						'id' => $id,
						'title' => $_POST['answers'][$key],
						'votes' => $_POST['votes'][$key]
					];
					$this->quiz->updateAnswer( $update_answers );
				}else{
					$create_answers = [
						'title' => $_POST['answers'][$key],
						'votes' => $_POST['votes'][$key],
						'parent' => $_GET['id']
					];
					$this->quiz->createAnswer( $create_answers );
				}
			}
		}
		
		private function delete(){
			if ( empty( $_GET['delete'] ) ){
				return;
			}
			
			$this->quiz->deleteQuiz( $_GET['delete'] );
			header("Location: /account");
			die();
		}
	}