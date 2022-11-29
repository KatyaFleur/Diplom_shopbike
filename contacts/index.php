<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?><section class="products">
<div class="container">
<h2>Контакты</h2>
<? $APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	".default", 
	array(
		"EMAIL_TO" => "katyafleur@yandex.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"AJAX_MODE" => "Y",
		"USE_CAPTCHA" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
); ?>
</div>
</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>