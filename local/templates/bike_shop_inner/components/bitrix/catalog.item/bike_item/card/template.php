<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>

<div class="slider__item">
    <div class="slider__item-wrp">
        <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $productTitle ?>">
        <div class="slider__item-content-wrp">
            <h3><a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $productTitle ?></a></h3>
            <p><?= $price['PRINT_RATIO_BASE_PRICE'] ?>&nbsp;р</p>
            <p>Артикул:&nbsp;<? echo $item['DISPLAY_PROPERTIES']['ARTICLE']['DISPLAY_VALUE']; ?></p>
        </div>
    </div>
</div>
