<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('panel')->name('panel.')->middleware('verified')->group(function () {
    Route::model('users', 'User');
    //Route::get('users/lists', 'UsersController@list')->name('users.lists');
    Route::bind('user', function ($user) {
        return User::withTrashed()->where('username', 'LIKE', $user)->first();
        //return User::withTrashed()->find($user);
    });
    Route::resource('users', 'UsersController');
});
