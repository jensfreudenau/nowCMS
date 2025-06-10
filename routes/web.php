<?php

use App\Http\Controllers\BerlinerPhotoblogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueuesController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Content;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/blog', [FrontendController::class, 'index'])->name('blog');

Route::domain(config('domains.domain.berliner_photo_blog_domain'))->group(function () {
    Route::get('/', [BerlinerPhotoblogController::class, 'index']);
    Route::get('/', [BerlinerPhotoblogController::class, 'index']);
    Route::get('/archive', [MediaController::class, 'index']);
});

Route::domain('www.' . Config::get('domains.domain.berliner_photo_blog_domain'))->group(function () {
    Route::get('/', [BerlinerPhotoblogController::class, 'index']);
    Route::get('/', [BerlinerPhotoblogController::class, 'index']);
    Route::get('/archive', [MediaController::class, 'index']);
});

Route::domain(config('domains.domain.freude_foto_domain'))->group(function () {
    Route::get('/archive', [MediaController::class, 'index']);
});
Route::domain('www.' . config('domains.domain.freude_foto_domain'))->group(function () {
    Route::get('/archive', [MediaController::class, 'index']);
});

Route::domain(config('domains.domain.street_photo_blog_domain'))->group(function () {
    Route::get('/archive', [MediaController::class, 'streetphotoindex']);
});
Route::domain('www.' . config('domains.domain.street_photo_blog_domain'))->group(function () {
    Route::get('/archive', [MediaController::class, 'streetphotoindex']);
});
Route::domain(config('domains.domain.freude_now_blog_domain'))->group(function () {
    Route::get('/about', [FrontendController::class, 'about']);
});
Route::domain('www.' . config('domains.domain.freude_now_blog_domain'))->group(function () {
    Route::get('/about', [FrontendController::class, 'about']);
});


Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/{categoryId}', [CategoryController::class, 'get']);
Route::get('/getCategory/{categoryId}', [CategoryController::class, 'get']);
Route::get('/single/{slug}', [FrontendController::class, 'single']);
Route::get('/search', [FrontendController::class, 'search'])->name('search');

Route::feeds();
Route::get('/feed/atom', function () {
    return redirect('/feed', 303);
});
Route::get('/feed/rss', function () {
    return redirect('/feed', 303);
});
Route::get('/tag/{tagId}', [TagController::class, 'tag']);
Route::get('/tags/{tagId}', [TagController::class, 'tag']);
Route::get('/blog', [FrontendController::class, 'index'])->name('blog');
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/', [FrontendController::class, 'index'])->name('dashboard');
Route::get('/journey/{slug}', [JourneyController::class, 'show'])->name('journey.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/medias/{id}', [MediaController::class, 'getContent']);
    Route::post('/set_on_frontsite', [MediaController::class, 'setOnFrontsite']);
    Route::patch('/admintags/{tag}', [TagController::class, 'update'])->name('admintags.update');
    Route::get('/admintags/index', [TagController::class, 'index'])->name('admintags.index');
    Route::get('/admintags/display', [TagController::class, 'display'])->name('admintags.display');
    Route::get('/admintags/tags', [TagController::class, 'tags'])->name('admintags.tags');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::delete('contents/{content}', [ContentController::class, 'destroy'])->name('contents.destroy');
    Route::post('/contents/store', [ContentController::class, 'store'])->name('contents.store');
    Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');
    Route::get('/contents/create', [ContentController::class, 'create']);
    Route::get('contents/{id}', [ContentController::class, 'edit'])->name('contents.edit');
    Route::put('contents/{id}', [ContentController::class, 'update'])->name('contents.update');
    Route::patch('/contents/{content}', [ContentController::class, 'update']);
    Route::post('contents/storeMedia', [ContentController::class, 'storeMedia'])->name('contents.storeMedia');
    Route::post('contents/updateMedia', [ContentController::class, 'updateMedia'])->name('contents.updateMedia');
//    Route::post('contents/download', [ContentController::class, 'download'])->name('contents.download');
    Route::get('contents/download/{id}', [ContentController::class, 'download'])->name('contents.download');
    Route::delete('contents/deleteMedia/{media_id}', [ContentController::class, 'deleteMedia'])->name(
        'contents.deleteMedia'
    );

    Route::post('/media_upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::get('/adminmedia', [MediaController::class, 'adminmedia'])->name('adminmedia');
    Route::get('/media/edit', [MediaController::class, 'edit'])->name('media_edit');
    Route::put('/media', [MediaController::class, 'store'])->name('media_update');
    Route::get('/media/preview', [MediaController::class, 'preview'])->name('preview');

    //Route::get('/previews', [JourneyController::class, 'preview'])->name('preview');
    Route::post('/upload', [JourneyController::class, 'upload'])->name('upload');

    Route::get('/journey/admin/list', [JourneyController::class, 'index'])->name('journey.admin.list');
    Route::get('/journey/create', [JourneyController::class, 'create'])->name('journey.create');
    // Formular zum Bearbeiten (z. B. /journey/123/edit)
    Route::get('/journey/{id}/edit', [JourneyController::class, 'edit'])->where('id', '[0-9]+')->name('journey.edit');
    // Update-Request (z. B. per PUT/PATCH an /journey/123)
    Route::put('/journey/{id}', [JourneyController::class, 'update'])->where('id', '[0-9]+')->name('journey.update');
    Route::get('/journey/destroy', [JourneyController::class, 'destroy'])->name('journey.destroy');
    Route::get('/journey/{id}/edit', [JourneyController::class, 'edit'])->name('journey.edit');
    Route::put('/journey/{id}', [JourneyController::class, 'update'])->name('journey.update');
    Route::post('/journey/storeMedia', [JourneyController::class, 'storeMedia'])->name('journey.storeMedia');
    Route::post('/journey/updateMedia', [JourneyController::class, 'updateMedia'])->name('journey.updateMedia');
    Route::delete('/journey/deleteMedia/{media_id}', [JourneyController::class, 'deleteMedia'])->name('journey.deleteMedia');

    Route::get('dispatcher/startQueue', [DispatcherController::class, 'startQueue'])->name('dispatcher.start');
    Route::get('dispatcher/retryFailedJobs', [DispatcherController::class, 'retryFailedJobs'])->name(
        'dispatcher.retryFailedJobs'
    );
    Route::get('dispatcher/deleteFailedJobs', [DispatcherController::class, 'deleteFailedJobs'])->name(
        'dispatcher.deleteFailedJobs'
    );
    Route::get('dispatcher/countQueuedJobs', [DispatcherController::class, 'countQueuedJobs'])->name(
        'dispatcher.countQueuedJobs'
    );
    Route::get('dispatcher/countFailedJobs', [DispatcherController::class, 'countFailedJobs'])->name(
        'dispatcher.countFailedJobs'
    );
    Route::get('dispatcher/showJobs', [DispatcherController::class, 'showJobs'])->name('dispatcher.showJobs');
    Route::get('dispatcher/index', [DispatcherController::class, 'index'])->name('dispatcher.index');
    Route::get('dispatcher/generateGeoInforomations/{id}', [DispatcherController::class, 'generateGeoInforomations']
    )->name('dispatcher.generateGeoInforomations');

    Route::get('queues/list', [QueuesController::class, 'list'])->name('queues.list');

    Route::get('categories_admin', [CategoryController::class, 'admin_index'])->name('admin.categories');
    Route::get('categories/list', [CategoryController::class, 'list'])->name('categories.list');
    Route::get('categories/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
});


Route::fallback(function () {
    $path = request()->path();
    // Try to find a similar page
    $similarPage = Content::where('slug', 'like', '%' . Str::slug(Str::words($path, 1, '')) . '%')
        ->first();
    if ($similarPage) {
        return redirect()->to('/single/' . $similarPage->slug)
            ->with('message', 'The page you looked for was not found, but you might be interested in this.');
    }
    // Return custom 404 view with search functionality
    return redirect('/', 301);
});
require __DIR__ . '/auth.php';
