<?php 
	class Validate{
// Method to escape user inputs

		public static function escape($input){
			$input = trim(strip_tags($input));
			$input = stripslashes($input);
			$input = htmlentities($input, ENT_QUOTES);
			return $input;
		}

		public function filterEmail($email){
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

        // Check length of user inputs
		public function length($input, $min, $max){
			if(strlen($input) > $max){
				return true;
			}else if(strlen($input) < $min){
				return true;
			}
		}
	}
?>