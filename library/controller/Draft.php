<?php namespace pluck\controller;

use pluck\model\Archive;

/**
 * 
 */
final class Draft extends Basic {
    /**
     * 
     */
    public function index() {
        $pagination = Archive::where([
            'status' => 'private'
        ])->paginate(4);
        return $this->fetch('archive/index', [
            'pagination' => $pagination
        ]);
    }

    /**
     * 
     */
    public function create() {
        return $this->fetch('archive/new');
    }

    /**
     * 
     */
    public function edit($id) {
        return $this->fetch('archive/edit', [
            'archive' => [
                'id' => $id
            ],
        ]);
    }

    public function trash() {
        return $this->fetch('archive/trash');
    }

    /**
     * 
     */
    public function interact() {
        $post = request()->post();
        if ('save' == $post['operation']) {
            $archive = new Archive([
                'title' => $post['title'],
                'content' => $post['content'],
                'status' => $post['status'],
            ]);
            $archive->save();
            return [
                'tip' => 'Ok',
                'id' => $archive->id,
                'content' => $post['content'],
            ];
        } elseif ('load' == $post['operation']) {

        }
    }
}