<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Contents;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\Galleries;
use App\Http\Livewire\Admin\PhotoSlides;
use App\Http\Livewire\Admin\Profile;
use App\Http\Livewire\Admin\Previews;
use App\Http\Livewire\Admin\Contacts;
use App\Http\Livewire\Admin\ProfilPersonal;
use App\Http\Livewire\Berita;
use App\Http\Livewire\Kontak;
use App\Http\Livewire\SantriMenulis;
use App\Http\Livewire\Posts;
use App\Http\Livewire\Gallery;
use App\Http\Livewire\PostsGallery;
use App\Http\Livewire\PostsSantri;
use App\Http\Livewire\PostsProfil;
use App\Http\Livewire\Home;
use App\Http\Controllers\CKEditorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//route root
Route::get('/', Home::class);
Route::get('/home', Home::class)->name('home');
Route::get('/beranda', Home::class)->name('beranda');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//route content hanya boleh diakses admin dan writer
Route::group(['middleware' => 'guards'], function() {

    Route::get('content', Contents::class)->name('content');
    Route::get('content/preview/{slug}', Previews::class);
    Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.image-upload');
});

//route user hanya boleh diakses admin
Route::group(['middleware' => 'admin'], function() {
        
    Route::get('user', Users::class)->name('user');
    Route::get('content/gallery', Galleries::class)->name('content-gallery');
    Route::get('content/profil', Profile::class)->name('content-profil');
    Route::get('content/photoslide', PhotoSlides::class)->name('content-photo-slide');
    Route::get('content/profil-personal', ProfilPersonal::class)->name('profil-personal');
    Route::get('message', Contacts::class)->name('message');
});

//route ini untuk menampilkan konten berita
Route::get('/berita', Berita::class)->name('berita');

//route ini untuk menampilkan konten berdasarkan slug
Route::get('/berita/{slug}', Posts::class);

//route ini untuk menampilkan konten berdasarkan slug
Route::get('/galeri', Gallery::class)->name('galeri');

//route ini untuk menampilkan konten berdasarkan slug
Route::get('/galeri/{slug}', PostsGallery::class);

//route ini untuk menampilkan kontak
Route::get('/kontak', Kontak::class)->name('kontak');

//route ini untuk menampilkan kontak
Route::get('/profil', PostsProfil::class)->name('profil');

//route ini untuk menampilkan konten santri
Route::get('/santri-menulis', SantriMenulis::class)->name('santri-menulis');

//route ini untuk menampilkan konten berdasarkan slug
Route::get('/santri-menulis/{slug}', PostsSantri::class);