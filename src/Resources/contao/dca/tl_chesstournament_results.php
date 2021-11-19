<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Table tl_chesstournament_results
 */
$GLOBALS['TL_DCA']['tl_chesstournament_results'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_chesstournament',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('round', 'board'),
			'headerFields'            => array('title'),
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_callback'   => array('tl_chesstournament_results', 'listResults'), 
		),
		'global_operations' => array
		(
			'players' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['players'],
				'href'                => 'table=tl_chesstournament_players',
				'icon'                => 'system/modules/chesstournament/assets/images/player.png',
			), 
			'pairs_generate' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['pairs_generate'],
				'href'                => 'key=pairs_generate',
				'icon'                => 'system/modules/chesstournament/assets/images/pairs.png',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_chesstournament_results']['pairs_generate_confirm'] . '\'))return false"',
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},round,board,date,time,white,black;{result_legend},result;{pgn_legend},pgn;{more_legend},comment'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_chesstournament.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'round' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['round'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50', 'mandatory'=>true, 'maxlength'=>5),
			'sql'                     => "smallint(5) unsigned NOT NULL default '0'"
		), 
		'board' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['board'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50', 'maxlength'=>5),
			'sql'                     => "smallint(5) unsigned NOT NULL default '0'"
		), 
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['date'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'date', 
				'datepicker'          => true, 
				'tl_class'            => 'w50 wizard'
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'time' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['time'],
			'default'                 => time(),
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'time', 
				'tl_class'            => 'w50'
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		), 
		'white' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['white'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_chesstournament_results', 'getPlayer'),
			'eval'                    => array
			(
				'mandatory'           => true,
				'chosen'              => true,
				'submitOnChange'      => false,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'black' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['black'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_chesstournament_results', 'getPlayer'),
			'eval'                    => array
			(
				'mandatory'           => true,
				'chosen'              => true,
				'submitOnChange'      => false,
				'tl_class'            => 'w50'
			),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'result' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['result'],
			'exclude'                 => true,
			'default'                 => '',
			'inputType'               => 'select',
			'options'                 => array('', '1:0', '0:1', '½:½', '+:-', '=:=', '-:+', '0:0', 'H:H', '½:0', '½:1', '0:½', '1:½'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['result_list'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(3) NOT NULL default ''"
		), 
		'pgn' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['pgn'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('allowHtml'=>false, 'class'=>'monospace', 'rte'=>'ace|html'),
			'sql'                     => "mediumtext NULL"
		), 
		'comment' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_results']['comment'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('allowHtml'=>true, 'class'=>'monospace', 'rte'=>'ace|html', 'helpwizard'=>true),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		), 
	)
);


/**
 * Class tl_chesstournament_results
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_chesstournament_results extends Backend
{

	var $player = array();
	var $player_nr = array();
	var $nummer = 0;
	
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');

		// Spielerliste des Turniers einlesen
		$objPlayer = $this->Database->prepare("SELECT id, surname, prename FROM tl_chesstournament_players WHERE pid=? ORDER BY sorting")->execute($_GET['id']);
		while ($objPlayer->next())
		{
			$this->nummer++;
			$this->player[$this->nummer]['id'] = $objPlayer->id;
			$this->player[$this->nummer]['name'] = '['.$this->nummer.'] '.$objPlayer->surname .', '.$objPlayer->prename;
			$this->player_nr[$objPlayer->id] = $this->nummer;
		}

	}

	/**
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function listResults($arrRow)
	{
		$this->nummer++;
		$temp = '<div class="tl_content_left">';

		$temp .= $this->player[$this->player_nr[$arrRow['white']]]['name'];

		if($arrRow['result']) $temp .= ' <b>'.$arrRow['result'].'</b> ';
		else $temp .= ' - ';

		$temp .= $this->player[$this->player_nr[$arrRow['black']]]['name'];

		if($arrRow['pgn'] && $arrRow['result']) $temp .= ' (<span style="color:#008000">PGN</span>)';
		elseif(!$arrRow['pgn'] && $arrRow['result']) $temp .= ' (<span style="color:#FF0000">PGN</span>)';

		return $temp.'</div>';
	}

	public function getPlayer(DataContainer $dc)
	{

		$arrForms = array();
		$objForms = $this->Database->prepare("SELECT id, surname, prename FROM tl_chesstournament_players WHERE pid=? ORDER BY surname")->execute($dc->activeRecord->pid);

		while ($objForms->next())
		{
			$arrForms[$objForms->id] = $objForms->surname .', '.$objForms->prename. ' (ID ' . $objForms->id . ')';
		}

		return $arrForms;
	}
 
}
