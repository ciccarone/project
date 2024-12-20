<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Models\UserMeta;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ReferralController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $userMeta = UserMeta::where('user_id', $user->id)->first();

    return view('dashboard', compact('user', 'userMeta'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search', [BusinessController::class, 'search'])->name('search');

Route::get('/business/{slug}', [BusinessController::class, 'show'])->name('business.show');

Route::post('/referrals', [ReferralController::class, 'store'])->name('referrals.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        $user = Auth::user();
        $userMeta = $user->userMeta;

        return view('profile.edit', compact('user', 'userMeta'));
    })->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/update-chamber', [ProfileController::class, 'updateChamber'])->name('profile.updateChamber');

    Route::post('/profile/update-group', [ProfileController::class, 'updateGroup'])->name('profile.updateGroup');

    Route::get('/business/names', [BusinessController::class, 'getBusinessNames']);

    Route::patch('/business', [BusinessController::class, 'update'])->name('business.update');
    Route::post('/businesses', [BusinessController::class, 'store'])->name('business.store');
    Route::put('/businesses/update', [BusinessController::class, 'update'])->name('businesses.update');
    Route::post('/business', [BusinessController::class, 'store'])->name('business.store');


});





require __DIR__.'/auth.php';
