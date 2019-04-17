<?php

if(!Session::exist('zalogowany')) {
	require_once 'loguj.php';
	die();
} else {
	echo '<div class="text-center alert alert-success">Jesetś zalogowany jako: '.Session::get('user'). '&nbsp;&nbsp;
	<a href="index.php?akcja=wyloguj">Wyloguj się</a>;
	</div>';

			if(Input::exist('get') && !empty(Input::get('akcja'))){ 
				switch (Input::get('akcja')) {
					case 'wyloguj':
						Session::delete('zalogowany');
						Session::delete('user');
						Redirect::to('index.php');
						break;

					case 'lista':
						require_once 'lista.php';
						break;

					case 'dodaj':
						require_once 'dodaj.php';
						break;
					
					default:
						require_once 'lista.php';
						break;
				}
			} else {
				require_once 'lista.php';
			}
}
