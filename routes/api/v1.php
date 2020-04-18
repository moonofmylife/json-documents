<?php

Route::apiResource('documents', 'DocumentsController')
    ->except('destroy');
Route::post('documents/{document}/publish', 'DocumentsController@publish')
    ->name('documents.publish');
