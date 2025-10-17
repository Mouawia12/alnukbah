<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//
// 🔐 مصادقة المشرف
//
Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

//
// 🌐 واجهة الموقع العامة
//
Route::get('/', 'App\Http\Controllers\Controller@index')->name('/');
Route::get('/contact', 'App\Http\Controllers\Controller@contact')->name('contact');
Route::get('/articles', 'App\Http\Controllers\Controller@articles')->name('articles');
Route::post('/contacts/send', 'App\Http\Controllers\Controller@contactsend')->name('contacts.send');
Route::get('/article/{id}', 'App\Http\Controllers\Controller@article')->name('article');
Route::get('/service/{id}', 'App\Http\Controllers\Controller@service')->name('service');
Route::get('/subservice/{id}', 'App\Http\Controllers\Controller@subservice')->name('subservice');
Route::get('/work/{id}', 'App\Http\Controllers\Controller@work')->name('work');
Route::post('/subscribe', 'App\Http\Controllers\Controller@subscribe')->name('subscribe');

//
// 🛠️ لوحة التحكم (Admin Panel)
//
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        // 🏠 Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // 📰 المقالات
        Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
        Route::post('/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
        Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('admin.articles.update');
        Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');

        // 🖼️ معرض الصور
        // Sliders (admin.sliders.*)
        Route::get('/sliders', [SliderController::class, 'index'])->name('admin.sliders.index');
        Route::get('/sliders/create', [SliderController::class, 'create'])->name('admin.sliders.create');
        Route::post('/sliders', [SliderController::class, 'store'])->name('admin.sliders.store');
        Route::delete('/sliders/{slider}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');


        // 🧱 الخدمات
        Route::get('/services', [ServiceController::class, 'index'])->name('admin.services.index');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
        Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

        // 📊 الإحصائيات
        Route::get('/statistics', [StatisticController::class, 'index'])->name('admin.statistics.index');
        Route::get('/statistics/create', [StatisticController::class, 'create'])->name('admin.statistics.create');
        Route::post('/statistics', [StatisticController::class, 'store'])->name('admin.statistics.store');
        Route::get('/statistics/{id}/edit', [StatisticController::class, 'edit'])->name('admin.statistics.edit');
        Route::put('/statistics/{id}', [StatisticController::class, 'update'])->name('admin.statistics.update');
        Route::delete('/statistics/{id}', [StatisticController::class, 'destroy'])->name('admin.statistics.destroy');

        // 📬 الاشتراكات
        Route::get('/subscribes', [SubscribeController::class, 'index'])->name('admin.subscribes.index');
        Route::delete('/subscribes/{id}', [SubscribeController::class, 'destroy'])->name('admin.subscribes.destroy');

        // 📞 رسائل التواصل
        Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
        Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');
        Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

        // ⚙️ الإعدادات
        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');

        // 🏢 حول الشركة
        Route::get('/abouts', [AboutController::class, 'index'])->name('admin.abouts.index');
        Route::get('/abouts/edit', [AboutController::class, 'edit'])->name('admin.abouts.edit');
        Route::put('/abouts/update', [AboutController::class, 'update'])->name('admin.abouts.update');

        // 🧱 الأعمال
        Route::get('/works', [WorkController::class, 'index'])->name('admin.works.index');
        Route::get('/works/create', [WorkController::class, 'create'])->name('admin.works.create');
        Route::post('/works', [WorkController::class, 'store'])->name('admin.works.store');
        Route::get('/works/{id}/edit', [WorkController::class, 'edit'])->name('admin.works.edit');
        Route::put('/works/{id}', [WorkController::class, 'update'])->name('admin.works.update');
        Route::delete('/works/{id}', [WorkController::class, 'destroy'])->name('admin.works.destroy');

        // 👤 المستخدمون
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    });
