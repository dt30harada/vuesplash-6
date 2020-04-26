<?php

if (Config::get('app.env') === 'dev') {
    Route::get('/phpinfo', fn() => phpinfo());
}

// 写真ダウンロード
Route::get('/photos/{photo}/download', 'PhotoController@download');

Route::get('/{any?}', fn() => view('index'))->where('any', '.+');
