<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="footer__form">
    <h2>подписаться на новости магазина go&ride</h2>
    <?$APPLICATION->IncludeComponent("bitrix:subscribe.form", "subscribe_footer", Array(
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"PAGE" => "#SITE_DIR#personal/subscribe/index.php",	// Страница редактирования подписки (доступен макрос #SITE_DIR#)
		"SHOW_HIDDEN" => "N",	// Показать скрытые рубрики подписки
		"USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
	),
	false
);?>
</div>