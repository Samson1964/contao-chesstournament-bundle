<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   chesstable
 * Version    1.0.0
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2013
 */
namespace Schachbulle\ContaoChesstournamentBundle\ContentElements;

class Chesstournament extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_chesstournament';

	/**
	 * Generate the module
	 */
	protected function compile()
	{

		switch($this->chesstournament_mode)
		{
			case 'subscriber': // Teilnehmerliste
				$this->strTemplate = 'ce_chesstournament_players';
				$objResult = \Database::getInstance()->prepare('SELECT * FROM tl_chesstournament_players WHERE pid = ? ORDER BY sorting ASC')
				                                     ->execute($this->chesstournament);
				$daten = array();
				if($objResult->numRows)
				{
					$nummer = 0;
					// Datensätze verarbeiten
					while($objResult->next())
					{
						$nummer++;
						$daten[] = array
						(
							'nummer' => $nummer,
							'name'   => $objResult->ftitel ? $objResult->ftitel.' '.$objResult->prename.' '.$objResult->surname : $objResult->prename.' '.$objResult->surname,
							'titel'  => $objResult->ftitel,
							'land'   => $objResult->country,
							'verein' => $objResult->club,
							'nwz'    => $objResult->nwz,
							'elo'    => $objResult->elo,
							'bild'   => $objResult->singleSRC
						);
					}
				}
				$content = 'Teilnehmer';
				break;
			case 'cross'     : // Kreuztabelle
				break;
			case 'progress'  : // Fortschrittstabelle
				break;
			case 'pairings'  : // Paarungen (alle Runden)
				break;
			case 'results'   : // Ergebnisse (alle Runden)
				break;
			case 'round'     : // Ergebnisse (eine Runde)
				break;
			default:
		}

		// Template ausgeben
		$this->Template = new \FrontendTemplate($this->strTemplate);
		$this->Template->class = "ce_chesstournament";
		$this->Template->view_nwz = $this->chesstournament_view_nwz;
		$this->Template->view_elo = $this->chesstournament_view_elo;
		$this->Template->view_verein = $this->chesstournament_view_club;
		$this->Template->view_land = $this->chesstournament_view_country;
		$this->Template->tabelle = $daten;

		return;

	}

}
