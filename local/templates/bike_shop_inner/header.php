<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!doctype html>
<?

use Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(__FILE__);
?>
<head>

    <? use Bitrix\Main\Page\Asset; ?>
    <?
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/slick.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/scripts.js');

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/slick.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
    ?>

    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<? $APPLICATION->ShowPanel(); ?>
<header class="header header--catalog">
    <div class="container">
        <div class="header__wrp">
            <div class="header__wrp-nav header__wrp-nav--catalog">
                <a href="/">
                    <? // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => "/include/logo.php"
                        ),
                        false
                    ); ?>
                </a>
                <? // Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
                $APPLICATION->IncludeComponent("bitrix:menu", "top_menu_main", array(
                    "ROOT_MENU_TYPE" => "top_inner",    // Тип меню для первого уровня
                    "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                    "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                    "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                    "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                    "MAX_LEVEL" => "1",    // Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "",    // Тип меню для остальных уровней
                    "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "DELAY" => "N",    // Откладывать выполнение шаблона меню
                    "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                    "COMPONENT_TEMPLATE" => ".default"
                ),
                    false
                ); ?>
                <div class="header__nav-box header__search">
                    <? // Поиск по заголовкам - http://dev.1c-bitrix.ru/user_help/settings/search/components_2/search_title.php
                    $APPLICATION->IncludeComponent("bitrix:search.title", "header_search", array(
                        "NUM_CATEGORIES" => "1",    // Количество категорий поиска
                        "TOP_COUNT" => "5",    // Количество результатов в каждой категории
                        "ORDER" => "date",    // Сортировка результатов
                        "USE_LANGUAGE_GUESS" => "Y",    // Включить автоопределение раскладки клавиатуры
                        "CHECK_DATES" => "N",    // Искать только в активных по дате документах
                        "SHOW_OTHERS" => "N",    // Показывать категорию "прочее"
                        "PAGE" => "#SITE_DIR#search/index.php",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                        "CATEGORY_0_TITLE" => "",    // Название категории
                        "CATEGORY_0" => array(    // Ограничение области поиска
                            0 => "all",
                        )
                    ),
                        false
                    ); ?>
                    <? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "cart_header", array(
                        "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",    // Страница корзины
                        "PATH_TO_PERSONAL" => SITE_DIR . "personal/",    // Страница персонального раздела
                        "SHOW_PERSONAL_LINK" => "N",    // Отображать персональный раздел
                        "SHOW_NUM_PRODUCTS" => "Y",    // Показывать количество товаров
                        "SHOW_TOTAL_PRICE" => "Y",    // Показывать общую сумму по товарам
                        "SHOW_PRODUCTS" => "N",    // Показывать список товаров
                        "POSITION_FIXED" => "N",    // Отображать корзину поверх шаблона
                        "SHOW_AUTHOR" => "Y",    // Добавить возможность авторизации
                        "PATH_TO_REGISTER" => SITE_DIR . "login/",    // Страница регистрации
                        "PATH_TO_PROFILE" => SITE_DIR . "personal/",    // Страница профиля
                        "COMPONENT_TEMPLATE" => "bootstrap_v4",
                        "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",    // Страница оформления заказа
                        "SHOW_EMPTY_VALUES" => "Y",    // Выводить нулевые значения в пустой корзине
                        "PATH_TO_AUTHORIZE" => "",    // Страница авторизации
                        "SHOW_REGISTRATION" => "N",    // Добавить возможность регистрации
                        "HIDE_ON_BASKET_PAGES" => "Y",    // Не показывать на страницах корзины и оформления заказа
                    ),
                        false
                    ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header__catalog-nav container">
        <?// Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
        $APPLICATION->IncludeComponent("bitrix:menu", "catalog_inner_topbotton", Array(
	"ROOT_MENU_TYPE" => "catalog_button",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "3",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "catalog",	// Тип меню для остальных уровней
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"COMPONENT_TEMPLATE" => "horizontal_multilevel",
		"MENU_THEME" => "site"
	),
	false
);?>
        <? // Меню - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/menu.php
        $APPLICATION->IncludeComponent("bitrix:menu", "catalog_second_menu", array(
            "ROOT_MENU_TYPE" => "catalog_second_menu",    // Тип меню для первого уровня
            "MENU_CACHE_TYPE" => "N",    // Тип кеширования
            "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
            "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
            "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
            "MAX_LEVEL" => "1",    // Уровень вложенности меню
            "CHILD_MENU_TYPE" => "",    // Тип меню для остальных уровней
            "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
            "DELAY" => "N",    // Откладывать выполнение шаблона меню
            "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
            "COMPONENT_TEMPLATE" => ".default"
        ),
            false
        ); ?>
    </div>
    <? if ($APPLICATION->GetCurDir() != '/catalog/'): ?>
        <? // Навигационная цепочка - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/navigation/breadcrumb.php
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", "bike_breadcrumb", array(
            "START_FROM" => "1",    // Номер пункта, начиная с которого будет построена навигационная цепочка
            "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
            "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
            "COMPONENT_TEMPLATE" => ".default"
        ),
            false
        ); ?>
    <? endif; ?>
    <? if ($APPLICATION->GetCurDir() == '/catalog/'): ?>
        <div class="header__catalog-offer">
            <div class="container">
                <div class="header__catalog-offer-wrp">
                    <h2>скидка 5%</h2>
                    <div class="header__catalog-offer-img">
                        <? // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => "/include/sale_banner.php"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    <? endif; ?>
</header>
<main>