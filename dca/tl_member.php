<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_member'];

\HeimrichHannot\Haste\Dca\General::addAliasToDca('tl_member',
		array('tl_member_member_content_archives', 'generateAlias'), 'lastname');

\HeimrichHannot\Haste\Dca\General::addAliasButton('tl_member');

class tl_member_member_content_archives extends \Backend {

	public function generateAlias($varValue, DataContainer $dc)
	{
		return \HeimrichHannot\Haste\Dca\General::generateAlias($varValue, $dc->id, 'tl_member', $dc->activeRecord->firstname . ' ' . $dc->activeRecord->lastname);
	}
}