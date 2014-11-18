<?php

//XSS prevention - replace dangerous characters
//Function credit - https://www.owasp.org/index.php/OWASP_PHP_Filters
function sanitizeHtmlString($string){
    //characters to look for
    $pattern[0] = '/\&/';
    $pattern[1] = '/</';
    $pattern[2] = "/>/";
    $pattern[3] = '/\n/';
    $pattern[4] = '/"/';
    $pattern[5] = "/'/";
    $pattern[6] = "/%/";
    $pattern[7] = '/\(/';
    $pattern[8] = '/\)/';
    $pattern[9] = '/\+/';
    $pattern[10] = '/-/';

    //characters to replace with
    $replacement[0] = '&amp;';
    $replacement[1] = '&lt;';
    $replacement[2] = '&gt;';
    $replacement[3] = '<br>';
    $replacement[4] = '&quot;';
    $replacement[5] = '&#39;';
    $replacement[6] = '&#37;';
    $replacement[7] = '&#40;';
    $replacement[8] = '&#41;';
    $replacement[9] = '&#43;';
    $replacement[10] = '&#45;';

    return preg_replace($pattern, $replacement, $string);
}