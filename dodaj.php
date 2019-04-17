<?php
if (Input::exist('post')) {
	$opis = Input::get('opis');
	$cena = Input::get('cena');
	$rodz = Input::get('rodz');
	$dzien = Input::get('dzien');

	if(!empty($opis) && !empty($cena) && !empty($rodz) && !empty($dzien)) {
		$karnet = new Karnet();

		$karnet->zapisz($opis, $cena, $rodz, $dzien);
	}


}
?>
<a class="btn btn-primary" href="index.php">Powrót</a><br><br>
<form method="post" action="index.php?akcja=dodaj">
	
	<div class="form-group">
		<label for="opis">Opis</label>
		<select name="opis" id="opis">
			<option checked>Wjeście na basen</option>
			<option>Doładowanie karnetu</option>
		</select>
	</div>

	<div class="form-group">
		<label for="cena">Cena</label>
		<select name="cena" id="cena">
			<option value="13" checked>13 zł</option>
			<option value="15">15 zł</option>
			<option value="23">23 zł</option>
			<option value="50">50 zł</option>
			<option value="100">100 zł</option>
			<option value="150">150 zł</option>
			<option value="500">500 zł</option>

		</select>
	</div>

	<div class="form-group">
		<label for="rodz">Rodzaj</label>
		<select name="rodz">
			<option>-</option>
			<option>+</option>
		</select>
	</div>

	<div class="form-group">
		<label for="Dzien">Dzień</label>
		<input type="text" name="dzien" id="dzien" value="<?= date("Y-m-d H:i:s"); ?>">
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" value="Zapisz">
	</div>


</form>