<?php
//<ul>
//	<li><a href='#'>Меню1</a></li>
//	<li><a href='#'>Меню2</a></li>
//	<li><a href='#'>Меню3</a></li>
//	<li><a href='#'>Меню4</a></li>
//</ul>

$menu = [
    ['herf' => '#', 'txt' => 'Меню1'],
    ['herf' => '#', 'txt' => 'Меню2'],
    ['herf' => '#', 'txt' => 'Меню3'],
    [
        ['herf' => '#', 'txt' => 'Меню31'],
        ['herf' => '#', 'txt' => 'Меню32']
    ],
    ['herf' => '#', 'txt' => 'Меню4'],
];


function renderMenu($menu)
{
    $menuStr = '';
    foreach ($menu as $ul) {
        if (array_key_exists(0, $ul)) {
            $menuStr .= renderMenu($ul);
        } else {
            $menuStr .= "    <li><a href='$ul[herf]'>$ul[txt]</a></li>\n";
        }
    }
    return "<ul>\n$menuStr</ul>\n";
}

echo $show = renderMenu($menu);