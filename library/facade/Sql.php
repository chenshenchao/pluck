<?php namespace pluck\facade;

use think\Facade;

/**
 * Sql 的 Facade
 * 
 * 提供执行 SQL 文件的静态方法。
 */
final class Sql extends Facade {

    /**
     * 执行 SQL 文件。
     * 
     * @param string $path: 文件名。
     */
    public static function execute($path, $data=null) {
        $text = file_get_contents($path);
        $code = preg_replace('/--.*?\n/', '', $text);
        // 文本替换
        if (isset($data) and is_array($data)) {
            $keys = array_keys($data);
            $values = array_values($data);
            $code = str_replace($keys, $values, $code);
        }
        $statements = array_filter(explode(';', $code));
        foreach ($statements as $statement) {
            $statement = trim($statement);
            if (empty($statement)) continue;
            \Db::execute($statement);
        }
    }
}