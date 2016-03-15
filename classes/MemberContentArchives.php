<?php

namespace HeimrichHannot\MemberContentArchives;

use HeimrichHannot\Haste\Dca\General;
use HeimrichHannot\Haste\Util\Url;

class MemberContentArchives {

	public static function getLabel($arrRow)
	{
		if ($objTag = \HeimrichHannot\MemberContentArchives\MemberContentArchiveTagModel::findByPk($arrRow['tag']))
			$strText = $objTag->title;
		else
			$strText = '';

		return $strText;
	}

	public function addInsertTags($strTag)
	{
		$arrParams = preg_split('/::/', $strTag);

		if (is_array($arrParams) && !empty($arrParams))
		{
			switch ($arrParams[0]) {
				case 'member_content_url':
					if (count($arrParams) >= 3)
						return static::getMemberContentLinkByMemberAndTag($arrParams[1], $arrParams[2]);
					else
						return static::getMemberContentLink($arrParams[1]);
					break;
			}
		}

		return false;
	}

	public static function getMemberContentLink($intId)
	{
		if (($objMemberContentArchive = MemberContentArchiveModel::findByPk($intId)) !== null)
		{
			if (($objTag = MemberContentArchiveTagModel::findByPk($objMemberContentArchive->tag)) !== null &&
					$objTag->jumpTo)
			{
				if (($objMember = \MemberModel::findByPk($objMemberContentArchive->mid)) !== null)
				{
					return Url::generateFrontendUrl($objTag->jumpTo) . '/' . General::getAliasIfAvailable($objMember);
				}
			}
		}
	}

	public static function getMemberContentLinkByMemberAndTag($intMember, $intTag)
	{
		if (($objMemberContentArchive = MemberContentArchiveModel::findBy(array('mid=?', 'tag=?'), array($intMember, $intTag))) !== null)
		{
			return static::getMemberContentLink($objMemberContentArchive->id);
		}
	}

}