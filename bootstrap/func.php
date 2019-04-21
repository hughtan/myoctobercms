<?php
/**
 * Created by PhpStorm.
 * User: hught
 * Date: 2019/4/6
 * Time: 0:45
 */
/**
 * 从当前调用的方法返回类名
 * @param int $o 条件
 */
function lastFun($o=1)
{
    if($o) {
        $line = "Called @ ".
            xdebug_call_file().
            ":".
            xdebug_call_line().
            " from ".
            xdebug_call_function();
        echo $line;exit;
    }

}
function writeLogs($word, $name = 'test')
{
    $_word = var_export($word, true);
    $content = "执行日期：" . date("Y-m-d H:i:s", time()) . PHP_EOL . $_word . PHP_EOL;
    $logs = __DIR__ . '/../logs/' . $name . '.log';
    error_log($content, 3, $logs);
}
