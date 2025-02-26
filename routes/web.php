<?php

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
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


Route::domain(config('app.berliner_photo_blog_domain'))->group(function () {
    Route::get('/archive', [MediaController::class, 'index']);
});
Route::domain(config('app.freude_foto_domain'))->group(function () {
    Route::get('/archive', [MediaController::class, 'index']);
});

Route::domain(config('app.street_photo_blog_domain'))->group(function () {
    Route::get('/archive', [MediaController::class, 'streetphotoindex']);
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/{categoryId}', [CategoryController::class, 'get']);
Route::get('/getCategory/{categoryId}', [CategoryController::class, 'get']);
Route::get('/single/{slug}', [FrontendController::class, 'single']);
Route::get('/search', [FrontendController::class, 'search'])->name('search');
Route::get('/journeys', [JourneyController::class, 'journeys'])->name('journeys');
Route::feeds();
Route::get('/feed/atom', function () {
    return redirect('/feed', 303);
});
Route::get('/feed/rss', function () {
    return redirect('/feed', 303);
});

Route::middleware(['auth'])->group(function () {
//    Route::get('users/index', function () {
//        return view('admin/user.index', [
//            'users' => User::all()
//        ]);
//    });

    Route::patch('/tags/{tag}', [TagController::class, 'update'])->name('tag.update');
    Route::get('/tags/index', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/display', [TagController::class, 'display'])->name('tags.display');
    Route::get('/tags/tags', [TagController::class, 'tags'])->name('tag.tags');

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
    Route::post('journey/{slug}/edit', [JourneyController::class, 'update']);
    Route::resource('journey', JourneyController::class);
    Route::post('journey/storeMedia', [JourneyController::class, 'storeMedia'])->name('journey.storeMedia');
    Route::post('journey/updateMedia', [JourneyController::class, 'updateMedia'])->name('journey.updateMedia');
    Route::delete('journey/deleteMedia/{media_id}', [JourneyController::class, 'deleteMedia'])->name(
        'journey.deleteMedia'
    );

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
Route::get('/tag/{tagId}', [TagController::class, 'tag']);
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/', [FrontendController::class, 'index'])->name('dashboard');

Route::fallback(function () {
    $path = request()->path();
    // Try to find a similar page
    $similarPage = Content::where('slug', 'like', '%' . Str::slug(Str::words($path, 1, '')) . '%')
        ->first();
    if ($similarPage) {
        return redirect()->to('/single/' . $similarPage->slug)
            ->with('message', 'The page you looked for was not found, but you might be interested in this.');
    }
    // Log the miss
    Log::info(
        'Missing page: ' . $path . ' Request Url: ' . request()->getRequestUri() . ' Referer: ' . request(
        )->headers->get('referer')
    );
    // Return custom 404 view with search functionality
    return redirect('/', 301);
});
require __DIR__ . '/auth.php';
