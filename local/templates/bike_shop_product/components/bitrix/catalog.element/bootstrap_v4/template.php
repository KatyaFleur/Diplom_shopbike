<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);

$haveOffers = !empty($arResult['OFFERS']);
$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'BLOCK_PRICE_OLD' => $mainId . '_block_price',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'SLIDER_PAGER_OF_ID' => $mainId . '_slider_pager_',
    'QUANTITY_COUNTER_ID' => $mainId . '_counter',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_MEASURE_CONTAINER' => $mainId . '_quant_measure_container',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $haveOffers && !empty($arResult['OFFERS_PROP']) ? $mainId . '_skudiv' : null,
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DESCRIPTION_ID' => $mainId . '_description',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

if ($haveOffers) {
    $actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}
$percent = '';
if (!empty($actualItem['MORE_PHOTO'])) {
    $firstPhoto = reset($actualItem['MORE_PHOTO']);
    $percent = ($firstPhoto['HEIGHT'] / $firstPhoto['WIDTH']) * 100;
    $percent = ($percent > 160) ? 160 : $percent;
    $percent = 'padding-top: ' . $percent . '%;';
    unset($firstPhoto);
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
    $skuDescription = false;
    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
            $skuDescription = true;
            break;
        }
    }
    $showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
    $showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-' . $arParams['TEMPLATE_THEME'] : '';
?>

    <section class="product-card">
        <div class="container" id="<?= $itemIds['ID'] ?>" itemscope itemtype="http://schema.org/Product">
            <?php
            if ($arParams['DISPLAY_NAME'] === 'Y') {
                ?>
                <h1><?= $name ?></h1>
                <?php
            }
            ?>
            <div class="product-card__info-wrp">
                <div class="product-card__img-wrp" id="<?= $itemIds['BIG_SLIDER_ID'] ?>">

                    <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>">
                </div>
                <div class="product-detail-slider-images-container" data-entity="images-container">
                    <?php
                    if (!empty($actualItem['MORE_PHOTO'])) {
                        foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                            $xResizedImage = \CFile::ResizeImageGet(
                                $photo['ID'],
                                [
                                    'width' => 100,
                                    'height' => 100,
                                ],
                                BX_RESIZE_IMAGE_PROPORTIONAL,
                                true
                            );

                            $x2ResizedImage = \CFile::ResizeImageGet(
                                $photo['ID'],
                                [
                                    'width' => 100,
                                    'height' => 100,
                                ],
                                BX_RESIZE_IMAGE_PROPORTIONAL,
                                true
                            );

                            if (!$xResizedImage || !$x2ResizedImage) {
                                $xResizedImage = [
                                    'src' => $photo['SRC'],
                                ];
                                $x2ResizedImage = $xResizedImage;
                            }

                            $xResizedImage = \Bitrix\Iblock\Component\Tools::getImageSrc([
                                'SRC' => $xResizedImage['src']
                            ]);
                            $x2ResizedImage = \Bitrix\Iblock\Component\Tools::getImageSrc([
                                'SRC' => $x2ResizedImage['src']
                            ]);

                            $style = "background-image: url('{$xResizedImage}');";
                            $style .= "background-image: -webkit-image-set(url('{$xResizedImage}') 1x, url('{$x2ResizedImage}') 2x);";
                            $style .= "background-image: image-set(url('{$xResizedImage}') 1x, url('{$x2ResizedImage}') 2x);";
                            ?>
                            <div class="product-detail-slider-image<?= ($key == 0 ? ' active' : '') ?>"
                                 data-entity="image" data-id="<?= $photo['ID'] ?>">
                                <img
                                        src="<?= $xResizedImage ?>"
                                        srcset="<?= $xResizedImage ?> 1x, <?= $x2ResizedImage ?> 2x"
                                        alt="<?= $alt ?>"
                                        title="<?= $title ?>"
                                >
                                <div class="product-detail-slider-image-overlay" style="<?= $style ?>"></div>
                            </div>
                            <?php
                        }
                    }

                    if ($arParams['SLIDER_PROGRESS'] === 'Y') {
                        ?>
                        <div class="product-detail-slider-progress-bar" data-entity="slider-progress-bar"
                             style="width: 0;">2
                        </div>
                        <?php
                    }
                    ?>
                </div>


                <?php
                //region SLIDER CONTROLS
                if ($showSliderControls) {
                    if ($haveOffers) {
                        foreach ($arResult['OFFERS'] as $keyOffer => $offer) {
                            if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
                                continue;

                            $strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
                            ?>
                            <div class="catalog-section-item-slider-images-slider-pager d-none d-sm-flex"
                                 id="<?= $itemIds['SLIDER_PAGER_OF_ID'] . $offer['ID'] ?>"
                                 style="display: <?= $strVisible ?>;">
                                <?php
                                foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo) {
                                    ?>
                                    <div class="catalog-section-item-slider-images-slider-pager-item"
                                         data-entity="slider-control"
                                         data-value="<?= $offer['ID'] . '_' . $photo['ID'] ?>">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="catalog-section-item-slider-images-slider-pager d-none d-sm-flex"
                             id="<?= $itemIds['SLIDER_CONT_ID'] ?>">
                            <?php
                            if (!empty($actualItem['MORE_PHOTO'])) {
                                foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                                    ?>
                                    <div class="catalog-section-item-slider-images-slider-pager-item"
                                         data-entity="slider-control" data-value="<?= $photo['ID'] ?>">
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                //endregion
                ?>



                <?php
                //endregion

                $showOffersBlock = $haveOffers && !empty($arResult['OFFERS_PROP']);
                $mainBlockProperties = array_intersect_key($arResult['DISPLAY_PROPERTIES'], $arParams['MAIN_BLOCK_PROPERTY_CODE']);
                $showPropsBlock = !empty($mainBlockProperties) || $arResult['SHOW_OFFERS_PROPS'];
                $showBlockWithOffersAndProps = $showOffersBlock || $showPropsBlock;

                ?>

                <?php


                //region SKU
                if ($showOffersBlock)
                {
                ?>
                <form class="product-card__form" action="">
                    <div class="product-card__form-wrp" id="<?= $itemIds['TREE_ID'] ?>">
                        <fieldset>
                            <?php
                            foreach ($arResult['SKU_PROPS'] as $skuProperty)
                            {
                            if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
                                continue;

                            $propertyId = $skuProperty['ID'];
                            $skuProps[] = array(
                                'ID' => $propertyId,
                                'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                                'VALUES' => $skuProperty['VALUES'],
                                'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                            );

                            ?>
                            <div data-entity="sku-line-block" class="product-card__form-title-wrp">
                                <legend> <?= htmlspecialcharsEx($skuProperty['NAME']) ?></legend>
                            </div>


                            <ul class="product-card__form-radio-wrp product-detail-scu-item-list">
                                <?php
                                foreach ($skuProperty['VALUES'] as &$value) {
                                    $value['NAME'] = htmlspecialcharsbx($value['NAME']);

                                    if ($skuProperty['SHOW_MODE'] === 'PICT') {
                                        ?>

                                        <li class="product-detail-scu-item-color-container"
                                            title="<?= $value['NAME'] ?>"
                                            data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                            data-onevalue="<?= $value['ID'] ?>">

                                            <input class="visually-hidden" type="radio" id="<?= $value['ID'] ?>"
                                                   name="<?= htmlspecialcharsEx($skuProperty['NAME']) ?>" value="<?= $value['NAME'] ?>">
                                            <label for="<?= $value['NAME'] ?>" >
                                                <?= $value['NAME'] ?>
                                            </label>

                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li class="product-detail-scu-item-text-container" title="<?= $value['NAME'] ?>"
                                            data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                            data-onevalue="<?= $value['ID'] ?>">


                                            <input class="visually-hidden" type="radio" id="<?= $value['ID'] ?>"
                                                   name="<?= htmlspecialcharsEx($skuProperty['NAME']) ?>" value="<?= $value['NAME'] ?>">
                                            <label for="<?= $value['NAME'] ?>">
                                                <?= $value['NAME'] ?>
                                            </label>

                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div style="clear: both;"></div>


                        </fieldset>

                        <?php
                        }
                        ?>


                        <?php
                        }
                        //endregion

                        ?>
                        <h3><?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:</h3>
                        <span data-entity="quantity-limit-value">
											<?php
                                            if ($arParams['SHOW_MAX_QUANTITY'] === 'M') {
                                                if ((float)$actualItem['PRODUCT']['QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR']) {
                                                    echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
                                                } else {
                                                    echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
                                                }
                                            } else {
                                                echo $actualItem['PRODUCT']['QUANTITY'] . ' ' . $actualItem['ITEM_MEASURE']['TITLE'];
                                            }
                                            ?>
										</span>

                        <p id="<?= $itemIds['PRICE_ID'] ?>"><?= $price['PRINT_RATIO_PRICE'] ?></p>

                    </div>

                    <?php //region BUTTONS?>
                    <div data-entity="main-button-container" id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>">

                        <?php
                        if ($showAddBtn) {
                            ?>
                            <button type="submit">
                                <a id="<?= $itemIds['ADD_BASKET_LINK'] ?>"
                                   href="javascript:void(0);">
                                    <?= $arParams['MESS_BTN_ADD_TO_BASKET'] ?>
                                </a>
                            </button>
                            <?php
                        }

                        if ($showBuyBtn) {
                            ?>
                            <button type="submit">
                                <a
                                        id="<?= $itemIds['BUY_LINK'] ?>"
                                        href="javascript:void(0);">
                                    <?= $arParams['MESS_BTN_BUY'] ?>
                                </a>
                            </button>
                            <?php
                        }
                        ?>


                </form>
            </div>
            </form>
        </div>
        </div>
    </section>
<?//start info?>
    <section class="information">
        <h2 class="visually-hidden">information</h2>
        <div class="container">
            <div class="information__wrp">
                <div class="information__images">
                    <? if (count($arResult["MORE_PHOTO"]) > 0): ?>

                        <? foreach ($arResult["MORE_PHOTO"] as $PHOTO): ?>
                            <img src="<?= $PHOTO["SRC"] ?>" alt="<?= $arResult["NAME"] ?>"
                                 title="<?= $arResult["NAME"] ?>">
                        <? endforeach ?>
                    <? endif ?>
                </div>
                <div class="information__text">
                    <div class="information__text-wrp">
                        <h3>Характеристики</h3>
                        <p><?= $arResult["PREVIEW_TEXT"] ?></p>
                    </div>
                    <div class="information__text-wrp">
                        <h3>Особенности</h3>
                        <ul>
                            <?php
                            //region PROPS
                            if ($showPropsBlock) {
                                ?><?php
                                if (!empty($mainBlockProperties)) {
                                    ?><?php
                                    foreach ($mainBlockProperties as $property) {
                                        ?>
                                        <li>
                                            <?= $property['NAME'] ?>:

                                            <?= (is_array($property['DISPLAY_VALUE'])
                                                ? implode(' / ', $property['DISPLAY_VALUE'])
                                                : $property['DISPLAY_VALUE']) ?>

                                        </li>
                                        <?php
                                    }
                                    ?><?php
                                }

                            } ?>
                        </ul>
                    </div>
                    <div class="information__text-wrp">
                        <h3>Информация о товаре</h3>
                        <div class="information__text-detailed-info-wrp">
                            <?= $arResult["DETAIL_TEXT"] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?//end info?>
<?//start review?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	".default", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "6",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "AUTHOR",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
<?//end review?>


    <!--Small Card-->
    <div class="p-2 product-item-detail-short-card-fixed d-none d-md-block" id="<?= $itemIds['SMALL_CARD_PANEL_ID'] ?>"
         style="display: none !important;">
        <div class="product-item-detail-short-card-content-container">
            <div class="product-item-detail-short-card-image">
                <img src="" style="height: 65px;" data-entity="panel-picture">
            </div>
            <div class="product-item-detail-short-title-container" data-entity="panel-title">
                <div class="product-item-detail-short-title-text"><?= $name ?></div>
                <?php
                if ($haveOffers) {
                    ?>
                    <div>
                        <div class="product-item-selected-scu-container" data-entity="panel-sku-container">
                            <?php
                            $i = 0;

                            foreach ($arResult['SKU_PROPS'] as $skuProperty) {
                                if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']])) {
                                    continue;
                                }

                                $propertyId = $skuProperty['ID'];

                                foreach ($skuProperty['VALUES'] as $value) {
                                    $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                                    if ($skuProperty['SHOW_MODE'] === 'PICT') {
                                        ?>
                                        <div class="product-item-selected-scu product-item-selected-scu-color selected"
                                             title="<?= $value['NAME'] ?>"
                                             style="background-image: url('<?= $value['PICT']['SRC'] ?>'); display: none;"
                                             data-sku-line="<?= $i ?>"
                                             data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                             data-onevalue="<?= $value['ID'] ?>">
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="product-item-selected-scu product-item-selected-scu-text selected"
                                             title="<?= $value['NAME'] ?>"
                                             style="display: none;"
                                             data-sku-line="<?= $i ?>"
                                             data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                             data-onevalue="<?= $value['ID'] ?>">
                                            <?= $value['NAME'] ?>
                                        </div>
                                        <?php
                                    }
                                }

                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
            <div class="product-item-detail-short-card-price">
                <?php
                if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
                    ?>
                    <div class="product-item-detail-price-old" style="display: <?= ($showDiscount ? '' : 'none') ?>;"
                         data-entity="panel-old-price">
                        <?= ($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '') ?>
                    </div>
                    <?php
                }
                ?>
                <div class="product-item-detail-price-current"
                     data-entity="panel-price"><?= $price['PRINT_RATIO_PRICE'] ?></div>
            </div>
            <?php
            if ($showAddBtn) {
                ?>
                <div class="product-item-detail-short-card-btn"
                     style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;"
                     data-entity="panel-add-button">
                    <a class="btn <?= $showButtonClassName ?> product-item-detail-buy-button"
                       id="<?= $itemIds['ADD_BASKET_LINK'] ?>"
                       href="javascript:void(0);">
                        <?= $arParams['MESS_BTN_ADD_TO_BASKET'] ?>
                    </a>
                </div>
                <?php
            }

            if ($showBuyBtn) {
                ?>
                <div class="product-item-detail-short-card-btn"
                     style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;"
                     data-entity="panel-buy-button">
                    <a class="btn <?= $buyButtonClassName ?> product-item-detail-buy-button"
                       id="<?= $itemIds['BUY_LINK'] ?>"
                       href="javascript:void(0);">
                        <?= $arParams['MESS_BTN_BUY'] ?>
                    </a>
                </div>
                <?php
            }
            ?>
            <div class="product-item-detail-short-card-btn"
                 style="display: <?= (!$actualItem['CAN_BUY'] ? '' : 'none') ?>;"
                 data-entity="panel-not-available-button">
                <a class="btn btn-link product-item-detail-buy-button" href="javascript:void(0)"
                   rel="nofollow">
                    <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                </a>
            </div>
        </div>
    </div>
    <!--Top tabs-->
    <div class="pt-2 pb-0 product-item-detail-tabs-container-fixed d-none d-md-block"
         id="<?= $itemIds['TABS_PANEL_ID'] ?>" style="display: none !important; ">
        <ul class="product-item-detail-tabs-list">
            <?php
            if ($showDescription) {
                ?>
                <li class="product-item-detail-tab active" data-entity="tab" data-value="description">
                    <a href="javascript:void(0);" class="product-item-detail-tab-link">
                        <span><?= $arParams['MESS_DESCRIPTION_TAB'] ?></span>
                    </a>
                </li>
                <?php
            }

            if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                ?>
                <li class="product-item-detail-tab" data-entity="tab" data-value="properties">
                    <a href="javascript:void(0);" class="product-item-detail-tab-link">
                        <span><?= $arParams['MESS_PROPERTIES_TAB'] ?></span>
                    </a>
                </li>
                <?php
            }

            if ($arParams['USE_COMMENTS'] === 'Y') {
                ?>
                <li class="product-item-detail-tab" data-entity="tab" data-value="comments">
                    <a href="javascript:void(0);" class="product-item-detail-tab-link">
                        <span><?= $arParams['MESS_COMMENTS_TAB'] ?></span>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
<?php
if ($haveOffers) {
    $offerIds = array();
    $offerCodes = array();

    $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

    foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
        $offerIds[] = (int)$jsOffer['ID'];
        $offerCodes[] = $jsOffer['CODE'];

        $fullOffer = $arResult['OFFERS'][$ind];
        $measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

        $strAllProps = '';
        $strMainProps = '';
        $strPriceRangesRatio = '';
        $strPriceRanges = '';

        if ($arResult['SHOW_OFFERS_PROPS']) {
            if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
                    $current = '<li class="product-item-detail-properties-item">
						<span class="product-item-detail-properties-name">' . $property['NAME'] . '</span>
						<span class="product-item-detail-properties-dots"></span>
						<span class="product-item-detail-properties-value">' . (
                        is_array($property['VALUE'])
                            ? implode(' / ', $property['VALUE'])
                            : $property['VALUE']
                        ) . '</span></li>';
                    $strAllProps .= $current;

                    if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
                        $strMainProps .= $current;
                    }
                }

                unset($current);
            }
        }

        if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
            $strPriceRangesRatio = '(' . Loc::getMessage(
                    'CT_BCE_CATALOG_RATIO_PRICE',
                    array('#RATIO#' => ($useRatio
                            ? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
                            : '1'
                        ) . ' ' . $measureName)
                ) . ')';

            foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
                if ($range['HASH'] !== 'ZERO-INF') {
                    $itemPrice = false;

                    foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
                        if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
                            break;
                        }
                    }

                    if ($itemPrice) {
                        $strPriceRanges .= '<dt>' . Loc::getMessage(
                                'CT_BCE_CATALOG_RANGE_FROM',
                                array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
                            ) . ' ';

                        if (is_infinite($range['SORT_TO'])) {
                            $strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                        } else {
                            $strPriceRanges .= Loc::getMessage(
                                'CT_BCE_CATALOG_RANGE_TO',
                                array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
                            );
                        }

                        $strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
                    }
                }
            }

            unset($range, $itemPrice);
        }

        $jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
        $jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
        $jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
        $jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;

        $jsOffer['RESIZED_SLIDER'] = [
            'X' => [],
            'X2' => [],
        ];
        foreach ($jsOffer['SLIDER'] as $morePhoto) {
            $xResizedImage = \CFile::ResizeImageGet(
                $morePhoto['ID'],
                [
                    'width' => 400,
                    'height' => 400,
                ],
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );

            $x2ResizedImage = \CFile::ResizeImageGet(
                $morePhoto['ID'],
                [
                    'width' => 800,
                    'height' => 800,
                ],
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );

            if (!$xResizedImage || !$x2ResizedImage) {
                $xResizedImage = [
                    'src' => $morePhoto['SRC'],
                    'width' => $morePhoto['WIDTH'],
                    'height' => $morePhoto['HEIGHT'],
                ];
                $x2ResizedImage = $xResizedImage;
            }

            $xResizedImage['src'] = \Bitrix\Iblock\Component\Tools::getImageSrc([
                'SRC' => $xResizedImage['src']
            ]);
            $x2ResizedImage['src'] = \Bitrix\Iblock\Component\Tools::getImageSrc([
                'SRC' => $x2ResizedImage['src']
            ]);

            $jsOffer['RESIZED_SLIDER']['X'][] = [
                'ID' => $morePhoto['ID'],
                'SRC' => $xResizedImage['src'],
                'WIDTH' => $xResizedImage['width'],
                'HEIGHT' => $xResizedImage['height'],
            ];
            $jsOffer['RESIZED_SLIDER']['X2'][] = [
                'ID' => $morePhoto['ID'],
                'SRC' => $x2ResizedImage['src'],
                'WIDTH' => $x2ResizedImage['width'],
                'HEIGHT' => $x2ResizedImage['height'],
            ];
        }
    }

    $templateData['OFFER_IDS'] = $offerIds;
    $templateData['OFFER_CODES'] = $offerCodes;
    unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio, $xResizedImage, $x2ResizedImage);

    $jsParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => true,
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP' => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS' => true,
            'USE_SUBSCRIBE' => $showSubscribe,
            'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
            'ALT' => $alt,
            'TITLE' => $title,
            'MAGNIFIER_ZOOM_PERCENT' => 200,
            'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                : null,
            'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
            'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
        ),
        'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
        'VISUAL' => $itemIds,
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
        ),
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'ACTIVE' => $arResult['ACTIVE'],
            'NAME' => $arResult['~NAME'],
            'CATEGORY' => $arResult['CATEGORY_PATH'],
            'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
            'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
            'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
            'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
        ),
        'BASKET' => array(
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL' => $arParams['BASKET_URL'],
            'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        ),
        'OFFERS' => $arResult['JS_OFFERS'],
        'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS' => $skuProps
    );
} else {
    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
        ?>
        <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
            <?php
            if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
                    ?>
                    <input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                           value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                    <?php
                    unset($arResult['PRODUCT_PROPERTIES'][$propId]);
                }
            }

            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if (!$emptyProductProperties) {
                ?>
                <table>
                    <?php
                    foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
                        ?>
                        <tr>
                            <td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
                            <td>
                                <?php
                                if (
                                    $arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
                                    && $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
                                ) {
                                    foreach ($propInfo['VALUES'] as $valueId => $value) {
                                        ?>
                                        <label>
                                            <input type="radio"
                                                   name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                                                   value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
                                            <?= $value ?>
                                        </label>
                                        <br>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
                                        <?php
                                        foreach ($propInfo['VALUES'] as $valueId => $value) {
                                            ?>
                                            <option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
                                                <?= $value ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
            ?>
        </div>
        <?php
    }

    $resizedSlider = [
        'X' => [],
        'X2' => [],
    ];

    foreach ($arResult['MORE_PHOTO'] as $morePhoto) {
        $xResizedImage = \CFile::ResizeImageGet(
            $morePhoto['ID'],
            [
                'width' => 400,
                'height' => 400,
            ],
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );

        $x2ResizedImage = \CFile::ResizeImageGet(
            $morePhoto['ID'],
            [
                'width' => 800,
                'height' => 800,
            ],
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );

        if (!$xResizedImage || !$x2ResizedImage) {
            $xResizedImage = [
                'src' => $morePhoto['SRC'],
                'width' => $morePhoto['WIDTH'],
                'height' => $morePhoto['HEIGHT'],
            ];
            $x2ResizedImage = $xResizedImage;
        }

        $resizedSlider['X'][] = [
            'ID' => $morePhoto['ID'],
            'SRC' => $xResizedImage['src'],
            'WIDTH' => $xResizedImage['width'],
            'HEIGHT' => $xResizedImage['height'],
        ];
        $resizedSlider['X2'][] = [
            'ID' => $morePhoto['ID'],
            'SRC' => $x2ResizedImage['src'],
            'WIDTH' => $x2ResizedImage['width'],
            'HEIGHT' => $x2ResizedImage['height'],
        ];
    }

    $jsParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
            'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
            'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
            'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
            'USE_STICKERS' => true,
            'USE_SUBSCRIBE' => $showSubscribe,
            'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
            'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
            'ALT' => $alt,
            'TITLE' => $title,
            'MAGNIFIER_ZOOM_PERCENT' => 200,
            'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
            'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
            'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                : null
        ),
        'VISUAL' => $itemIds,
        'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'ACTIVE' => $arResult['ACTIVE'],
            'PICT' => reset($arResult['MORE_PHOTO']),
            'NAME' => $arResult['~NAME'],
            'SUBSCRIPTION' => true,
            'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
            'ITEM_PRICES' => $arResult['ITEM_PRICES'],
            'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
            'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
            'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
            'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
            'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
            'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER' => $arResult['MORE_PHOTO'],
            'RESIZED_SLIDER' => $resizedSlider,
            'CAN_BUY' => $arResult['CAN_BUY'],
            'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
            'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
            'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
            'CATEGORY' => $arResult['CATEGORY_PATH']
        ),
        'BASKET' => array(
            'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS' => $emptyProductProperties,
            'BASKET_URL' => $arParams['BASKET_URL'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        )
    );
    unset($emptyProductProperties, $resizedSlider, $xResizedImage, $x2ResizedImage);
}

$jsParams['IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED'] =
    $arResult['IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED'];

?>
    </div>
    <script>
        BX.message({
            ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
            TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
            TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
            BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
            BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
            BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
            BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
            BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
            TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
            COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
            COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
            COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
            PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
            PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
            RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
            RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
            SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
        });

        var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
    </script>
<script>

        document.getElementById('visually-hidden').onclick = function() {
        document.getElementById('visually-hidden').classList.add('selected');
    }

</script>
<?php
$arrayData = array(
    "@context" => "https://schema.org/",
    "@type" => "Product",
);

$arrayData["name"] = $name;

//region PREVIEW_TEXT
if (isset($arResult['PREVIEW_TEXT'])) {
    $arrayData["description"] = $arResult['PREVIEW_TEXT'];
}

//endregion

//region category
if (isset($arResult['CATEGORY_PATH'])) {
    $arrayData['category'] = $arResult['CATEGORY_PATH'];
}

//endregion

//region link
if (isset($arResult['DETAIL_PAGE_URL'])) {
    $arrayData['link'] = $arResult['DETAIL_PAGE_URL'];
}

//endregion

//region MORE_PHOTO
if (!empty($actualItem['MORE_PHOTO'])) {
    foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
        $arrayData['image'][] = $photo['SRC'];
    }
}

//endregion

//region $haveOffers
if ($haveOffers) {
    foreach ($arResult['JS_OFFERS'] as $offer) {
        $currentOffersList = array();

        if (!empty($offer['TREE']) && is_array($offer['TREE'])) {
            foreach ($offer['TREE'] as $propName => $skuId) {
                $propId = (int)substr($propName, 5);

                foreach ($skuProps as $prop) {
                    if ($prop['ID'] == $propId) {
                        foreach ($prop['VALUES'] as $propId => $propValue) {
                            if ($propId == $skuId) {
                                $currentOffersList[] = $propValue['NAME'];
                                break;
                            }
                        }
                    }
                }
            }
        }

        $offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];

        $arrayDataOffers[] = array(
            "sku" => htmlspecialcharsbx(implode('/', $currentOffersList)),
            "price" => $offerPrice['RATIO_PRICE'],
            "priceCurrency" => $offerPrice['CURRENCY'],
            "availability" => ($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock')
        );
    }


    unset($offerPrice, $currentOffersList);
} else {
    $arrayDataOffers[] = array(
        "price" => $price['RATIO_PRICE'],
        "priceCurrency" => $price['CURRENCY'],
        "availability" => ($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')
    );
}

$arrayData["offers"] = $arrayDataOffers;

//endregion

//region USE_VOTE_RATING
//todo: need to add ratingCount
if ($arParams['USE_VOTE_RATING'] === 'Y' && false) {
    $arrayData["aggregateRating"] = array(
        "@type" => "AggregateRating",
        "ratingValue" => $arResult["PROPERTIES"]["rating"]['VALUE'],
        "reviewCount" => $arResult["PROPERTIES"]["rating"]['VALUE']
    );
}

//endregion

?>
    <script type="application/ld+json"><?= json_encode($arrayData, JSON_UNESCAPED_UNICODE), "\n\n"; ?></script><?php

unset($actualItem, $itemIds, $jsParams);
