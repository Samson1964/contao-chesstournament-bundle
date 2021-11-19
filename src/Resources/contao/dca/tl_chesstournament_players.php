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
 * Table tl_chesstournament_players
 */
$GLOBALS['TL_DCA']['tl_chesstournament_players'] = array
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
			'fields'                  => array('sorting'),
			'headerFields'            => array('title', 'start', 'stop'),
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_callback'   => array('tl_chesstournament_players', 'listPlayers'), 
		),
		'global_operations' => array
		(
			'results' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['results'],
				'href'                => 'table=tl_chesstournament_results',
				'icon'                => 'system/modules/chesstournament/assets/images/result.png',
			), 
			'pairs_generate' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['pairs_generate'],
				'href'                => 'key=pairs_generate',
				'icon'                => 'system/modules/chesstournament/assets/images/pairs.png',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_chesstournament_players']['pairs_generate_confirm'] . '\'))return false"',
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
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{name_legend},surname,prename,title,country;{club_legend},club;{rating_legend},nwz,elo,ftitel;{more_legend},singleSRC'
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
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		), 
		'surname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['surname'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'prename' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['prename'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['title'],
			'exclude'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>10, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'country' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['country'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options'                 => System::getCountries(),
			'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(2) NOT NULL default ''"
		), 
		'club' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['club'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'nwz' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['nwz'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50', 'maxlength'=>5),
			'sql'                     => "smallint(5) unsigned NOT NULL default '0'"
		), 
		'elo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['elo'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50 clr', 'maxlength'=>5),
			'sql'                     => "smallint(5) unsigned NOT NULL default '0'"
		), 
		'ftitel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['ftitel'],
			'exclude'                 => true,
			'default'                 => '',
			'inputType'               => 'select',
			'options'                 => array('-', 'GM', 'IM', 'WGM', 'FM', 'WIM', 'CM', 'WFM', 'WCM'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['ftitel_list'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(3) NOT NULL default ''"
		), 
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_chesstournament_players']['singleSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr'),
			'sql'                     => "binary(16) NULL",
		), 
	)
);


/**
 * Class tl_chesstournament_players
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_chesstournament_players extends Backend
{

	var $nummer = 0;
	
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function listPlayers($arrRow)
	{
		$this->nummer++;
		
		$temp = '<div class="tl_content_left">['.$this->nummer.'] '.$arrRow['surname'];
		if($arrRow['prename']) $temp .= ','.$arrRow['prename'];
		if($arrRow['title']) $temp .= ','.$arrRow['title'];
		if($arrRow['club']) $temp .= ' <i>('.$arrRow['club'].')</i>';
		if($arrRow['singleSRC']) $temp .= ' '.Image::getHtml('system/modules/chesstournament/assets/images/image-yes.png','');
		else $temp .= ' '.Image::getHtml('system/modules/chesstournament/assets/images/image-no.png','');
		return $temp.'</div>';
	}
 
}
