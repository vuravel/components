<?php

Route::middleware('web')->group(function(){

	Route::view('/', 'vuravel::welcome')->name('home');

	Route::get('vuravel/keep-alive', function(){
		return response(null, 204);
	})->name('vuravel.keep-alive');

	/**
	 * User clicks on a locale choice
	 */
	Route::get('set-locale/{locale?}', function ( $locale = 'en' ) {
	    
	    if(!array_key_exists($locale, config('vuravel.locales') )) 
	    	$locale = config('app.locale');

	    /**
		 * The preference is saved in cookie
		 */
	    \Cookie::queue('locale', $locale);
	    
	    return redirect()->back();
	
	})->name('setLocale');

});