<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
</main>
<footer class="footer">
    <div class="container">
        <div class="footer__wrp">
            <nav>
                <ul class="footer__nav-list">
                    <li><a href="#">каталог</a></li>
                    <li><a href="#">о магазине</a></li>
                    <li><a href="#">контакты</a></li>
                    <li><a href="#">доставка и оплата</a></li>
                </ul>
            </nav>
            <nav>
                <ul class="footer__nav-list">
                    <li><a href="#">карьера в нашем магазине</a></li>
                    <li><a href="#">как оформить возврат</a></li>
                    <li><a href="#">правила магазина</a></li>
                    <li><a href="#">соглашение о конфиденциальности</a></li>
                </ul>
            </nav>
            <div class="footer__form">
                <h2>подписаться на новости магазина go&ride</h2>
                <form action="#">
                    <div class="footer__form-wrp">
                        <label>
                            <input type="email" placeholder="Enter your Email adress" required>
                            <span class="visually-hidden">email</span>
                        </label>
                        <button>подписаться</button>
                    </div>
                    <span>Продолжая, вы соглашаетесь с нашей политикой конфиденциальности.</span>
                </form>
            </div>
        </div>
        <div class="footer__social-wrp">
            <? // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/include/social.php"
                ),
                false
            ); ?>
            <span>                    <? // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/copyright.php"
                    ),
                    false
                ); ?>
            </span>
        </div>
    </div>
</footer>
</body>
</html>