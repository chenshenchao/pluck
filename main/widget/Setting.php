<?php namespace pluck\widget;

/**
 * 
 */
trait Setting {
    private $setting;

    /**
     * 设置值。
     * 
     * @param string $locator: 定位设置。
     * @param mixed $value: 设置的值。
     */
    public function set($locator, $value) {
        $target = &$this->setting;
        foreach (explode('.', $locator) as $key) {
            if (!key_exists($key, $target)) {
                $target[$key] = [];
            }
            $target = &$target[$key];
        }
        $target = $value;
    }
}