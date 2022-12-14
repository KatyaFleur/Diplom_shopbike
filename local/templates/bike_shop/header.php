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
<header class="header">
    <div class="container">
        <div class="header__wrp">
            <div class="header__wrp-nav">
                <a href="#">
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
                $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_menu_main", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "top_menu_main"
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
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/include/banner.php"
                ),
                false
            ); ?>

        </div>
    </div>
</header>
<main>

