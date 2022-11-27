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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
    'LIST' => array(
        'CONT' => 'bx_sitemap',
        'TITLE' => 'bx_sitemap_title',
        'LIST' => 'catalog-section-list-list',
    ),
    'LINE' => array(
        'TITLE' => 'catalog-section-list-item-title',
        'LIST' => 'catalog-section-list-line-list mb-4',
        'EMPTY_IMG' => $this->GetFolder() . '/images/line-empty.png'
    ),
    'TEXT' => array(
        'TITLE' => 'catalog-section-list-item-title',
        'LIST' => 'catalog-section-list-text-list row mb-4'
    ),
    'TILE' => array(
        'TITLE' => 'catalog-section-list-item-title',
        'LIST' => 'catalog-section-list-tile-list row mb-4',
        'EMPTY_IMG' => $this->GetFolder() . '/images/tile-empty.png'
    )
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>

<? if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID']) {
    $this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

    ?><h2 class="mb-3" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>" ><?
    echo(
    isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
        ? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
        : $arResult['SECTION']['NAME']
    );
    ?>
    </h2><?
}

if (0 < $arResult["SECTIONS_COUNT"]) {
    ?>
    <?

    switch ($arParams['VIEW_MODE']) {
        case 'TEXT':
            $countSectDisplay = 0;
            $countSect = count($arResult['SECTIONS']);
            foreach ($arResult['SECTIONS'] as &$arSection) {
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                if ($arSection['ELEMENT_CNT'] > 0) {
                    $countSectDisplay++;
                }

                $lastSect = $countSect - 1;
                ?>
                <? if ($countSectDisplay == 3) {
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.viewed.products",
                        "viewed_products",
                        array(
                            "SHOW_FROM_SECTION" => "N",
                            "IBLOCK_ID" => "4",
                            "SECTION_ID" => "",
                            "SECTION_CODE" => "",
                            "SECTION_ELEMENT_ID" => "",
                            "SECTION_ELEMENT_CODE" => "",
                            "HIDE_NOT_AVAILABLE" => "N",
                            "SHOW_DISCOUNT_PERCENT" => "Y",
                            "PRODUCT_SUBSCRIPTION" => "N",
                            "SHOW_NAME" => "Y",
                            "SHOW_IMAGE" => "Y",
                            "MESS_BTN_BUY" => "Купить",
                            "MESS_BTN_DETAIL" => "Подробнее",
                            "MESS_BTN_SUBSCRIBE" => "Подписаться",
                            "PAGE_ELEMENT_COUNT" => "30",
                            "DETAIL_URL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_NOTES" => "",
                            "CACHE_GROUPS" => "Y",
                            "SHOW_OLD_PRICE" => "N",
                            "PRICE_CODE" => array(
                                0 => "BASE",
                            ),
                            "SHOW_PRICE_COUNT" => "1",
                            "PRICE_VAT_INCLUDE" => "Y",
                            "CONVERT_CURRENCY" => "N",
                            "BASKET_URL" => "/personal/basket.php",
                            "ACTION_VARIABLE" => "action",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                            "ADD_PROPERTIES_TO_BASKET" => "Y",
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "USE_PRODUCT_QUANTITY" => "N",
                            "SHOW_PRODUCTS_2" => "N",
                            "PROPERTY_CODE_2" => "",
                            "CART_PROPERTIES_2" => "",
                            "ADDITIONAL_PICT_PROP_2" => "-",
                            "LABEL_PROP_2" => "-",
                            "PROPERTY_CODE_3" => "",
                            "CART_PROPERTIES_3" => "",
                            "ADDITIONAL_PICT_PROP_3" => "-",
                            "OFFER_TREE_PROPS_3" => array(
                                0 => "-",
                            ),
                            "COMPONENT_TEMPLATE" => "viewed_products",
                            "IBLOCK_TYPE" => "catalog",
                            "DEPTH" => "2",
                            "LINE_ELEMENT_COUNT" => "3",
                            "TEMPLATE_THEME" => "blue",
                            "SHOW_PRODUCTS_4" => "Y",
                            "ADDITIONAL_PICT_PROP_4" => "MORE_PHOTO",
                            "LABEL_PROP_4" => "-",
                            "ADDITIONAL_PICT_PROP_5" => ""
                        ),
                        false
                    );
                } else if ($countSectDisplay === $lastSect) {
                    unset($i);
                    // Элементы раздела
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "sale_block",
                        array(
                            "IBLOCK_TYPE" => "catalog",
                            "IBLOCK_ID" => "4",
                            "SECTION_ID" => "21",
                            "SECTION_CODE" => "",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "ELEMENT_SORT_FIELD" => "sort",
                            "ELEMENT_SORT_ORDER" => "asc",
                            "ELEMENT_SORT_FIELD2" => "id",
                            "ELEMENT_SORT_ORDER2" => "desc",
                            "FILTER_NAME" => "arrFilter",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "SHOW_ALL_WO_SECTION" => "N",
                            "HIDE_NOT_AVAILABLE" => "N",
                            "PAGE_ELEMENT_COUNT" => "6",
                            "LINE_ELEMENT_COUNT" => "3",
                            "PROPERTY_CODE" => "",
                            "OFFERS_LIMIT" => "5",
                            "SECTION_URL" => "",
                            "DETAIL_URL" => "",
                            "SECTION_ID_VARIABLE" => "SECTION_ID",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_NOTES" => "",
                            "CACHE_GROUPS" => "Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "BROWSER_TITLE" => "-",
                            "SET_META_KEYWORDS" => "Y",
                            "META_KEYWORDS" => "-",
                            "SET_META_DESCRIPTION" => "Y",
                            "META_DESCRIPTION" => "-",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "SET_STATUS_404" => "Y",
                            "CACHE_FILTER" => "N",
                            "ACTION_VARIABLE" => "action",
                            "PRODUCT_ID_VARIABLE" => "id",
                            "PRICE_CODE" => array(
                                0 => "BASE",
                            ),
                            "USE_PRICE_COUNT" => "N",
                            "SHOW_PRICE_COUNT" => "1",
                            "PRICE_VAT_INCLUDE" => "N",
                            "CONVERT_CURRENCY" => "N",
                            "BASKET_URL" => "/personal/cart/",
                            "USE_PRODUCT_QUANTITY" => "N",
                            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                            "ADD_PROPERTIES_TO_BASKET" => "Y",
                            "PRODUCT_PROPS_VARIABLE" => "prop",
                            "PARTIAL_PRODUCT_PROPERTIES" => "N",
                            "PRODUCT_PROPERTIES" => "",
                            "DISPLAY_COMPARE" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Товары",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "COMPONENT_TEMPLATE" => "sale_block",
                            "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                            "OFFERS_SORT_FIELD" => "sort",
                            "OFFERS_SORT_ORDER" => "asc",
                            "OFFERS_SORT_FIELD2" => "id",
                            "OFFERS_SORT_ORDER2" => "desc",
                            "OFFERS_FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "BACKGROUND_IMAGE" => "-",
                            "TEMPLATE_THEME" => "",
                            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false}]",
                            "ENLARGE_PRODUCT" => "STRICT",
                            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                            "SHOW_SLIDER" => "N",
                            "PRODUCT_DISPLAY_MODE" => "N",
                            "ADD_PICT_PROP" => "MORE_PHOTO",
                            "LABEL_PROP" => array(),
                            "PRODUCT_SUBSCRIPTION" => "Y",
                            "SHOW_DISCOUNT_PERCENT" => "N",
                            "SHOW_OLD_PRICE" => "N",
                            "SHOW_MAX_QUANTITY" => "N",
                            "SHOW_CLOSE_POPUP" => "N",
                            "MESS_BTN_BUY" => "Купить",
                            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                            "MESS_BTN_SUBSCRIBE" => "Подписаться",
                            "MESS_BTN_DETAIL" => "Подробнее",
                            "MESS_NOT_AVAILABLE" => "Нет в наличии",
                            "RCM_TYPE" => "personal",
                            "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                            "SHOW_FROM_SECTION" => "N",
                            "SEF_MODE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "USE_MAIN_ELEMENT_SECTION" => "N",
                            "ADD_TO_BASKET_ACTION" => "ADD",
                            "USE_ENHANCED_ECOMMERCE" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "LAZY_LOAD" => "N",
                            "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                            "LOAD_ON_SCROLL" => "N",
                            "SHOW_404" => "Y",
                            "MESSAGE_404" => "",
                            "COMPATIBLE_MODE" => "N",
                            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                            "SLIDER_INTERVAL" => "3000",
                            "SLIDER_PROGRESS" => "N",
                            "PROPERTY_CODE_MOBILE" => array(
                                0 => "ARTICLE",
                            ),
                            "FILE_404" => ""
                        ),
                        false
                    );
                }
                ?>
                <? if (($arSection['ID']) !== ($arParams['EXCLUDE_SECTION']) && $arSection['ELEMENT_CNT'] > 0) { ?>


                    <section class="products">
                    <div class="container" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                    <h2><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a></h2>
                    <?
                }
                ?>
                <div class="slider slick-good-slider">
                    <? if (CModule::IncludeModule("iblock")):
                        $iblock_id = $arParams["IBLOCK_ID"];
                        $sec = $arSection['ID'];
                        # show url my elements
                        $my_elements = CIBlockElement::GetList(
                            array("ID" => "ASC"),
                            array("IBLOCK_ID" => $iblock_id, "SECTION_ID" => $sec, "INCLUDE_SUBSECTIONS" => "Y"),
                            false,
                            false,
                            array('ID', 'NAME', 'DETAIL_PAGE_URL', 'PREVIEW_PICTURE', 'CATALOG_PRICE_1', 'PROPERTY_ARTICLE')
                        );

                        while ($ar_fields = $my_elements->GetNext()) {
                            $img_path = CFile::GetPath($ar_fields["PREVIEW_PICTURE"]);
                            ?>
                            <? if (($arSection['ID']) !== ($arParams['EXCLUDE_SECTION']) && $arSection['ELEMENT_CNT'] > 0) { ?>
                                <div class="slider__item">
                                    <div class="slider__item-wrp">
                                        <img src="<? echo $img_path ?>" alt="<? echo $ar_fields['NAME']; ?>">
                                        <div class="slider__item-content-wrp">
                                            <h3>
                                                <a href="<? echo urldecode($ar_fields['DETAIL_PAGE_URL']) ?>"><? echo $ar_fields['NAME']; ?></a>
                                            </h3>
                                            <p><? echo $ar_fields['CATALOG_PRICE_1'] ?>&nbspр</p>
                                            <p>Артикул:&nbsp<? echo $ar_fields['PROPERTY_ARTICLE_VALUE'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?
                            }
                            ?>


                            <?
                        }
                    endif;
                    ?>
                </div>
                </div>
                </section>
                <?
            }
            unset($arSection);
            break;
    }
    ?>

    <?
}
?>




