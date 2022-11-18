<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$frame = $this->createFrame()->begin();

if (!empty($arResult['ITEMS'])) {
    $templateData = array(
        'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
        'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
    );

    $arSkuTemplate = array();
    if (is_array($arResult['SKU_PROPS'])) {
        foreach ($arResult['SKU_PROPS'] as $iblockId => $skuProps) {
            $arSkuTemplate[$iblockId] = array();
            foreach ($skuProps as &$arProp) {
                ob_start();
                if ('TEXT' == $arProp['SHOW_MODE']) {
                    if (5 < $arProp['VALUES_COUNT']) {
                        $strClass = 'bx_item_detail_size full';
                        $strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
                        $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                        $strSlideStyle = '';
                    } else {
                        $strClass = 'bx_item_detail_size';
                        $strWidth = '100%';
                        $strOneWidth = '20%';
                        $strSlideStyle = 'display: none;';
                    }
                    ?>
                <div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
                    <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>

                    <div class="bx_size_scroller_container">
                        <div class="bx_size">
                            <ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
                                foreach ($arProp['VALUES'] as $arOneValue) {
                                    ?>
                                <li
                                        data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                        data-onevalue="<? echo $arOneValue['ID']; ?>"
                                        style="width: <? echo $strOneWidth; ?>;"
                                ><i></i><span class="cnt"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></span>
                                    </li><?
                                }
                                ?></ul>
                        </div>
                        <div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left"
                             data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                        <div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right"
                             data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                    </div>
                    </div><?
                } elseif ('PICT' == $arProp['SHOW_MODE']) {
                    if (5 < $arProp['VALUES_COUNT']) {
                        $strClass = 'bx_item_detail_scu full';
                        $strWidth = ($arProp['VALUES_COUNT'] * 20) . '%';
                        $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                        $strSlideStyle = '';
                    } else {
                        $strClass = 'bx_item_detail_scu';
                        $strWidth = '100%';
                        $strOneWidth = '20%';
                        $strSlideStyle = 'display: none;';
                    }
                    ?>
                <div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
                    <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span
                    <div class="bx_scu_scroller_container">
                        <div class="bx_scu">
                            <ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
                                foreach ($arProp['VALUES'] as $arOneValue) {
                                    ?>
                                <li
                                        data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID'] ?>"
                                        data-onevalue="<? echo $arOneValue['ID']; ?>"
                                        style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
                                ><i title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></i>
                                    <span class="cnt"><span class="cnt_item"
                                                            style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
                                                            title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
                                        ></span></span></li><?
                                }
                                ?></ul>
                        </div>
                        <div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left"
                             data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                        <div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right"
                             data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                    </div>
                    </div><?
                }
                $arSkuTemplate[$iblockId][$arProp['CODE']] = ob_get_contents();
                ob_end_clean();
                unset($arProp);
            }
        }
    }

    ?>
    <script type="text/javascript">
        BX.message({
            CVP_MESS_BTN_BUY: '<? echo('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CVP_TPL_MESS_BTN_BUY')); ?>',
            CVP_MESS_BTN_ADD_TO_BASKET: '<? echo('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CVP_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',

            CVP_MESS_BTN_DETAIL: '<? echo('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',

            CVP_MESS_NOT_AVAILABLE: '<? echo('' != $arParams['MESS_BTN_DETAIL'] ? CUtil::JSEscape($arParams['MESS_BTN_DETAIL']) : GetMessageJS('CVP_TPL_MESS_BTN_DETAIL')); ?>',
            CVP_BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            CVP_BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            CVP_ADD_TO_BASKET_OK: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
            CVP_TITLE_ERROR: '<? echo GetMessageJS('CVP_CATALOG_TITLE_ERROR') ?>',
            CVP_TITLE_BASKET_PROPS: '<? echo GetMessageJS('CVP_CATALOG_TITLE_BASKET_PROPS') ?>',
            CVP_TITLE_SUCCESSFUL: '<? echo GetMessageJS('CVP_ADD_TO_BASKET_OK'); ?>',
            CVP_BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CVP_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            CVP_BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            CVP_BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CVP_CATALOG_BTN_MESSAGE_CLOSE') ?>'
        });
    </script>

    <section class="reviewed reviewed--catalog">
        <div class="container">
            <h2>просмотренные</h2>
            <div class="slider slick-good-slider">
                <?
                $elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
                $elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
                $elementDeleteParams = array('CONFIRM' => GetMessage('CVP_TPL_ELEMENT_DELETE_CONFIRM'));
                foreach ($arResult['ITEMS'] as $key => $arItem) {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $elementEdit);
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                    $strMainID = $this->GetEditAreaId($arItem['ID']);

                    $arItemIDs = array(
                        'ID' => $strMainID,
                        'PICT' => $strMainID . '_pict',
                        'SECOND_PICT' => $strMainID . '_secondpict',
                        'MAIN_PROPS' => $strMainID . '_main_props',

                        'QUANTITY' => $strMainID . '_quantity',
                        'QUANTITY_DOWN' => $strMainID . '_quant_down',
                        'QUANTITY_UP' => $strMainID . '_quant_up',
                        'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                        'BUY_LINK' => $strMainID . '_buy_link',
                        'SUBSCRIBE_LINK' => $strMainID . '_subscribe',

                        'PRICE' => $strMainID . '_price',
                        'DSC_PERC' => $strMainID . '_dsc_perc',
                        'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',

                        'PROP_DIV' => $strMainID . '_sku_tree',
                        'PROP' => $strMainID . '_prop_',
                        'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                        'BASKET_PROP_DIV' => $strMainID . '_basket_prop'
                    );

                    $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

                    $strTitle = (
                    isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
                        ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
                        : $arItem['NAME']
                    );
                    $showImgClass = $arParams['SHOW_IMAGE'] != "Y" ? "no-imgs" : "";

                    ?>


                    <div class="slider__item">
                        <div class="slider__item-wrp">
                            <img src="<? echo $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="good-1">
                            <div class="slider__item-content-wrp">
                                <h3><a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><? echo $arItem['NAME']; ?></a>
                                </h3>
                                <p><? echo $arItem['CATALOG_PRICE_1'] ?>&nbspр</p>
                                <p>Артикул:&nbsp<? echo $arItem['PROPERTIES']['ARTICLE']['VALUE'] ?></p>
                            </div>
                        </div>
<!--                        <button><a id="--><?// echo $arItemIDs['BUY_LINK']; ?><!--" href="javascript:void(0)" rel="nofollow">купить</a>-->
<!--                        </button>-->
                       <button><a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" rel="nofollow">купить</a>
                        </button>
                    </div>


                    <?
                }
                unset($elementDeleteParams, $elementDelete, $elementEdit);
                ?>


            </div>
        </div>
    </section>
    <?
}
?>
<? $frame->beginStub(); ?>
<? $frame->end();