<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

function getAvatar($email, $s = 150, $d = 'mp', $r = 'g', $img = false, $atts = 'https://hlbot.systemy.net/assets/img/avatar.png') {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}