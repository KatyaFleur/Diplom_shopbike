<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>



<?
echo preg_replace_callback(
    "/#TEST#/is".BX_UTF_PCRE_MODIFIER,
    function ($matches) {
        ob_start();
        $GLOBALS["APPLICATION"]->IncludeComponent(
            "bitrix:catalog.viewed.products",
            "viewed_products",
            array(
                "SHOW_FROM_SECTION" => "Y",
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
                "CACHE_GROUPS" => "N",
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
                "SHOW_PRODUCTS_2" => "Y",
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
                "ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO"
            ),
            false
        );
        $retrunStr = @ob_get_contents();
        ob_get_clean();
        return $retrunStr;
    },
    $arResult["CACHED_TPL"]);
?>

