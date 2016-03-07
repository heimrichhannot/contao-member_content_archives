<?php

/**
* Backend modules
*/
\HeimrichHannot\HastePlus\Arrays::insertInArrayByName($GLOBALS['BE_MOD']['accounts'], 'mgroup', array(
		'member_content_archives' => array(
			'tables' => array('tl_member_content_archive'),
			'icon'   => 'http://fs.local/system/themes/flexible/images/article.gif'
		),
		'member_content_archive_tags' => array(
			'tables' => array('tl_member_content_archive_tag')
		)
), 1);

$GLOBALS['BE_MOD']['accounts']['member_content_archives']['tables'][] = 'tl_content';

/**
 * Assets
 */
if (TL_MODE == 'BE') {
	$GLOBALS['TL_CSS'][] = '/system/modules/member_content_archives/assets/css/backend.css';
}

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_member_content_archive'] = '\HeimrichHannot\MemberContentArchives\MemberContentArchiveModel';
$GLOBALS['TL_MODELS']['tl_member_content_archive_tag'] = '\HeimrichHannot\MemberContentArchives\MemberContentArchiveTagModel';

/**
 * Default Config
 */
$GLOBALS['TL_CONFIG']['overridableMemberFields'] = 'a:0:{}';

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags']['addMemberContentArchivesInsertTags'] = array('HeimrichHannot\MemberContentArchives\MemberContentArchives', 'addInsertTags');