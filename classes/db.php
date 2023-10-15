<?php
	namespace Core;
	
	class DB {
		protected $dbuser;
		protected $dbpassword;
		protected $dbname;
		protected $dbhost;
		protected $dbh;
		
		public function __construct( $dbuser, $dbpassword, $dbname, $dbhost ) {
			$this->dbuser     = $dbuser;
			$this->dbpassword = $dbpassword;
			$this->dbname     = $dbname;
			$this->dbhost     = $dbhost;
		}
		
		public function db_connect() {
			$this->dbh = mysqli_init();
			
			$success = mysqli_real_connect( $this->dbh, $this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname );
			
			if ( !$success ){
				die('Connect Error (' . $this->dbh->connect_errno . ') ' . $this->dbh->connect_error);
			}
			
			return $this->dbh;
		}
	}