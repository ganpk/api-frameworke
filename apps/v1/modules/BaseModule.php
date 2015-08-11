<?php
namespace Apps\V1\Modules;

/**
 * module的基类
 * Class BaseModule
 */
class BaseModule
{
    /** 当前类的实例化对象
     * @var BaseApi
     */
    protected static $instance = null;
    /**
     * 单例模式禁止外部实例化
     */
    final protected function __construct()
    {
    }

    /**
     * 单例模式禁止外部克隆
     */
    final protected function __clone()
    {
    }

    /**
     * 获取BaseApi实例
     * @return BaseApi
     */
    final public static function instance()
    {
        if (self::$instance === null) {
            $class = get_called_class();
            self::$instance = new $class();
        }
        return self::$instance;
    }
}