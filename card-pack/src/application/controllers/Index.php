<?php
/**
 * @title IndexController
 * @description
 * 首页
 * @author zhangchunsheng
 * @email zhangchunsheng423@gmail.com
 * @version V1.0
 * @date 2015-07-06 20:11
 */
class IndexController extends Yaf_Controller_Abstract {
    // default action name
    public function indexAction() {
        $this->getView()->content = "Hello World";
    }
}