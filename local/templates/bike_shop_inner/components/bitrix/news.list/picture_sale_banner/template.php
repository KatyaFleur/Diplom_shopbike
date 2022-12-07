<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<?if(count($arResult["ITEMS"]) > 0) {?>
<div class="header__catalog-offer">
    <div class="container">
        <div class="header__catalog-offer-wrp">
            <h2>скидка 5%</h2>
            <div class="header__catalog-offer-img">
    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
        /></a>
            </div>
        </div>
    </div>
</div>
<?}?>


<?endforeach;?>


