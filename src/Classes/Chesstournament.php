<?php

namespace Schachbulle\ContaoChesstournamentBundle\Classes;

class Chesstournament extends \Frontend
{
	
	var $nummer = 0;
	var $player = array();

	/***********************
	 * Generiert die Paarungen
	 */
	public function generatePairs(DataContainer $dc)
	{

		// Spielerliste des Turniers einlesen
		$objPlayer = $this->Database->prepare("SELECT id, surname, prename FROM tl_chesstournament_players WHERE pid=? ORDER BY sorting")->execute($dc->id);
		while ($objPlayer->next())
		{
			$this->nummer++;
			$player[$this->nummer]['id'] = $objPlayer->id;
			$player[$this->nummer]['name'] = $objPlayer->surname .', '.$objPlayer->prename;
		}

		// Alte Paarungen löschen
		$objPlayer = $this->Database->prepare("DELETE FROM tl_chesstournament_results WHERE pid=?")->execute($dc->id);
		
		// Paarungen generieren und speichern
		for($runde = 1; $runde < $this->nummer; $runde++)
		{
			$paarung = $this->Standardsystem($this->nummer, $runde);
			// Paarungen schreiben
			$brett = 0;
			foreach($paarung as $item)
			{
				$brett++;
				$objUpdate = $this->Database->prepare("INSERT INTO tl_chesstournament_results (pid, tstamp, round, board, white, black) VALUES (?, ?, ?, ?, ?, ?)")->execute($dc->id, time(), $runde, $brett, $player[$item['w']]['id'], $player[$item['s']]['id']);
			}
		}
		
		//return "Fertig!";
		
		// Cookie setzen und Ergebnisseite aufrufen
		System::setCookie('BE_PAGE_OFFSET', 0, 0);
		$request = Environment::get('request');
		// In Request Tabellenverweis austauschen
		$request = str_replace('&table=tl_chesstournament_players', '&table=tl_chesstournament_results', $request);
		// In Request generatePairs-Befehl entfernen
		$request = str_replace('&key=pairs_generate', '', $request);
		$this->redirect($request);
	}
	
	/***********************
	 * liefert die Paarungen nach Standardsystem
	 * @param dim: Spieleranzahl
	 * @param runde: aktuelle Runde
	 */
	protected function Standardsystem($dim, $runde)
	{
		// Spieleranzahl begradigen
		if($dim % 2 != 0)
		{
			$dim++;
			$spielfrei = $dim;
		}
		else $spielfrei = false;
		
		$gegner = range(1, $dim);
		if($runde % 2){
			$gegner[0] = $odd = ($runde+1)/2;
			$gegner[1] = $dim;
		}
		else{
			$gegner[0] = $dim;
			$gegner[1] = $odd = ($runde+$dim)/2;
		}
		for ($i=2; $i< $dim;){
			$gegner[$i++]= ($odd++)%($dim-1)+1;
			$gegner[$i++]= ($runde-$odd+$dim-1)%($dim-1)+1;
		}

		$i = 0;
		for($x = 0; $x < $dim-1; $x+=2)
		{
			if($spielfrei && ($gegner[$x] == $dim || $gegner[$x+1] == $dim))
			{
				// Spielfrei erwischt
			}
			else
			{
				$paarung[$i]['w'] = $gegner[$x];
				$paarung[$i]['s'] = $gegner[$x+1];
				$i++;
			}
		}
		
		return $paarung;
	}
	
}
