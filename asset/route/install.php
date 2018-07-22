<?php
Route::group('install', function() {
    Route::get('$', 'pluck\controller\setup\Index@index');
    Route::get(':i$', 'pluck\controller\setup\Index@step', [], ['i' => '[1]']);
    Route::post('$', 'pluck\controller\setup\Reply@install');
});