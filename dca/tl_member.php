<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_member'];

/**
 * Palettes
 */
$arrDca['palettes']['default'] = str_replace('lastname,', 'lastname,alias,', $arrDca['palettes']['default']);

/**
 * Fields
 */
$arrDca['fields']['alias'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_member']['alias'],
	'exclude'   => true,
	'search'    => true,
	'inputType' => 'text',
	'eval'      => array('rgxp' => 'alias', 'unique' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
	'save_callback' => array
	(
		array('tl_member_member_content_archives', 'generateAlias')
	),
	'sql' => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
);

class tl_member_member_content_archives extends \Backend {

	public function generateAlias($varValue, DataContainer $dc)
	{
		return \HeimrichHannot\Haste\Dca\General::generateAlias($varValue, $dc->id, 'tl_member', $dc->activeRecord->firstname . ' ' . $dc->activeRecord->lastname);
	}
}