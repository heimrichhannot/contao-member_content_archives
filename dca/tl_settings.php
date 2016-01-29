<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_settings'];

/**
 * Palettes
 */
$arrDca['palettes']['default'] .= ';{member_content_archives_legend},overridableMemberFields';

/**
 * Fields
 */
$arrDca['fields']['overridableMemberFields'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['overridableMemberFields'],
	'exclude'                 => true,
	'inputType'               => 'checkboxWizard',
	'options_callback' => array('tl_settings_member_content_archives', 'getMemberFieldsAsOptions'),
	'eval'                    => array('tl_class' => 'w50 clr', 'multiple' => true)
);

class tl_settings_member_content_archives {

	public static function getMemberFieldsAsOptions()
	{
		\System::loadLanguageFile('tl_member');
		\Controller::loadDataContainer('tl_member');

		$arrOptions = array();
		$arrDca = $GLOBALS['TL_DCA']['tl_member'];

		foreach (array_merge($arrDca['palettes']['__selector__'], array_keys($arrDca['fields'])) as $strField)
		{
			$arrLabel = $arrDca['fields'][$strField]['label'];

			if (is_array($arrLabel))
				$arrLabel = $arrLabel[0];

			$arrOptions[$strField] = $arrLabel ?: $strField;
		}

		asort($arrOptions);

		return array_unique($arrOptions);
	}

}