<?php

class Karnet {

	private $_db,
			$_operacje = null,
			$_saldo = null;

	public function __construct() {
		$this->_db = DB::conn();
	}

	public function zapisz($opis, $cena, $rodz, $dzien, $kasjer) {
		$sql = "INSERT INTO operacje (`opis`, `koszt`, `rodz`, `data`, `kasjer`) VALUES ('{$opis}', '{$cena}', '{$rodz}', '{$dzien}', '{$kasjer}')";
 		if ($this->_db->zapytanie($sql)) {
			Redirect::to('index.php');
		}
	}

	public function zwrocOperacje() {
		if (empty($this->_operacje)) {
			$this->operacje();
		}
		return $this->_operacje;
	}

	public function saldo() {
		if (empty($this->_saldo)) {
			$this->obliczSaldo();
		}
		return $this->_saldo;
	}
 

	private function operacje() {
		$sql = "SELECT * FROM operacje LEFT JOIN kasjer on (operacje.kasjer = kasjer.id)";
 		$this->_operacje =  $this->_db->zapytanieAssoc($sql);
	}

	private function kiedyKoniec() {

		if (empty($this->_operacje)) {
			$this->operacje();
		}

		$data_zakupu = '';
		$koszt_zakupu = 0;

		for ($i=0; $i < count($this->_operacje); $i++) {
			if ($this->_operacje[$i]->rodz == '+') {
				$data_zakupu = $this->_operacje[$i]->data;
				$koszt_zakupu = $this->_operacje[$i]->koszt;
			}
		}

		


	}

	private function obliczSaldo() {
		if (empty($this->_operacje)) {
			$this->operacje();
		}
		$sum = 0;
		for ($i=0; $i < count($this->_operacje); $i++) { 
			if ($this->_operacje[$i]->rodz == '-') {
				$sum -= $this->_operacje[$i]->koszt;
			} else {
				$sum += $this->_operacje[$i]->koszt;
			}
		}
		$this->_saldo = $sum;
	}

}