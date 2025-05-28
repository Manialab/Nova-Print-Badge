<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['nova'])
    ->get('/nova-vendor/maniaprintlab/print/{user_id}', function ($user_id) {
        // Pass parameters into your legacy index.php logic
        return view('maniaprintlab::printlab.index', [
            'userToken'   => $user_id,
        ]);
    })
    ->name('maniaprintlab.print');
