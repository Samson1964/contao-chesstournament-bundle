<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   bdf
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2014
 */

$GLOBALS['BE_MOD']['content']['chesscompetition'] = array
(
	'tables'         => array('tl_chesstournament', 'tl_chesstournament_players', 'tl_chesstournament_results'),
	'icon'           => 'bundles/contaochesstournament/images/icon.png',
	'pairs_generate' => array('Schachbulle\ContaoChesstournamentBundle\Classes\Chesstournament', 'generatePairs'),
);

/**
 * -------------------------------------------------------------------------
 * CONTENT ELEMENTS
 * -------------------------------------------------------------------------
 */
$GLOBALS['TL_CTE']['schach']['chesstournament'] = 'Schachbulle\ContaoChesstournamentBundle\ContentElements\Chesstournament';

/**
 * -------------------------------------------------------------------------
 * HOOKS
 * -------------------------------------------------------------------------
 */
