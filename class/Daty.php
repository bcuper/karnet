<?php

class Daty {
	
	public static function DzienTygodnia($data) {
		$data = strtotime($data);
		$dzien = date("N", $data);
		return self::nazwyDni($dzien);
	}
	
	private function nazwyDni($liczba) {
		switch ($liczba) {
			case 1: return "Poniedziałek"; break;
			case 2: return "Wtorek"; break;
			case 3: return "Środa"; break;
			case 4: return "Czwartek"; break;
			case 5: return "Piątek"; break;
			case 6: return "Sobota"; break;
			case 7: return "Niedziela"; break;	
		}
	}
}
