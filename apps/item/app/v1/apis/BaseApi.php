<?php
namespace Apps\Item\App\V1\Apis;

/**
 * API 基类
 * Class BaseApi
 * @package Apps\V1\Apis
 */
class BaseApi
{
    /**
     * 存放当前实例化类
     * @var Object HandlerNamespace
     */
    protected static $instance = null;

    /**
     * 请求当前api的参数
     * @var array
     */
    public $params = array();

    /**
     * 单例模式禁止外部实例化
     */
    final private function __construct()
    {
    }

    /**
     * 单例模式禁止外部克隆
     */
    final private function __clone()
    {
    }

    /**
     * 获取实例化对象
     * @return object
     */
    public static function instance()
    {
        if (self::$instance == null) {
            $class = get_called_class();
            self::$instance = new $class();
        }
        return self::$instance;
    }

    /**
     * 获取某一参数
     * @param $key 参数名
     * @param null $dafult 默认值
     * @return null
     * @throws \Exceptions\ParamException
     */
    public function getParam($key, $default = null)
    {
    	if (!isset($this->params[$key])) {
    		$argsCount = func_num_args();
    		if ($argsCount == 1) {
    			throw new \Exceptions\ParamException(\Config\ParamsRule::$rules[$key]['desc']."参数{$key}缺失");
    		}else{
    			return $default;
    		}
    	} else {
    		return $this->params[$key];
    	}
    }

    /**
     * 统一响应
     * @param array $codeArr code数据
     * @param array $result result数据
     * @param array $result extData数据
     * @return array
     */
    public function output($codeArr, $result = array(), $extData = array())
    {
        return array('codeData' => $codeArr, 'result' => $result, 'extData' => $extData);
    }
}