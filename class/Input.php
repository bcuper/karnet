<?php

class Input {

	public static function exist($type = 'post') {
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;

			case 'get':
				return (!empty($_GET)) ? true : false;
				break;
			
			default:
				return false;
				break;
		}
	}

	public static function get($name) {
		if (!empty($_POST[$name])) {
			return self::walidacja($_POST[$name]);
		} elseif (!empty($_GET[$name])) {
			return self::walidacja($_GET[$name]);
		} else {
			return '';
		}
	}

	public static function walidacja($data) {
		$data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

}