<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//delayed function must return a string
__IncludeLang(dirname(__FILE__) . '/lang/' . LANGUAGE_ID . '/' . basename(__FILE__));
$curPage = $GLOBALS['APPLICATION']->GetCurPage($get_index_page = false);
if ($curPage != SITE_DIR) {
    if (empty($arResult) || $curPage != $arResult[count($arResult) - 1]['LINK'])
        $arResult[] = array('TITLE' => htmlspecialcharsback($GLOBALS['APPLICATION']->GetTitle(false, true)), 'LINK' => $curPage);
}
if (empty($arResult))
    return "";
$strReturn = '<div class="header__inner"><div class="container"><nav><ul class="header__inner-breadcrumbs-list"><li><a title="' . GetMessage('BREADCRUMB_MAIN') . '" href="' . SITE_DIR . '">Главная</a></li>';
for ($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++) {
$strReturn .= ' &nbsp/&nbsp ';

    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    if ($arResult[$index]["LINK"] <> "" && $index < (count($arResult) - 1))
        $strReturn .= '<li><a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '">' . $title . '</a></li>';
    else
        $strReturn .= '<li><a href="' . $arResult[$index]["LINK"] . '" title="' . $title . '">' . $title . '</a>';
}
$strReturn .= '</nav></div></div></ul>';
return $strReturn;
?>