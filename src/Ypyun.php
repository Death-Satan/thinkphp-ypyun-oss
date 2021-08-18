<?php
/**
 * @author    : Death-Satan
 * @date      : 2021/8/18
 * @createTime: 23:58
 * @company   : Death撒旦
 * @link      https://www.cnblogs.com/death-satan
 */
namespace think\filesystem\driver;
use JellyBool\Flysystem\Upyun\UpyunAdapter;
use Qcloud\Cos\Client;

/**
 * 又拍云 oss thinkphp filesystem驱动
 * Class Tencent
 * @package think\filesystem\driver
 */
class Ypyun extends \think\filesystem\Driver
{
    protected function createAdapter (): \League\Flysystem\AdapterInterface
    {
        return new UpyunAdapter($this->config['bucket'],$this->config['operator'],$this->config['password'],$this->config['domain'],$this->config['protocol']);
    }
}