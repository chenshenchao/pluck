<?php namespace pluck\controller\resource;

use think\facade\Request;
use fi5e\facade\Mime;
use fi5e\facade\Path;
use pluck\controller\Basic;

/**
 * 
 */
final class Index extends Basic {
    /**
     * 
     */
    public function index() {
        return $this->fetch('resource/index');
    }

    /**
     * 
     */
    public function add() {
        return $this->fetch('resource/add');
    }

    /**
     * 
     */
    public function listing() {
        $locator = explode(',', Request::get('locator', '*'));
        $folder = Path::of('public', ...$locator);
        $files = array_map(function($path) use($locator) {
            $name = basename($path);
            $type = is_dir($path) ? 'folder' : 'file';
            $mime = Mime::getType($path);
            if (preg_match('/image/', $mime)) {
                $type = 'image';
            }
            $locator[count($locator) - 1] = $name;
            $locator[] = '*';
            return [
                'name' => $name,
                'mime' => $mime,
                'type' => $type,
                'locator' => join(',', $locator),
            ];
        }, array_filter(glob($folder), function($path) {
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            return 'php' != $extension;
        }));
        return $this->fetch('resource/listing',[
            'files' => $files,
        ]);
    }
}