<?php

class Session 
	{
		
		private $logged_in;
		public $auth_id;
		public $mode;
		private static $idkey = '669d55221cf323ee455e8e94b4840d1ckalika_auth_id_jinsi';
		private static $modekey = '669d55221cf323ee455e8e94b4840d1ckalika_mode_jinsi';
		public $message;
		function __construct()
		{
			session_start();
			$this->check_login();
			$this->check_message();
			
		}
		
		public function is_logged_in()
		{
		
			if($this->logged_in)
			{
				return true; 	
			}
			
		}

		
		public function login($user)
		{
			// database should find user based on username/password
			if ($user)
			{
				
				$this->auth_id = $_SESSION[self::$idkey] = $user->id;
				$this->mode = $_SESSION[self::$modekey] = $user->mode;
				
				$this->logged_in = true;
			}
		}
		
		public function logout()
		{
			
			unset ($_SESSION[self::$idkey]);
			unset ($this->auth_id);
			unset ($_SESSION[self::$modekey]);
			unset ($this->mode);
			$this->logged_in = false;
			session_destroy();
		}
		
		private function check_login()
		{
			
			if (isset($_SESSION[self::$idkey]))
			{
				$this->logged_in = true;
				
			}
			else 
			{
				unset ($_SESSION[self::$idkey]);
				unset ($_SESSION[self::$modekey]);
				
				$this->logged_in = false;
			}
		}
		public function message($msg = "")
		{
			if(!empty($msg))
			{
				// then this is "set message"
				// make sure you understand why $this->message= $msg wouldn't work
				$_SESSION['message'] = $msg;
			}
			else
			{
				// then this is "get message"
				return '<span style="color:red">'.$this->message.'</span>';
			}
		}
		private function check_message()
		{
			// Is there a message stored in the session
			if (isset($_SESSION['message']))
			{
				// Add it as an attribute and erase the stored version
				$this->message = $_SESSION['message'];
				unset($_SESSION['message']);
			}
			else
			{
				$this->message = "";
			}
		}
	}
	$session = new Session();	
	$message = $session->message();
	
	
	
?>