<?php

use manchenkov\yii\http\routing\Route;

return Route::group('{{module}}')->routes([

    Route::get('/', 'main/index'),
    
    // module routes config should be here ...

]);