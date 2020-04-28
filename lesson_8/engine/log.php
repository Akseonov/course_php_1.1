<?php
function logging()
{
    $day = date('G:i:s d:m:Y');
    file_put_contents(DIR_LOG . "/log.txt", $day . "\r\n", FILE_APPEND);
    $log = count(explode("\r\n", file_get_contents(DIR_LOG . "/log.txt")));

    if ($log > 10) {
        $dir = DIR_LOG . "/";
        $count = count(scandir($dir)) - 2;
        rename($dir . "log.txt", $dir . "log" . $count . ".txt");
    }
}