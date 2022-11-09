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
                $APPLICATION->IncludeComponent("bitrix:menu", "top_menu_main", array(
                    "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
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
            <div class="header__wrp-first-screen">
                <div class="header__desc">
                    <h2>go&ride</h2>
                    <p>велосипеды & аксессуары</p>
                    <a href="catalog.html">магазин</a>
                </div>
            </div>
            <div class="header__second-screen">
                <picture>
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/bycicle-mobile.png" media="(max-width: 1400px)">
                    <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/bicycle-first-screen.jpg">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/bicycle-first-screen.jpg" alt="bicycle"/>
                </picture>
            </div>
        </div>
    </div>
</header>
<main>
    <section class="products">

        <div class="container">
            <h2>Популярные товары</h2>
            <div class="slider slick-good-slider">
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="product.html">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="ride-us">
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/ride-with-us-bycicle.jpg" alt="ride-us-pic">
        <a href="#">по городу</a>
    </section>
    <section class="city-bike">
        <div class="container">
            <h2>Городские велосипеды</h2>
            <div class="slider slick-city-slider">
                <div class="slider__item">
                    <div class="city-bike__slide-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/city-bike.png" alt="city-bike">
                        <div class="city-bike__content">
                            <p>Предназначены для езды по дорогам с твердым покрытиям на не большие расстояния. Имеют
                                гладкие покрышки, жесткую вилки, комфортную посадку. Как правило, сразу же оборудованы
                                крыльями и багажником.</p>
                            <a href="#">в раздел</a>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="city-bike__slide-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/city-bike.png" alt="city-bike">
                        <div class="city-bike__content">
                            <p>Это особенная модель городского велосипеда, на которую сейчас действуют скидки и
                                акции</p>
                            <a href="#">подробнее</a>
                        </div>
                    </div>
                </div>

                <div class="slider__item">
                    <div class="city-bike__slide-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/city-bike.png" alt="city-bike">
                        <div class="city-bike__content">
                            <p>Дополнительные аксессуары для городских велосипедов. Все самое нужное и полезное. Без
                                этих штучек ваша дорога будет скучна и безрадостно. Просто необходимо их приобрести</p>
                            <a href="#">срочно купить</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="sale">
        <div class="container sale__wrp">
            <h2>Скидка 5%</h2>
            <div class="sale__img-wrp">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/helmet.png" alt="helmet">
            </div>
        </div>
    </section>
    <section class="reviewed">
        <div class="container">
            <h2>Уже просмотрели</h2>
            <div class="slider slick-good-slider">
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="product.html">Bottle cage</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                    <button>купить срочно</button>
                </div>
            </div>
        </div>
    </section>
