<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   fen
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2013
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['chesstournament'] = '{type_legend},type,headline;{chess_legend},chesstournament,chesstournament_mode,chesstournament_round;{chesstournament_legend},chesstournament_view_club,chesstournament_view_nwz,chesstournament_view_elo,chesstournament_view_country;{protected_legend:hide},protected;{expert_legend:hide},guest,cssID,space;{invisible_legend:hide},invisible,start,stop';

/**
 * Fields
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstournament'] = array
(
	'label'                            => &$GLOBALS['TL_LANG']['tl_content']['chesstournament'],
	'exclude'                          => true,
	'inputType'                        => 'select',
	'options_callback'                 => array('tl_content_chesstournament', 'getChesstournament'),
	//'onsubmit_callback'                => array(array('tl_content_chesstournament', 'getRoundSelect')),
	'eval'                             => array
	(
		'tl_class'                     => 'long', 
		'submitOnChange'               => true, 
		'chosen'                       => true
	),
	'sql'                              => "int(10) unsigned NOT NULL default '0'"
); 

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstournament_mode'] = array
(
	'label'                            => &$GLOBALS['TL_LANG']['tl_content']['chesstournament_mode'],
	'exclude'                          => true,
	'inputType'                        => 'select',
	'default'                          => 'subscriber',
	'options'                          => array
	(
		'subscriber'                   => 'Teilnehmerliste',
		'cross'                        => 'Kreuztabelle', 
		'progress'                     => 'Fortschrittstabelle',
		'pairings'                     => 'Paarungen (alle Runden)',
		'results'                      => 'Ergebnisse (alle Runden)',
		'round'                        => 'Ergebnisse (eine Runde)'
	),
	'eval'                             => array
	(
		'tl_class'                     => 'w50', 
		'submitOnChange'               => true, 
		'chosen'                       => true
	),
	'sql'                              => "varchar(10) NOT NULL default ''"
); 

$GLOBALS['TL_DCA']['tl_content']['fields']['chesstournament_round'] = array
(
	'label'                            => &$GLOBALS['TL_LANG']['tl_content']['chesstournament_round'],
	'exclude'                          => true,
	'inputType'                        => 'select',
	'default'                          => 0,
	'options_callback'                 => array('tl_content_chesstournament', 'getRoundSelect'),
	'eval'                             => array
	(
		'tl_class'                     => 'w50', 
		'chosen'                       => true
	),
	'sql'                              => "int(2) unsigned NOT NULL default '0'"
); 
$GLOBALS['TL_DCA']['tl_content']['fields']['chesstournament_view_nwz'] = array
(
	'label'                            => &$GLOBALS['TL_LANG']['tl_content']['chesstournament_view_nwz'],
	'exclude'                          => true,
	'default'                          => 1,
	'inputType'                        => 'checkbox',
	'sql'                              => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['chesstournament_view_elo'] = array
(
	'label'                            => &$GLOBALS['TL_LANG']['tl_content']['chesstournament_view_elo'],
	'exclude'                          => true,
	'default'                          => 1,
	'inputType'                        => 'checkbox',
	'sql'                              => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['chesstournament_view_club'] = array
(
	'label'                            => &$GLOBALS['TL_LANG']['tl_content']['chesstournament_view_club'],
	'exclude'                          => true,
	'default'                          => 1,
	'inputType'                        => 'checkbox',
	'sql'                              => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['chesstournament_view_country'] = array
(
	'label'                            => &$GLOBALS['TL_LANG']['tl_content']['chesstournament_view_country'],
	'exclude'                          => true,
	'default'                          => 1,
	'inputType'                        => 'checkbox',
	'sql'                              => "char(1) NOT NULL default ''"
);

class tl_content_chesstournament extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function getChesstournament(DataContainer $dc)
	{
		$array = array();
		$objTurniere = $this->Database->prepare("SELECT id, title FROM tl_chesstournament ORDER BY stop DESC, start DESC")->execute();
		while($objTurniere->next())
		{
			$array[$objTurniere->id] =  $objTurniere->title;
		}
		return $array;

	}

	public function getRoundSelect(DataContainer $dc)
	{
		if($dc->activeRecord)
		{ 
			switch($dc->activeRecord->chesstournament)
			{
				case '1':
					return array(0, 1, 2, 3, 4);
					break;
				case '2':
					return array(0, 5, 6, 7, 8);
					break;
				case '3':
					return array(0, 9, 10, 11, 12);
					break;
				default:
					return array(0, 10, 11, 12);
				
			}
			
			//echo "<pre>";
			//print_r($GLOBALS['TL_DCA'][$dc->table]['fields']['newslinklist_start']); 
			//echo "</pre>";
			// Start- und Stopwert global speichern
			//if($varValue) 
			//	$varValue = strtotime("today", $varValue) + (3600 * 24) - 1;
			//else
			//	$varValue = strtotime("today", time()) + (3600 * 24) - 1;
            //
			//$GLOBALS['NEWSLINKLIST']['stop'] = $varValue;
			//$GLOBALS['NEWSLINKLIST']['start'] = strtotime("today", $varValue - (3600 * 24 * 30 * $GLOBALS['TL_CONFIG']['newslinklist_span']));
            //
			//$bis = date($GLOBALS['TL_CONFIG']['dateFormat'], $varValue);
			//$von = date($GLOBALS['TL_CONFIG']['dateFormat'], $GLOBALS['NEWSLINKLIST']['start']);
            //
			//$GLOBALS['TL_DCA'][$dc->table]['fields']['newslinklist_stopdate']['label'][0] = "Bis Nachrichtendatum (Von: $von)";
			//$GLOBALS['TL_DCA'][$dc->table]['fields']['newslinklist_stopdate']['label'][1] = "Nur Nachrichten vom $von bis $bis werden angezeigt!";
		}
		//print_r($dc->activeRecord->type);
		//return $varValue;
		return;
	}

}
