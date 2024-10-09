<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ici vous pouvez enregistrer toutes les routes de votre application web.
| Ces routes sont chargées par le RouteServiceProvider au sein d'un groupe
| qui contient le groupe de middleware "web". Créez quelque chose de génial !
|
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes d'authentification
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Inscription et vérification de l'email
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/email/verify', [VerifyEmailController::class, '__invoke'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Réinitialisation du mot de passe
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Profil utilisateur
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
});

// Routes pour l'administration, protégées par le middleware admin
Route::middleware(['role:admin'])->group(function () {
    // Tableau de bord administrateur
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Gestion des utilisateurs
    Route::resource('users', UserController::class);

    // Gestion des projets
    Route::resource('projects', ProjectController::class);

    // Gestion des services
    Route::resource('services', ServiceController::class);

    // Gestion des témoignages
    Route::resource('testimonials', TestimonialController::class);
});

// Route pour la page de contact et l'envoi du formulaire de contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
