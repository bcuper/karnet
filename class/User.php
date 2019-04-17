<?php

class User {
	private $_db,
			$_data;


	public function login ($username = null, $password = null) {

		$user = $this->find($username);


		if ($user && $user->pass == md5($password)) {
			Session::set('zalogowany', 'true');
			Session::set('user', $username);
			Redirect::to('index.php');
		} else {
			echo '<div class="alert alert-danger">Login i hasło nie pasują do siebie</div>';
		}
	}

	private function find($username) {

		$data = DB::conn()->zapytanieWiersz("SELECT * FROM users WHERE login = '".$username."'");

		return $data;

	}
}