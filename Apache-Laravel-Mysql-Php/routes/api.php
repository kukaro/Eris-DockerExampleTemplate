<?php

Route::group([
    'prefix' => 'v1',
    'middleware' => ['hiworks-auth']
],function () {
    Route::get('/categories', 'CategoryController@loadOfficeCategories');
    Route::get('/categories/user', 'CategoryController@loadOfficeUserCategories');

    Route::post('/categories/bookmark', 'CategoryController@createOfficeCategoryBookmark')->middleware('check-is-admin');
    Route::post('/categories/user/bookmark', 'CategoryController@createOfficeUserCategoryBookmark');

    Route::post('/categories', 'CategoryController@createOfficeCategory')->middleware('check-is-admin');
    Route::post('/categories/user', 'CategoryController@createOfficeUserCategory');

    Route::put('/categories/name', 'CategoryController@modifyOfficeCategoryName')->middleware('check-is-admin');
    Route::put('/categories/user/name', 'CategoryController@modifyOfficeUserCategoryName');

    Route::put('/categories/bookmark', 'CategoryController@modifyOfficeBookmark')->middleware('check-is-admin');
    Route::put('/categories/user/bookmark', 'CategoryController@modifyOfficeUserBookmarkNameAndUrl');

    Route::put('/categories/move', 'CategoryController@moveOfficeCategory')->middleware('check-is-admin');
    Route::put('/categories/user/move', 'CategoryController@moveOfficeUserCategory');

    Route::delete('/categories', 'CategoryController@deleteOfficeCategory')->middleware('check-is-admin');
    Route::delete('/categories/user', 'CategoryController@deleteOfficeUserCategory');
});
