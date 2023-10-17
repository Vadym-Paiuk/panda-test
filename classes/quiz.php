<?php
	
	namespace Core;
	
	class quiz {
		private $db;
		private $user;
		
		public function __construct() {
			global $db;
			$this->db = $db;
			$this->user = new User();
		}
		
		public function getUserQuizzes( $orderby, $order = 'ASC' ){
			$user_id = $this->user->get_current_user_id();
			$stmt = $this->db->stmt_init();
			$stmt->prepare("SELECT * FROM quizzes WHERE user = $user_id ORDER BY $orderby $order");
			//$stmt->bind_param( 'ss', $orderby, $order );
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			
			return $result;
		}
		
		public function getQuiz( $id ){
			$user_id = $this->user->get_current_user_id();
			$stmt = $this->db->stmt_init();
			$stmt->prepare("SELECT * FROM quizzes INNER JOIN answers ON quizzes.id = answers.parent WHERE quizzes.id = ? AND quizzes.user = ?");
			$stmt->bind_param( 'ii', $id, $user_id );
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			
			return $result;
		}
		
		public function getRandomQuiz(){
			$user_id = $this->user->get_current_user_id();
			$stmt = $this->db->stmt_init();
			$stmt->prepare("SELECT q.*,
        (SELECT GROUP_CONCAT(CONCAT(title, '|', votes) SEPARATOR ', ')
        FROM answers a
        WHERE a.parent = q.id)
FROM quizzes q
WHERE q.user = $user_id
ORDER BY RAND()
LIMIT 1;");
			
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			
			return $result;
		}
		
		public function createQuiz($data){
			$stmt = $this->db->stmt_init();
			$stmt->prepare("INSERT INTO quizzes (title, status) VALUES (?, ?)");
			$stmt->bind_param( 'ss', $data['title'], $data['status'] );
			$stmt->execute();
			$quizID = $stmt->insert_id;
			$stmt->close();
			
			return $quizID;
		}
		
		public function createAnswer($data){
			$stmt = $this->db->stmt_init();
			$stmt->prepare("INSERT INTO answers (title, parent, votes) VALUES (?, ?, ?)");
			$stmt->bind_param( 'sdd', $data['title'], $data['parent'], $data['votes'] );
			$stmt->execute();
			$stmt->fetch();
			$answerID = $stmt->insert_id;
			$stmt->close();
			
			return $answerID;
		}
		
		public function updateQuiz($data){
			$stmt = $this->db->stmt_init();
			$stmt->prepare("UPDATE quizzes SET title = ?, status = ? WHERE id = ?");
			$stmt->bind_param( 'ssd', $data['title'], $data['status'], $data['id'] );
			$stmt->execute();
			$stmt->fetch();
			$result = $stmt->affected_rows;
			$stmt->close();
			
			return $result;
		}
		
		public function updateAnswer($data){
			$stmt = $this->db->stmt_init();
			$stmt->prepare("UPDATE answers SET title = ?, votes = ? WHERE id = ?");
			$stmt->bind_param( 'ssd', $data['title'], $data['votes'], $data['id'] );
			$stmt->execute();
			$stmt->fetch();
			$result = $stmt->affected_rows;
			$stmt->close();
			
			return $result;
		}
		
		public function deleteQuiz($id){
			$this->deleteQuizAnswers($id);
			
			$stmt = $this->db->stmt_init();
			$stmt->prepare("DELETE from quizzes WHERE id = ?");
			$stmt->bind_param( 'd', $id );
			$stmt->execute();
			$stmt->close();
		}
		
		public function deleteAnswer($id){
			$stmt = $this->db->stmt_init();
			$stmt->prepare("DELETE from answers WHERE id = ?");
			$stmt->bind_param( 'd', $id );
			$stmt->execute();
			$stmt->close();
		}
		
		public function leaveAnswers($data){
			$placeholders = implode(',', array_fill(0, count($data['ids']), '?'));
			$stmt = $this->db->stmt_init();
			$stmt->prepare("DELETE from answers WHERE parent = ? AND id NOT IN ($placeholders)");
			$stmt->bind_param( str_repeat('i', count($data['ids']) + 1), $data['parent'], ...$data['ids'] );
			$stmt->execute();
			$stmt->close();
		}
		
		public function deleteQuizAnswers($id){
			$stmt = $this->db->stmt_init();
			$stmt->prepare("DELETE from answers WHERE parent = ?");
			$stmt->bind_param( 'd', $id );
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
		}
	}