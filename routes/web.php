<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\MobiliteController;
use App\Http\Controllers\AdminController;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
// Main route
Route::get('/', function () {
    return view('welcome'); 
});


require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/dashboard/description', function (Request $request) {
    $description = $request->input('description');
    // Ici, vous pouvez sauvegarder la description dans la base de données
        // Validation des données
        $request->validate([
            'description' => 'required|string|max:5000',
        ]);
    
        // Mise à jour de l'utilisateur connecté
        $user = Auth::user();
        $user->description = $request->description;
        $user->save();
    return back()->with('status', 'Description enregistrée avec succès !');
})->name('dashboard.description')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/mobilite', [MobiliteController::class, 'index'])->name('mobilite.index');
    Route::get('/mobilite/create', [MobiliteController::class, 'create'])->name('mobilite.create');
    Route::post('/mobilite', [MobiliteController::class, 'store'])->name('mobilite.store');
    Route::get('/mobilite/{mobilite}/edit', [MobiliteController::class, 'edit'])->name('mobilite.edit');
    Route::put('/mobilite/{mobilite}', [MobiliteController::class, 'update'])->name('mobilite.update');
    Route::delete('/mobilite/{mobilite}', [MobiliteController::class, 'destroy'])->name('mobilite.destroy');
});
Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });
});


Route::fallback(function () {
    return  view('page404');
});

