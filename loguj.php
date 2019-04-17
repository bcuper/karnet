<?php

if (Input::exist('post')) {
	if (!empty(Input::get('login')) && !empty(Input::get('pass'))) {
		$login = Input::get('login');
		$pass = Input::get('pass');

		$user = new User();
		$user->login($login, $pass);

	} else {
		echo '<div class="aler alert-danger">Musisz podać wszystkie dane</div>';
	}
	
}


?>
<h1 class="text-center">Logowanie</h1>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<table class="table">
			<form method="post">
				<tr>
					<th>Login:</th>
					<td><input type="text" name="login" id="login"></td>
				</tr>
				<tr>
					<th>Hasło:</th>
					<td><input type="password" name="pass" id="pass"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Loguj">
					</td>
				</tr>
			</form>
		</table>
	</div>
	<div class="col-md-4"></div>
</div>