<?php
Route::group(['middleware' => 'revalidate'], function () {
    Route::group(['namespace' => 'Site'], function () {
        Route::get('/', 'PageController@index')
            ->name('welcome');
        Route::get('/about-us', 'PageController@aboutUS')
            ->name('about_us');
        Route::get('/contact-us', 'PageController@contactUS')
            ->name('contact');
        //Job Offers List
        Route::get('/job-offers', 'JobController@jobProfiles')
            ->name('job.offers');
        //Auth
        Route::get('/joinus', 'AuthController@joinus')
            ->name('joinus');
        Route::post('/otp', 'AuthController@otp')
            ->name('otp');
        Route::post('/verifylogin', 'AuthController@verifyLogin')
            ->name('verifylogin');

        Route::middleware('auth')->group(function () {
            Route::post('/logout', 'AuthController@logout')
                ->name('logout');
            Route::get('/profile-update', 'ProfileController@profileUpdate')
                ->name('profile.update');
            Route::post('/profile-update', 'ProfileController@profileSave')
                ->name('profile.save');

            Route::middleware('is_complete')->group(function () {
                Route::get('/profile', 'ProfileController@profile')
                    ->name('profile');
                Route::post('/user-address', 'ProfileController@addressStore')
                    ->name('user.address.store');
                Route::delete('/address-destroy/{id}', 'ProfileController@removeAddress')
                    ->name('address.remove');

                Route::get('/products', 'OrderController@products')
                    ->name('products');
                Route::post('/add-to-cart', 'OrderController@addToCart')
                    ->name('job.cart.store');
                Route::get('/checkout_list', 'OrderController@checkoutList')
                    ->name('job.checkout.list');
                Route::delete('/destroy/{id}', 'OrderController@removeJob')
                    ->name('job.cart.destroy');
                Route::post('/job-place-order', 'OrderController@jobPlaceOrder')
                    ->name('job.cart.place');
                Route::get('/unpaid-invoices', 'OrderController@unPaidInvoice')
                    ->name('un.paid.invoice');
                Route::get('/paynow/{order_id}', 'OrderController@PayNow')
                    ->name('invoice.paynow');
                /*Autofeed */
                Route::get('/get_position', 'AutofeedController@getPosition')
                    ->name('get_position');
                Route::get('/get_package/{profile_id}', 'AutofeedController@getPackage')
                    ->name('get_package');
                Route::get('/get_states', 'AutofeedController@getState')
                    ->name('get_states');
                Route::get('/get_cities/{state_id}', 'AutofeedController@getCity')
                    ->name('get_cities');
                /* End Autofeed */
            });
        });
    });
    /**
     * @ Admin Routes Below
     */
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('/login', 'AuthController@index')
            ->name('admin.login');
        Route::post('/login', 'AuthController@doLogin')
            ->name('admin.dologin');
        Route::get('/', 'PageController@dashboard')
            ->name('admin.dashboard');

        Route::middleware(['role:admin|superadmin'])->group(function () {
            Route::post('/logout', 'AuthController@logout')
                ->name('admin.logout');
            Route::prefix('user')->group(function () {
                Route::get('/list/{type?}', 'UserController@index')
                    ->name('admin.users');
                Route::get('/create', 'UserController@create')
                    ->name('admin.user.create');
                Route::post('/store', 'UserController@store')
                    ->name('admin.user.store');
                Route::get('/show/{user_id}', 'UserController@show')
                    ->name('admin.user.show');
                Route::get('/{user_id}/edit', 'UserController@edit')
                    ->name('admin.user.edit');
                Route::patch('/{user_id}/update', 'UserController@update')
                    ->name('admin.user.update');
                Route::put('/change_status', 'UserController@change_status')
                    ->name('admin.user.change_status');
            });

            Route::prefix('role')->group(function () {
                Route::get('/list', 'RoleController@index')
                    ->name('admin.roles');
                Route::get('/create', 'RoleController@create')
                    ->name('role.create');
                Route::post('/store', 'RoleController@store')
                    ->name('role.store');
                Route::get('/{role_id}/edit', 'RoleController@edit')
                    ->name('role.edit');
                Route::patch('/{role_id}/update', 'RoleController@update')
                    ->name('role.update');
                Route::delete('/destroy/{role_id}', 'RoleController@destroy')
                    ->name('role.destroy');
            });

            Route::prefix('permission')->group(function () {
                Route::get('/list', 'PermissionController@index')
                    ->name('permissions');
                Route::get('/create', 'PermissionController@create')
                    ->name('permission.create');
                Route::post('/store', 'PermissionController@store')
                    ->name('permission.store');
                Route::get('/{permission_id}/edit', 'PermissionController@edit')
                    ->name('permission.edit');
                Route::patch('/{permission_id}/update', 'PermissionController@update')
                    ->name('permission.update');
                Route::delete('/destroy/{permission_id}', 'PermissionController@destroy')
                    ->name('permission.destroy');
            });

            Route::prefix('candidates')->group(function () {
                Route::get('/list', 'CandidateController@index')
                    ->name('admin.candidates');
                Route::get('/create', 'CandidateController@create')
                    ->name('admin.candidate.create');
                Route::post('/store', 'CandidateController@store')
                    ->name('admin.candidate.store');
                Route::get('/{id}/show', 'CandidateController@show')
                    ->name('admin.candidate.show');
                Route::get('/{id}/edit', 'CandidateController@edit')
                    ->name('admin.candidate.edit');
                Route::patch('/{id}/update', 'CandidateController@update')
                    ->name('admin.candidate.update');
                Route::delete('/destroy/{id}', 'CandidateController@destroy')
                    ->name('admin.candidate.destroy');
            });

            Route::prefix('country')->group(function () {
                Route::get('/list', 'CountryController@index')
                    ->name('admin.countries');
                Route::get('/create', 'CountryController@create')
                    ->name('admin.country.create');
                Route::post('/store', 'CountryController@store')
                    ->name('admin.country.store');
                Route::get('/{id}/edit', 'CountryController@edit')
                    ->name('admin.country.edit');
                Route::patch('/{id}/update', 'CountryController@update')
                    ->name('admin.country.update');
                Route::delete('/destroy/{id}', 'CountryController@destroy')
                    ->name('admin.country.destroy');
            });

            Route::prefix('state')->group(function () {
                Route::get('/list', 'StateController@index')
                    ->name('admin.states');
                Route::get('/create', 'StateController@create')
                    ->name('admin.state.create');
                Route::post('/store', 'StateController@store')
                    ->name('admin.state.store');
                Route::get('/{id}/edit', 'StateController@edit')
                    ->name('admin.state.edit');
                Route::patch('/{id}/update', 'StateController@update')
                    ->name('admin.state.update');
                Route::delete('/destroy/{id}', 'StateController@destroy')
                    ->name('admin.state.destroy');
            });

            Route::prefix('city')->group(function () {
                Route::get('/list', 'CityController@index')
                    ->name('admin.cities');
                Route::get('/create', 'CityController@create')
                    ->name('admin.city.create');
                Route::post('/store', 'CityController@store')
                    ->name('admin.city.store');
                Route::get('/{id}/edit', 'CityController@edit')
                    ->name('admin.city.edit');
                Route::patch('/{id}/update', 'CityController@update')
                    ->name('admin.city.update');
                Route::delete('/destroy/{id}', 'CityController@destroy')
                    ->name('admin.city.destroy');
            });

            Route::prefix('job-profiles')->group(function () {
                Route::get('/list/{type?}', 'JobProfileController@index')
                    ->name('admin.jobs');
                Route::get('/create', 'JobProfileController@create')
                    ->name('admin.job.create');
                Route::post('/store', 'JobProfileController@store')
                    ->name('admin.job.store');
                Route::get('/{id}/edit', 'JobProfileController@edit')
                    ->name('admin.job.edit');
                Route::patch('/{id}/update', 'JobProfileController@update')
                    ->name('admin.job.update');
                Route::delete('/destroy/{id}', 'JobProfileController@destroy')
                    ->name('admin.job.destroy');
                Route::get('/restore/{id}', 'JobProfileController@restore')
                    ->name('admin.job.restore');
                Route::get('/package-list/{id}', 'JobProfileController@getPackage')
                    ->name('admin.job.viewpackage');
            });

            Route::prefix('package')->group(function () {
                Route::get('/list/{type?}', 'PackageController@index')
                    ->name('admin.packages');
                Route::get('/create', 'PackageController@create')
                    ->name('admin.package.create');
                Route::post('/store', 'PackageController@store')
                    ->name('admin.package.store');
                Route::get('/{id}/edit', 'PackageController@edit')
                    ->name('admin.package.edit');
                Route::patch('/{id}/update', 'PackageController@update')
                    ->name('admin.package.update');
                Route::delete('/destroy/{id}', 'PackageController@destroy')
                    ->name('admin.package.destroy');
                Route::get('/destroy/{id}', 'PackageController@restore')
                    ->name('admin.package.restore');
            });

            Route::prefix('order')->group(function () {
                Route::get('/list', 'OrderController@index')
                    ->name('admin.orders');
                Route::delete('/destroy/{id}', 'OrderController@destroy')
                    ->name('admin.order.destroy');
                Route::get('/show/{id}', 'OrderController@show')
                    ->name('admin.order.show');
                Route::post('/status', 'OrderController@status')
                    ->name('admin.order.status');
            });

        });
    });
});
