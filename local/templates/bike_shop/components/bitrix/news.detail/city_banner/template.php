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
$this->setFrameMode(true);
?>

<section class="ride-us">
    <img src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?>">
    <a href="<?= $arResult["DISPLAY_PROPERTIES"]['LINK']['VALUE'] ?>"><?= $arResult["NAME"] ?></a>
</section>



