<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true); ?>
<?

if ($arParams["SHOW_INPUT"] !== "N"):?>

        <form action="<? echo $arResult["FORM_ACTION"] ?>">
            <label>
                <input type="search" placeholder="Поиск" name="q" autocomplete="off">
                <span class="visually-hidden">поиск</span>
            </label>
        </form>

<? endif ?>
