<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); // проверяем, загружена ли служебная часть сайта (ядро)?>
<?
/*
Структура массива $arResult
Массив $arResult состоит из вложенных массивов, соответсвующих пунктам меню.
Порядок следования пунктов
Вложенные массивы содержат ключи:
TEXT - текст текущего пункта меню
LINK - ссылка текущего пункта меню
SELECTED - выбран ли пункт меню в данный момент
PERMISSION - доступ на страницу указанную в $LINK, возможны следующие значения:
    D - доступ запрещён
    R - чтение (право просмотра содержимого файла)
    U - документооборот (право на редактирование файла в режиме документооборота)
    W - запись (право на прямое редактирование)
    X - полный доступ (право на прямое редактирование файла и право на изменение прав доступа на данных файл)
ADDITIONAL_LINKS - дополнительные ссылки для подсветки меню
ITEM_TYPE - "D" - директория (если LINK заканчивается на "/"), иначе "P" - страница
ITEM_INDEX - порядковый номер пункта меню
PARAMS - параметры пунктов меню
DEPTH_LEVEL - уровень вложенности пункта меню (1 для главного, 2 и далее для вложенных)
IS_PARENT - флаг того, что у этого пункта меню будет подменю

Вывод производится вложенными списками вида
<ul id="horizontal-multilevel-menu">
    <li><a>Пункт первого уровня вложенности</a></li>
    <li><a>Пункт первого уровня вложенности</a>
        <ul>
            <li><a>Пункт второго уровня вложенности</a></li>
            <li><a>Пункт второго уровня вложенности</a></li>
        </ul>
    </li>
    <li><a>Пункт первого уровня вложенности</a></li>
</ul>
*/
?>
<?if (!empty($arResult)): // если есть хотя бы 1 пункт меню, можно начинать вывод?>


    <?
    $previousLevel = 0; // переменная содержит значение DEPTH_LEVEL предыдущего пункта
foreach($arResult as $arItem): // пробегаем по пунктам, $arItem - массив с информацией о текущем пункте?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?// если уровень вложенности текущего пункта меню меньше чем у предыдущего, значит "подменю" закончилось и нужно закрыть список?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>

    <?if ($arItem["IS_PARENT"]): //если пункт содержит подменю, выводим ссылку и начинаем новый список (тег <ul>)?>

    <?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень вложенности =1, т.е. это главное меню?>
    <?// выводим ссылку и добавляем класс "root-item" если пункт неактивный и "root-item-selected" если активный?>
    <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
    <nav class="header__catalog-categories">
    <ul>
    <?else: // для остальных уровней вложенности?>
    <?// выводим ссылку и добавляем класс "parent". Если пункт активный, для элемента списка <li> добавляем класс "item-selected"?>

    <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
            <ul class="header__sub-catalog-categories">
    <?endif?>

    <?else: // для пунктов, не содержащих подменю?>

        <?if ($arItem["PERMISSION"] > "D"): // проверяем право доступа к пункту?>

            <?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень вложенности =1, т.е. это главное меню?>
                <?// выводим ссылку и добавляем класс "root-item" если пункт неактивный и "root-item-selected" если активный?>
                <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
            <?else: // для остальных уровней вложенности?>
                <?// выводим ссылку. Если пункт активный, для элемента списка <li> добавляем класс "item-selected"?>
                <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?else: // для пунктов, к которым запрещен доступ?>

            <?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень вложенности =1, т.е. это главное меню?>
                <?// выводим пустую ссылку и добавляем класс "root-item" если пункт неактивный и "root-item-selected" если активный?>
                <li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?else: // для остальных уровней вложенности?>
                <?// выводим пустую ссылку и добавляем класс "denied"?>
                <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?endif?>

    <?endif?>

    <?$previousLevel = $arItem["DEPTH_LEVEL"]; // запоминаем уровень вложенности?>

<?endforeach?>

    <?if ($previousLevel > 1):// если работа завершилась на пункте меню с уровнем вложенности >1, закрываем вложенные списки?>
        <?=str_repeat("</ul></li></nav>", ($previousLevel-1) );?>
    <?endif?>

    </nav>
    <div class="menu-clear-left"></div>
<?endif?>