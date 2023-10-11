<?php
	
	namespace classes;
	
	class DB {
		protected $dbuser;
		protected $dbpassword;
		protected $dbname;
		protected $dbhost;
		public $connect;
		protected $dbh;
		
		public function __construct( $dbuser, $dbpassword, $dbname, $dbhost ) {
			$this->dbuser     = $dbuser;
			$this->dbpassword = $dbpassword;
			$this->dbname     = $dbname;
			$this->dbhost     = $dbhost;
			
			$this->connect = $this->db_connect();
		}
		
		public function db_connect() {
			$this->dbh = mysqli_init();
			
			$host    = $this->dbhost;
			$port    = null;
			$socket  = null;
			$client_flags = 0;
			
			@mysqli_real_connect( $this->dbh, $host, $this->dbuser, $this->dbpassword, null, $port, $socket, $client_flags );
			
			$success = mysqli_select_db( $this->dbh, $this->dbname );
			
			if ( !$success ){
				die( 'DB ERROR' );
			}
			
			return $success;
		}
		
		public function do_query($query) {
			return mysqli_query( $this->dbh, $query );
		}
	}