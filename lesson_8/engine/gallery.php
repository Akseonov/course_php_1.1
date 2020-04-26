<?php

function renderGallery($link)
{
    $str = '';
    $dir = DIR_IMG . "/";
    $sql = "SELECT `id`, `name`, `big`, `small`, `vews` FROM `img` ORDER BY `img`.`vews` DESC";
    $result = mysqli_query($link, $sql);

    logging();

    while ($row = mysqli_fetch_assoc($result)) {
        $str .= "<div class='gallery_block'>
                <a rel=\"gallery\" class=\"photo\" href=\"/?p=img&id=" . $row['id'] . "\">
                    <img src=\"" . $dir . $row['small'] . "/" . $row['name'] . "\" width=\"150\" height=\"100\">
                </a>
                <H6>Просмотров: " . $row['vews'] . "</H6>
            </div>";
    }


    return "<div id=\"main\">
    <div class=\"post_title\"><h2>Наши картины</h2></div>
    <div class=\"gallery\">" . $str . "</div>
    </div>";
}
