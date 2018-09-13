<?php


Route::group(['prefix' => 'v1'], function () {
    Route::get('teams/{limit}/{offset}', 'TeamController@index');
    Route::get('teams/{id}', 'TeamController@show');
    Route::post('teams', 'TeamController@store');
    Route::put('teams/{id}', 'TeamController@update');
    Route::delete('teams/{id}', 'TeamController@delete');

    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
    Route::post('users', 'UserController@store');
    Route::post('user/teams/{user_id}', 'UserController@storeUserTeam');
    Route::post('user/teamOwner/{user_id}', 'UserController@SetTeamOwner');
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@delete');

    Route::get('roles', 'RoleController@index');
    Route::get('roles/{id}', 'RoleController@show');
    Route::post('roles', 'RoleController@store');
    Route::post('roles/user/{user_id}', 'RoleController@storeUserRole');
    Route::put('roles/{id}', 'RoleController@update');
    Route::delete('roles/{id}', 'RoleController@delete');

});