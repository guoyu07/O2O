<?php
/**
 * @title Bootstrap
 * @description
 * Bootstrap 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * @author zhangchunsheng
 * @email zhangchunsheng423@gmail.com
 * @version V1.0
 * @date 2015-07-06 16:50
 */
use eYaf\Request;
use eYaf\Layout;

class Bootstrap extends Yaf_Bootstrap_Abstract {
    private $_config;

    public function _initErrorHandler(Yaf_Dispatcher $dispatcher) {
        $dispatcher->setErrorHandler(array(get_class($this), 'error_handler'), 1);
    }

    public function _initConfig() {
        //把配置保存起来
        $this->_config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $this->_config);
    }

    public function _initPlugin(Yaf_Dispatcher $dispatcher) {
        $userPlugin = new UserPlugin();
        $dispatcher->registerPlugin($userPlugin);
    }

    public function _initRoute(Yaf_Dispatcher $dispatcher) {
        //在这里注册自己的路由协议，默认使用简单路由
        //print_r($routes = Yaf_Dispatcher::getInstance()->getRouter()->getRoute("default"));
        //http://domain.com/index.php?r=/a/b/c
        Yaf_Dispatcher::getInstance()->getRouter()->addRoute(
            "supervar", new Yaf_Route_Supervar("r")
        );
        //http://domain.com/index.php?c=index&a=test
        Yaf_Dispatcher::getInstance()->getRouter()->addRoute(
            "simple", new Yaf_Route_Simple("m", "c", "a")
        );
        $route = new Yaf_Route_Rewrite(
            "/auditlog/list/:id/:name",
            array(
                "controller" => "item",
                "action" => "get"
            )
        );
        Yaf_Dispatcher::getInstance()->getRouter()->addRoute(
            "auditlog", $route
        );
        //$dispatcher->setDefaultModule("index")->setDefaultController("index")->setDefaultAction("index");
    }

    public function _initView(Yaf_Dispatcher $dispatcher) {
        Yaf_Registry::set("dispatcher", $dispatcher);
    }

    public function _initDb(Yaf_Dispatcher $dispatcher) {
        $this->_db = new medoo($this->_config->mysql->read->toArray());
        Yaf_Registry::set("_db", $this->_db);
    }

    public function _initSession($dispatcher) {
        //Yaf_Session::getInstance()->start();
    }

    /**
     * Custom error handler.
     *
     * Catches all errors(not exceptions) and creates and ErrorException.
     * ErrorException then can caught by Yaf_ErrorController
     *
     * @param integer $errno    the error number.
     * @param string  $errstr   the error message.
     * @param string  $errfile  the file where error occured.
     * @param integer $errline  the line of the file where error occured.
     *
     * @throws ErrorException
     */
    public static function error_handler($errno, $errstr, $errfile, $errline) {
        // Do not throw exception if error was prepended by @
        //
        // See {@link http://www.php.net/set_error_handler}
        //
        // error_reporting() settings will have no effect and your error handler
        // will be called regardless - however you are still able to read
        // the current value of error_reporting and act appropriately.
        // Of particular note is that this value will be 0
        // if the statement that caused the error was prepended
        // by the @ error-control operator.
        if(error_reporting() === 0) {
            return;
        }

        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
}