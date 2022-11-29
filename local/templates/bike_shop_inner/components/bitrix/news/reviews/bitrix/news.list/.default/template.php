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
<section class="review">
    <div class="container">
        <h2>Отзывы</h2>
        <div class="review__wrp">
            <ul class="review__list">
                <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
                    <?= $arResult["NAV_STRING"] ?><br/>
                <? endif; ?>
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="review__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

                    <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><h3><? echo $arItem["NAME"] ?></h3></a>
                    <p><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                    <span><?=$arItem["PROPERTIES"]['AUTHOR']['VALUE']?></span>
                    <time><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></time>
                </li>
                    <?endforeach;?>
                </ul>

        </div>
    </div>





