<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::get('chart/{uft}','ChartController@makeChart');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('agents', 'Admin\AgentsController');
    Route::post('agents_mass_destroy', ['uses' => 'Admin\AgentsController@massDestroy', 'as' => 'agents.mass_destroy']);
    Route::resource('well_wishers', 'Admin\WellWishersController');
    Route::post('well_wishers_mass_destroy', ['uses' => 'Admin\WellWishersController@massDestroy', 'as' => 'well_wishers.mass_destroy']);
    Route::resource('agent_head_payment', 'Admin\AgentHeadPaymentController');
    Route::post('agent_head_payment_mass_destroy', ['uses' => 'Admin\AgentHeadPaymentController@massDestroy', 'as' => 'agent_head_payment.mass_destroy']);
    Route::resource('agent_payments', 'Admin\AgentPaymentController');
    Route::post('agent_payments_mass_destroy', ['uses' => 'Admin\AgentPaymentController@massDestroy', 'as' => 'agent_payments.mass_destroy']);
    Route::resource('districts', 'Admin\DistrictsController');
    Route::post('districts_mass_destroy', ['uses' => 'Admin\DistrictsController@massDestroy', 'as' => 'districts.mass_destroy']);
    Route::post('districts_restore/{id}', ['uses' => 'Admin\DistrictsController@restore', 'as' => 'districts.restore']);
    Route::delete('districts_perma_del/{id}', ['uses' => 'Admin\DistrictsController@perma_del', 'as' => 'districts.perma_del']);
    Route::resource('members', 'Admin\MembersController');
    Route::post('members_mass_destroy', ['uses' => 'Admin\MembersController@massDestroy', 'as' => 'members.mass_destroy']);
    Route::post('members_restore/{id}', ['uses' => 'Admin\MembersController@restore', 'as' => 'members.restore']);
    Route::delete('members_perma_del/{id}', ['uses' => 'Admin\MembersController@perma_del', 'as' => 'members.perma_del']);
    Route::resource('tresuaries', 'Admin\TresuariesController');
    Route::post('tresuaries_mass_destroy', ['uses' => 'Admin\TresuariesController@massDestroy', 'as' => 'tresuaries.mass_destroy']);
    Route::post('tresuaries_restore/{id}', ['uses' => 'Admin\TresuariesController@restore', 'as' => 'tresuaries.restore']);
    Route::delete('tresuaries_perma_del/{id}', ['uses' => 'Admin\TresuariesController@perma_del', 'as' => 'tresuaries.perma_del']);
    Route::resource('admin_payments', 'Admin\AdminPaymentsController');
    Route::post('admin_payments_mass_destroy', ['uses' => 'Admin\AdminPaymentsController@massDestroy', 'as' => 'admin_payments.mass_destroy']);
    Route::post('admin_payments_restore/{id}', ['uses' => 'Admin\AdminPaymentsController@restore', 'as' => 'admin_payments.restore']);
    Route::delete('admin_payments_perma_del/{id}', ['uses' => 'Admin\AdminPaymentsController@perma_del', 'as' => 'admin_payments.perma_del']);
    Route::resource('uft_charts', 'Admin\UftChartsController');
    Route::post('uft_charts_mass_destroy', ['uses' => 'Admin\UftChartsController@massDestroy', 'as' => 'uft_charts.mass_destroy']);
    Route::post('uft_charts_restore/{id}', ['uses' => 'Admin\UftChartsController@restore', 'as' => 'uft_charts.restore']);
    Route::delete('uft_charts_perma_del/{id}', ['uses' => 'Admin\UftChartsController@perma_del', 'as' => 'uft_charts.perma_del']);
  


 
});
