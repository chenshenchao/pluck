<?php
Route::group('pluck', function() {
    Route::get(':page$', 'pluck\controller\Index@:page')
        ->name('pluck-page')
        ->ext('html');
    Route::post(':action$', 'pluck\controller\Reply@:action')
        ->name('pluck-action')
        ->ext('');
    // 管理员
    Route::group('administrator', function() {
        $a = Route::get(':page$', 'pluck\controller\administrator\Index@:page')
            ->name('pluck-administrator-page')
            ->ext('html');
        Route::post(':action$', 'pluck\controller\administrator\Reply@:action')
            ->name('pluck-administrator-action')
            ->ext('');
    })->before(function() {

    });
});