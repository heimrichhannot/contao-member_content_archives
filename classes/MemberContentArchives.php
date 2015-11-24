<?php

namespace HeimrichHannot\MemberContentArchives;

class MemberContentArchives {

	public static function getLabel($arrRow)
	{
		switch ($arrRow['type'])
		{
			case 'tagged';
				if ($objTag = \HeimrichHannot\MemberContentArchives\MemberContentArchiveTagModel::findByPk($arrRow['tag']))
					$strText = $objTag->title;
				else
					$strText = '';

				break;
			default:
				$strText = $arrRow['title'];
				break;
		}

		return $strText;
	}

}