<?php
/**
 * @title index
 * @description
 * 入口文件
 * @author zhangchunsheng
 * @email zhangchunsheng423@gmail.com
 * @version V1.0
 * @date 2015-07-06 16:50
 */
date_default_timezone_set('Asia/Shanghai');

define("APPLICATION_PATH", dirname(dirname(__FILE__)));
define('APP_PATH', dirname(__FILE__) . '/../');
define("PUBLIC_PATH",  dirname(__FILE__));

if(!extension_loaded("yaf")) {
    include(APPLICATION_PATH . '/globals/framework/loader.php');
}

$app = new Yaf_Application(APPLICATION_PATH . "/conf/application.ini");
$app->bootstrap()->run();