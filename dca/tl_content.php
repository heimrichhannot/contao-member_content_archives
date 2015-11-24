<?php

// Dynamically add the parent table
if (\Input::get('do') == 'member_content_archives') {
	$GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_member_content_archive';
	$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'] = array('id', 'dateAdded', 'tstamp', 'mid');
}
