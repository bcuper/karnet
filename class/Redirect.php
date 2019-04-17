<?php

class Redirect {

	public static function to($loc = null) {

		if ($loc) {
			header('Location: '.$loc);
			exit();
		}
	}

}