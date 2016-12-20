<?php

namespace HeimrichHannot\MemberContentArchives;

class MemberContentArchiveModel extends \Model
{
    protected static $strTable = 'tl_member_content_archive';

    public static function findPublishedByMid($intMid, array $arrOptions = array())
    {
        $t = static::$strTable;

        $arrColumns = array("$t.mid=?");
        $arrValues  = array($intMid);

        if (!BE_USER_LOGGED_IN)
        {
            $arrColumns[] = "$t.published=?";
            $arrValues[]  = 1;
        }

        return static::findBy($arrColumns, $arrValues, $arrOptions);
    }
}