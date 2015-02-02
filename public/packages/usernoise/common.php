<?php
define('ABSPATH', dirname(__FILE__));
define('UN_VERSION', '1.1');

require(ABSPATH . "/inc/template.php");
require(ABSPATH . "/config.php");
require(ABSPATH . "/localization.php");
if (function_exists('date_default_timezone_set'))
  date_default_timezone_set($config['timezone']);
$h = new HTML_Helpers_0_4;

function strip_slashes_if_needed($string){
    if (get_magic_quotes_gpc())
        return is_array($string) ? array_map('strip_slashes_if_needed', $string) : stripslashes($string);
    return $string;
}
?>