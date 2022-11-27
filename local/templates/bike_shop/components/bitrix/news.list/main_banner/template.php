<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<? foreach ($arResult['ITEMS'] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="header__wrp-first-screen">
        <div class="header__desc">

            <h2> <? echo $arItem['NAME'] ?></h2>
            <p><? echo $arItem['PREVIEW_TEXT']; ?></p>
            <a href="<? echo $arItem['DISPLAY_PROPERTIES']['BANNER_LINK']['DISPLAY_VALUE'] ?>">магазин</a>
        </div>
    </div>
    <div class="header__second-screen">
        <picture>
            <? $mobPict = CFile::GetPath($arItem["PROPERTIES"]["MOBILE_PICT"]["VALUE"]); ?>
            <source srcset="<? echo $mobPict ?>" media="(max-width: 1400px)">
            <source srcset="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>">
            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<? echo $arItem["NAME"] ?>"/>
        </picture>
    </div>
<? endforeach; ?>

