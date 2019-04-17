
<div><a class="btn btn-primary" href="index.php?akcja=dodaj">Dodaj</a></div><br>
<table class="table table-bordered table-hover table-sm">
	<tr>
		<th>Lp.</th>
		<th>Opis</th>
		<th>Koszt</th>
		<th>Data</th>
	</tr>
	<?php

	$karnet = new Karnet();
	$res = $karnet->zwrocOperacje();
	$sum = 0;
	$data = '';
	$zakup = 0;
	for($i = 0; $i < count($res); $i++) {
		echo '<tr class="';
		echo ($res[$i]->rodz == '-') ? 'table-danger' : 'table-success';
		echo '">';
		echo '<td>'.($i+1).'</td>';
		echo '<td>'.$res[$i]->opis.'</td>';
		echo '<td>'.$res[$i]->rodz.$res[$i]->koszt.'</td>';
		echo '<td>'.$res[$i]->data.'</td>';
		echo '</tr>';

		if ($res[$i]->rodz == '+') {
			$data = $res[$i]->data;
			$zakup = $res[$i]->koszt;
		}
	}
	echo '</table><br>';



	
	$data_koniec = date("Y-m-d", strtotime($data.dni($zakup)));
	$nowa_data_koniec = date_create($data_koniec);

	$data = date("Y-m-d", strtotime('now'));
	$nowa_data = date_create($data);

	$do_konca = date_diff($nowa_data, $nowa_data_koniec);

	echo "<p>Saldo: " . $karnet->saldo() . ' zł</p>';
	echo '<p>Karnet kończy się ' . $data_koniec .' </p>';
	echo '<p>Do końca karnetu zostało: '.$do_konca->m .' miesiące i ' . $do_konca->d .' dni. Razem: ' . $do_konca->days . ' dni.</p>';

	echo '<br>Z dostępnym saldem można wejść: ';
	echo '<table class="table table-bordered table-hover table-sm">';
	echo '<tr><th>Cena biletu</th><th>Liczba wejść</th></tr>';
	echo '<tr><th>13 zł - Strefa H2O</th><td>'.(int)($karnet->saldo()/13).'</td></tr>';
	echo '<tr><th>15 zł - Łabędzia</th><td>'.(int)($karnet->saldo()/15).'</td></tr>';
	echo '<tr><th>23 zł - Aqua</th><td>'.(int)($karnet->saldo()/23).'</td></tr>';
	?>
</table>


<?php

function dni($koszt) {
	switch ($koszt) {
		case 50:
			return " +30 days";
			break;
		case 100:
			return " +60 days";
			break;
		case 150:
			return " +90 days";
			break;
		case 500:
			return " +120 days";
			break;
	}
}