<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="footer__form">
    <h2>подписаться на новости магазина go&ride</h2>
    <?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.form", 
	"subscribe_footer", 
	array(
		"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"PAGE" => "#SITE_DIR#personal/subscribe/index.php",
		"SHOW_HIDDEN" => "N",
		"USE_PERSONALIZATION" => "Y",
		"COMPONENT_TEMPLATE" => "subscribe_footer",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
</div>