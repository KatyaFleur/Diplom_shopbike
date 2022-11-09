<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подписка");
?>

<?// Страница редактирования подписки
$APPLICATION->IncludeComponent(
    "bitrix:subscribe.edit",
    ".default",                   // [.default, clear]
    array(
        // region Источник данных
        "SHOW_HIDDEN"             =>  "N",     // Показать скрытые рубрики подписки
        // endregion
        // region Управление режимом AJAX
        "AJAX_MODE"               =>  "N",     // Включить режим AJAX
        "AJAX_OPTION_JUMP"        =>  "N",     // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE"       =>  "Y",     // Включить подгрузку стилей
        "AJAX_OPTION_HISTORY"     =>  "N",     // Включить эмуляцию навигации браузера
        "AJAX_OPTION_ADDITIONAL"  =>  "",      // Дополнительный идентификатор
        // endregion
        // region Настройки кеширования
        "CACHE_TYPE"              =>  "A",     // Тип кеширования : array ( 'A' => 'Авто + Управляемое', 'Y' => 'Кешировать', 'N' => 'Не кешировать', )
        "CACHE_TIME"              =>  "3600",  // Время кеширования (сек.)
        "CACHE_NOTES"             =>  "",      //
        // endregion
        // region Дополнительные настройки
        "ALLOW_ANONYMOUS"         =>  "Y",     // Разрешить анонимную подписку
        "SHOW_AUTH_LINKS"         =>  "Y",     // Показывать ссылки на авторизацию при анонимной подписке
        "SET_TITLE"               =>  "Y",     // Устанавливать заголовок страницы
        // endregion
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>