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

function arr2ini(array $a, array $parent = array())
{
    $out = '';
    foreach ($a as $k => $v)
    {
        if (is_array($v))
        {
            //subsection case
            //merge all the sections into one array...
            $sec = array_merge((array) $parent, (array) $k);
            //add section information to the output
            $out .= '[' . join('.', $sec) . ']' . PHP_EOL;
            //recursively traverse deeper
            $out .= arr2ini($v, $sec);
        }
        else
        {
            //plain key->value case
            $out .= "$k = $v" . PHP_EOL;
        }
    }
    return $out;
}