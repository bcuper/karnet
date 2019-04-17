<?php

class DB {
	public static $instance = null;

	private $_db = null;
	private $_count = 0;

	private function __construct() {
		$this->_db = new mysqli('localhost', 'root', '', 'karnet');
		$this->_db->set_charset("utf8");
		if ($this->_db->connect_errno) {
			echo '<div class="alert alert-danger">Błąd połączenia z bazą danych: ' . $this->_db->connect_error . "</div>";
		}
	}

	public static function conn() {
		if (self::$instance == null) {

			self::$instance = new DB();
		}

		return self::$instance;
	}

	public function zapytanie($sql) {
		$res = $this->_db->query($sql);
		if ($res){
			$this->_count = $res->num_rows;
			return $res;
		} else {
			echo '<div class="alert alert-danger">Błąd: '. $this->_db->error . '</hdiv>';
		}
	}

	public function zapytanieAssoc($sql) {
		$wyn = array();
		$res = $this->zapytanie($sql);
		while ($row = $res->fetch_object()) {
			$wyn[] = $row;
		}

		return $wyn;
	}


	public function zapytanieWiersz($sql) {
		$res = $this->zapytanieAssoc($sql);
		if($res)
			return $res[0];
	}

	public function count() {
		return $this->_count;
	}

}