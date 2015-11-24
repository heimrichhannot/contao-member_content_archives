<?php

$GLOBALS['TL_DCA']['tl_member_content_archive'] = array
(
	'config'   => array
	(
		'dataContainer'     => 'Table',
		'enableVersioning'  => true,
		'onsubmit_callback' => array
		(
			'setDateAdded' => array('HeimrichHannot\\HastePlus\\Utilities', 'setDateAdded'),
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),
	'list'     => array
	(
		'label' => array(
			'fields' => array('title', 'id'),
			'label_callback' => array('tl_member_content_archive', 'listRecords')
		),
		'sorting'           => array
		(
			'mode'                  => 1,
			'fields'                => array('mid'),
			'headerFields'          => array('mid'),
			'panelLayout'           => 'filter;search,limit'
		),
		'global_operations' => array
		(
			'tags'    => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_member_content_archive']['tags'],
				'href'       => 'do=member_content_archive_tags',
				'class'      => 'header_tags',
				'icon'       => '/system/modules/member_content_archives/assets/img/icon_tags.png',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			),
			'all'    => array
			(
				'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'       => 'act=select',
				'class'      => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations'        => array
		(
			'edit'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_member_content_archive']['edit'],
				'href'  => 'table=tl_content',
				'icon'  => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_member_content_archive']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_member_content_archive']['copy'],
				'href'  => 'act=copy',
				'icon'  => 'copy.gif'
			),
			'delete' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_member_content_archive']['delete'],
				'href'       => 'act=delete',
				'icon'       => 'delete.gif',
				'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'           => &$GLOBALS['TL_LANG']['tl_member_content_archive']['toggle'],
				'icon'            => 'visible.gif',
				'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback' => array('tl_member_content_archive', 'toggleIcon')
			),
			'show'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_member_content_archive']['show'],
				'href'  => 'act=show',
				'icon'  => 'show.gif'
			),
		)
	),
	'palettes' => array(
		'__selector__' => array('type'),
		'default' => '{general_legend},type,title,mid;{publish_legend},published;',
		'tagged' => '{general_legend},type,tag,mid,teaser;{publish_legend},published;'
	),
	'fields'   => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'type' => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_member_content_archive']['type'],
			'default'   => 'default',
			'exclude'   => true,
			'inputType' => 'select',
			'options'   => array('default', 'tagged'),
			'reference' => &$GLOBALS['TL_LANG']['tl_member_content_archive']['type'],
			'eval'      => array('submitOnChange' => true, 'tl_class' => 'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'title' => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_member_content_archive']['title'],
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
		),
		'mid' => array
		(
			'label'           => &$GLOBALS['TL_LANG']['tl_member_content_archive']['mid'],
			'inputType'       => 'select',
			'options_callback' => array('tl_member_content_archive', 'getMembersAsOptions'),
			'eval'            => array('chosen' => true, 'mandatory' => true, 'tl_class' => 'w50'),
			'sql'             => "int(10) unsigned NOT NULL default '0'"
		),
		'teaser' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_member_content_archive']['teaser'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
		'tag' => array
		(
			'label'            => &$GLOBALS['TL_LANG']['tl_member_content_archive']['tag'],
			'inputType'        => 'select',
			'options_callback' => array('tl_member_content_archive', 'getAvailableContentArchiveTags'),
			'eval'             => array('mandatory' => true, 'chosen' => true, 'tl_class' => 'w50'),
			'sql'              => "varchar(255) NOT NULL default ''",
		),
		'dateAdded' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['dateAdded'],
			'eval'                    => array('rgxp'=>'datim', 'doNotCopy' => true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_member_content_archive']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50', 'doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default '0'"
		),
	)
);


class tl_member_content_archive extends \Backend
{

	public static function listRecords($arrRow)
	{
		return sprintf('<div class="tl_content_left">%s</div>',
				\HeimrichHannot\MemberContentArchives\MemberContentArchives::getLabel($arrRow));
	}

	public static function getMembersAsOptions()
	{
		$arrOptions = array();

		if (($objMembers = \MemberModel::findAll()) !== null)
		{
			while ($objMembers->next())
			{
				$strName = $objMembers->firstname .  ' ' . $objMembers->lastname;
				$strEmail = ($objMembers->email ? $objMembers->email . ', ' : '');

				$arrOptions[$objMembers->id] = trim($strName) ?
						$strName .  ' (' . $strEmail . 'ID ' . $objMembers->id . ')' :
						$strEmail . 'ID ' . $objMembers->id;
			}
		}

		asort($arrOptions);

		return $arrOptions;
	}

	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		$objUser = \BackendUser::getInstance();

		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1));
			\Controller::redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$objUser->isAdmin && !$objUser->hasAccess('tl_member_content_archive::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
	}

	public function toggleVisibility($intId, $blnVisible)
	{
		$objUser = \BackendUser::getInstance();
		$objDatabase = \Database::getInstance();

		// Check permissions to publish
		if (!$objUser->isAdmin && !$objUser->hasAccess('tl_member_content_archive::published', 'alexf'))
		{
			\Controller::log('Not enough permissions to publish/unpublish item ID "'.$intId.'"', 'tl_member_content_archive toggleVisibility', TL_ERROR);
			\Controller::redirect('contao/main.php?act=error');
		}

		$objVersions = new Versions('tl_member_content_archive', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_member_content_archive']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_member_content_archive']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$objDatabase->prepare("UPDATE tl_member_content_archive SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
			->execute($intId);

		$objVersions->create();
		\Controller::log('A new version of record "tl_member_content_archive.id='.$intId.'" has been created'.$this->getParentEntries('tl_member_content_archive', $intId), 'tl_member_content_archive toggleVisibility()', TL_GENERAL);
	}

	public static function getAvailableContentArchiveTags($objDc)
	{
		$arrOption = array();
		if (($objTags  = \HeimrichHannot\MemberContentArchives\MemberContentArchiveTagModel::findAll()) !== null)
		{
			$arrResult = array_combine($objTags->fetchEach('id'), $objTags->fetchEach('title'));

			foreach ($arrResult as $intId => $strTag)
			{
				if (\HeimrichHannot\MemberContentArchives\MemberContentArchiveModel::findBy(
								array('mid=?', 'tag=?'), array($objDc->activeRecord->mid, $intId)) === null ||
						$intId == $objDc->activeRecord->tag
				)
					$arrOption[$intId] = $strTag;
			}
		}

		asort($arrOption);

		return $arrOption;
	}

}
