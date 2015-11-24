<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package Member_content_archives
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'HeimrichHannot',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'HeimrichHannot\MemberContentArchives\MemberContentArchives'        => 'system/modules/member_content_archives/classes/MemberContentArchives.php',

	// Models
	'HeimrichHannot\MemberContentArchives\MemberContentArchiveTagModel' => 'system/modules/member_content_archives/models/MemberContentArchiveTagModel.php',
	'HeimrichHannot\MemberContentArchives\MemberContentArchiveModel'    => 'system/modules/member_content_archives/models/MemberContentArchiveModel.php',
));
