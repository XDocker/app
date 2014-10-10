<?php

Route::get(Config::get('laravel-newsletter-signup::uri'), function() {
	return View::make(Config::get('laravel-newsletter-signup::view'));
});

Route::post(Config::get('laravel-newsletter-signup::uri'), array(
	'before' => 'csrf',
	'uses' => 'Fbf\LaravelNewsletterSignup\SignupsController@store'
));

Route::delete(Config::get('laravel-newsletter-signup::uri'), array(
	'before' => 'csrf',
	'uses' => 'Fbf\LaravelNewsletterSignup\SignupsController@delete'
));