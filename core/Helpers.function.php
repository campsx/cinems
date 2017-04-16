<?php

function dump($parameter){
    echo "<pre>";
    var_dump($parameter);
    echo "</pre>";
}

function dump_exit($parameter){
    dump($parameter);
    exit;
}