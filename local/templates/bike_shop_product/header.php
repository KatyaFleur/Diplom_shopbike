<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<!doctype html>
<?
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<head>

    <?use Bitrix\Main\Page\Asset;?>
    <?
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/slick.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/scripts.js');

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/slick.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
    ?>

    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?$APPLICATION->ShowPanel();?>
<header class="header header--catalog">
    <div class="container">
        <div class="header__wrp">
            <div class="header__wrp-nav header__wrp-nav--catalog">
                <a href="index.html">
                    <img src="./img/goride-logo.svg" alt="logo">
                </a>
                <nav class="header__nav-list-wrp">
                    <ul class="header__nav-list">
                        <li><a href="#">contacts</a></li>
                        <li><a href="#">sale</a></li>
                        <li><a href="#">about</a></li>
                    </ul>
                </nav>
                <div class="header__nav-box header__search">
                    <form action="#">
                        <label>
                            <input type="search" placeholder="Search">
                            <span class="visually-hidden">search</span>
                        </label>
                    </form>
                    <a href="#">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M0.5 2.8275C0.5 1.54183 1.54183 0.5 2.8275 0.5H19.1725C20.4582 0.5 21.5 1.54183 21.5 2.8275V19.1725C21.5 19.7898 21.2548 20.3818 20.8183 20.8183C20.3818 21.2548 19.7898 21.5 19.1725 21.5H2.8275C2.21021 21.5 1.6182 21.2548 1.18171 20.8183C0.745218 20.3818 0.5 19.7898 0.5 19.1725V2.8275ZM4.4165 18H17.8215C17.0697 16.919 16.0674 16.036 14.9003 15.4265C13.7331 14.817 12.4357 14.4991 11.119 14.5C9.80227 14.4991 8.5049 14.817 7.33773 15.4265C6.17056 16.036 5.16827 16.919 4.4165 18ZM11 12.1667C11.5362 12.1667 12.0672 12.061 12.5626 11.8558C13.058 11.6506 13.5082 11.3499 13.8874 10.9707C14.2665 10.5915 14.5673 10.1414 14.7725 9.64596C14.9777 9.15054 15.0833 8.61956 15.0833 8.08333C15.0833 7.5471 14.9777 7.01612 14.7725 6.52071C14.5673 6.0253 14.2665 5.57515 13.8874 5.19598C13.5082 4.81681 13.058 4.51603 12.5626 4.31083C12.0672 4.10562 11.5362 4 11 4C9.91703 4 8.87842 4.43021 8.11265 5.19598C7.34687 5.96175 6.91667 7.00037 6.91667 8.08333C6.91667 9.1663 7.34687 10.2049 8.11265 10.9707C8.87842 11.7365 9.91703 12.1667 11 12.1667Z"
                                    fill="#FFFEFE"/>
                        </svg>
                    </a>
                    <a href="#">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M0 0.700022C0 0.514364 0.0737521 0.336311 0.205032 0.205032C0.336311 0.073752 0.514364 0 0.700022 0H2.80009C2.95623 4.31374e-05 3.10789 0.0522926 3.23092 0.148439C3.35396 0.244586 3.44132 0.379109 3.47911 0.530616L4.04612 2.80009H20.3006C20.4034 2.80018 20.5049 2.82291 20.5979 2.86666C20.6909 2.91041 20.7732 2.9741 20.8388 3.05322C20.9044 3.13234 20.9518 3.22493 20.9776 3.32443C21.0034 3.42392 21.007 3.52788 20.988 3.62891L18.888 14.8293C18.858 14.9897 18.7728 15.1346 18.6473 15.2389C18.5218 15.3432 18.3638 15.4003 18.2006 15.4005H5.60017C5.43697 15.4003 5.27895 15.3432 5.15343 15.2389C5.02791 15.1346 4.94278 14.9897 4.91275 14.8293L2.81409 3.64991L2.25407 1.40004H0.700022C0.514364 1.40004 0.336311 1.32629 0.205032 1.19501C0.0737521 1.06373 0 0.885679 0 0.700022ZM7.00022 15.4005C6.25759 15.4005 5.54537 15.6955 5.02026 16.2206C4.49514 16.7457 4.20013 17.4579 4.20013 18.2006C4.20013 18.9432 4.49514 19.6554 5.02026 20.1805C5.54537 20.7056 6.25759 21.0006 7.00022 21.0006C7.74285 21.0006 8.45506 20.7056 8.98018 20.1805C9.50529 19.6554 9.8003 18.9432 9.8003 18.2006C9.8003 17.4579 9.50529 16.7457 8.98018 16.2206C8.45506 15.6955 7.74285 15.4005 7.00022 15.4005ZM16.8005 15.4005C16.0579 15.4005 15.3457 15.6955 14.8206 16.2206C14.2954 16.7457 14.0004 17.4579 14.0004 18.2006C14.0004 18.9432 14.2954 19.6554 14.8206 20.1805C15.3457 20.7056 16.0579 21.0006 16.8005 21.0006C17.5431 21.0006 18.2554 20.7056 18.7805 20.1805C19.3056 19.6554 19.6006 18.9432 19.6006 18.2006C19.6006 17.4579 19.3056 16.7457 18.7805 16.2206C18.2554 15.6955 17.5431 15.4005 16.8005 15.4005ZM7.00022 16.8005C7.37153 16.8005 7.72764 16.948 7.9902 17.2106C8.25276 17.4731 8.40026 17.8292 8.40026 18.2006C8.40026 18.5719 8.25276 18.928 7.9902 19.1905C7.72764 19.4531 7.37153 19.6006 7.00022 19.6006C6.6289 19.6006 6.2728 19.4531 6.01024 19.1905C5.74768 18.928 5.60017 18.5719 5.60017 18.2006C5.60017 17.8292 5.74768 17.4731 6.01024 17.2106C6.2728 16.948 6.6289 16.8005 7.00022 16.8005ZM16.8005 16.8005C17.1718 16.8005 17.5279 16.948 17.7905 17.2106C18.0531 17.4731 18.2006 17.8292 18.2006 18.2006C18.2006 18.5719 18.0531 18.928 17.7905 19.1905C17.5279 19.4531 17.1718 19.6006 16.8005 19.6006C16.4292 19.6006 16.0731 19.4531 15.8105 19.1905C15.548 18.928 15.4005 18.5719 15.4005 18.2006C15.4005 17.8292 15.548 17.4731 15.8105 17.2106C16.0731 16.948 16.4292 16.8005 16.8005 16.8005Z"
                                    fill="#FFFEFE"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header__catalog-nav container">
        <a href="index.html">home</a>
        <nav class="header__catalog-nav-list-wrp">
            <ul class="header__catalog-nav-list">
                <li><a href="#">shipping</a></li>
                <li><a href="#">best sellers</a></li>
                <li><a href="#">favourites</a></li>
                <li><a href="#">support</a></li>
            </ul>
        </nav>
    </div>
    <div class="header__inner">
        <div class="container">
            <nav>
                <ul class="header__inner-breadcrumbs-list">
                    <li><a href="#">bikes&nbsp/&nbsp</a></li>
                    <li><a href="#">mountain bikes&nbsp/&nbsp</a></li>
                    <li><a href="#">MTB HARDTAIL 56737</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<main>
    <section class="product-card">
        <div class="container">
            <h1>MTB Hardtail 56737</h1>
            <div class="product-card__info-wrp">
                <div class="product-card__img-wrp">
                    <img src="./img/city-bike.png" alt="bike">
                </div>

                <form class="product-card__form" action="">
                    <div class="product-card__form-wrp">
                        <fieldset>
                            <div class="product-card__form-title-wrp">
                                <legend>Size</legend>
                                <button type="button">Size guide</button>
                            </div>
                            <div class="product-card__form-radio-wrp">
                                <input class="visually-hidden" type="radio" id="s-size" name="size" value="s-size">
                                <label for="s-size">
                                    s
                                </label>
                                <input class="visually-hidden" type="radio" id="m-size" name="size" value="m-size" checked>
                                <label for="m-size">
                                    m
                                </label>
                                <input class="visually-hidden" type="radio" id="l-size" name="size" value="l-size">
                                <label for="l-size">
                                    l
                                </label>
                                <input class="visually-hidden" type="radio" id="xl-size" name="size" value="xl-size">
                                <label for="xl-size">
                                    xl
                                </label>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="product-card__form-title-wrp">
                                <legend>Colors</legend>
                            </div>
                            <div class="product-card__form-radio-wrp product-card__form-radio-wrp--size">
                                <input class="visually-hidden" type="radio" id="black" name="color" value="black">
                                <label for="black">
                                    black
                                </label>
                                <input class="visually-hidden" type="radio" id="white" name="color" value="white" checked>
                                <label for="white">
                                    white
                                </label>
                            </div>
                        </fieldset>
                        <h3>availability</h3>
                        <span>in stock</span>
                        <p>$ 750.00</p>
                    </div>
                    <button type="button">add to favourites</button>
                    <button type="submit">add to cart</button>
                </form>
            </div>
        </div>
    </section>
    <section class="information">
        <h2 class="visually-hidden">information</h2>
        <div class="container">
            <div class="information__wrp">
                <div class="information__images">
                    <img src="./img/info-1.jpg" alt="info-1">
                    <img src="./img/info-2.jpg" alt="info-2">
                    <img src="./img/info-3.jpg" alt="info-3">
                    <img src="./img/info-4.jpg" alt="info-4">
                </div>
                <div class="information__text">
                    <div class="information__text-wrp">
                        <h3>Characteristics</h3>
                        <p>Bicycle, also called bike, two-wheeled steerable machine that is pedaled by the rider's feet.
                            On
                            a standard bicycle the wheels are mounted in-line in a metal frame, with the front wheel
                            held in
                            a rotatable fork. The rider sits on a saddle and steers by leaning and turning handlebars
                            that
                            are attached to the fork. With a carbon frame, this bike nimbly handles any terrain.
                            Combining
                            29” wheels in the front and 27.5” wheels in the rear ensures that you will never lose
                            traction.
                            A power bike for riders who are looking for an electrified warhorse as a companion.</p>
                    </div>
                    <div class="information__text-wrp">
                        <h3>Features</h3>
                        <ul>
                            <li>Very lightweight frame, wheels and components.</li>
                            <li>A drop (curled) handlebar, though some have a flat bar like a mountain bike.</li>
                            <li>Narrow wheels and tires.</li>
                            <li>A composite (carbon fiber) front fork.</li>
                            <li>No front or rear suspension.</li>
                            <li>Men's and women's styles and a wide range of sizes.</li>
                        </ul>
                    </div>
                    <div class="information__text-wrp">
                        <h3>Product information</h3>
                        <div class="information__text-detailed-info-wrp">
                            <h4>Drivetrain</h4>
                            <p>High-precision, sturdy Microshift 8-speed shifter inner routine. Very comfortable design:
                                the
                                shifter is easy to operate regardless of hand size. Front Microshift derailleur and
                                high-precision Microshift rear derailleur</p>
                        </div>
                        <div class="information__text-detailed-info-wrp">
                            <h4>Crankset / cassette</h4>
                            <p>Microshift CS-H081 11-34 cassette (11/13/15/18/21/24/28/34) Aluminum Triban crankset
                                double
                                chainring 50/34. 170 mm crank arm length
                            </p>
                        </div>
                        <div class="information__text-detailed-info-wrp">
                            <h4>Brakes</h4>
                            <p>Promax DSK-300R disc brakes. 160 mm disc brakes at front and rear JAGWIRE
                                anti-compression
                                housing to ensure braking precision and efficiency Semi-metal pad</p>
                        </div>
                        <div class="information__text-detailed-info-wrp">
                            <h4>Wheels</h4>
                            <p>Triban Tubeless ready* wheels 6061T6 aluminum ETRTO dimensions: 622 x 17 C 28 mm high for
                                greater lateral rigidity Crossed stainless thread lock spokes to improve rigidity (28
                                front
                                and 28 rear) *Conversion kit required, including 2 tubeless valves + 2 rim strips +
                                bottle
                                of anti-puncture liquid
                            </p>
                        </div>
                        <div class="information__text-detailed-info-wrp">
                            <h4>Tires</h4>
                            <p>Triban protect: 700 x 28 Skin Wall puncture protection
                            </p>
                        </div>
                        <div class="information__text-detailed-info-wrp">
                            <h4>Saddle / seat post</h4>
                            <p>New Triban ErgoFit saddle. Hammock design for greater comfort. Aluminum Triban seat post.
                                Easy saddle adjustment Diameter: 27.2 mm. Length: 350 mm in M / L / XL, 250 mm in XS / S
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="review">
        <div class="container">
            <h2>Customer reviews</h2>
            <div class="review__wrp">
                <ul class="review__list">
                    <li class="review__item">
                        <h3>Great Bike</h3>
                        <p>I bought this bike about 1.5 months ago if I recall properly, to this day I've got a little
                            bit
                            over 550km on it. The group set isn't the greatest, I've been having issues with it where it
                            skips a cog sometimes, not sure why that might be. I also don't live near a store so I can't
                            take it in, so I'll have to set if I can take it to a local bike shop I guess. Great bike
                            tho,
                            and if you're looking into getting something like this on a budget I would suggest it. I
                            know I
                            might not win any races, but I'm on it to ride and get excercise, so it meets my needs. Also
                            the
                            customers service is great and they helped me over the phone a lot.
                        </p>
                        <span>Leon</span>
                        <time>July 2020</time>
                    </li>
                    <li class="review__item">
                        <h3>Great Bike</h3>
                        <p>I bought this bike about 1.5 months ago if I recall properly, to this day I've got a little
                            bit
                            over 550km on it. The group set isn't the greatest, I've been having issues with it where it
                            skips a cog sometimes, not sure why that might be. I also don't live near a store so I can't
                            take it in, so I'll have to set if I can take it to a local bike shop I guess. Great bike
                            tho,
                            and if you're looking into getting something like this on a budget I would suggest it. I
                            know I
                            might not win any races, but I'm on it to ride and get excercise, so it meets my needs. Also
                            the
                            customers service is great and they helped me over the phone a lot.
                        </p>
                        <span>Leon</span>
                        <time>July 2020</time>
                    </li>
                </ul>
                <button type="button">See all</button>
            </div>
        </div>
    </section>
    <section class="products">
        <div class="container">
            <h2>Related Items</h2>
            <div class="slider slick-good-slider">
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>$ 95.00</p>
                            <p>Free shipping Free pick up</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>$ 95.00</p>
                            <p>Free shipping Free pick up</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>$ 95.00</p>
                            <p>Free shipping Free pick up</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>$ 95.00</p>
                            <p>Free shipping Free pick up</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>$ 95.00</p>
                            <p>Free shipping Free pick up</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>$ 95.00</p>
                            <p>Free shipping Free pick up</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>$ 95.00</p>
                            <p>Free shipping Free pick up</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="reviewed">
        <div class="container">
            <h2>Recently viewed</h2>
            <div class="slider slick-good-slider">
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="product.html">Bottle cage</a></h3>
                            <p>$ 95.00</p>
                            <p>Free shipping Free pick up</p>
                        </div>
                    </div>
                    <button>order now</button>
                </div>
            </div>
        </div>
    </section>
