<?php

use App\Usrs;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Carbon;

Route::get('/', function () {
    //return Inertia::render('Dashboard');
    return Inertia::render('DashboardTemplate');
})->name('login');

Auth::routes();
Route::resource('programa', 'MO113\ME1\SM3\PrincipalController');
Route::resource('pruebas', 'PruebaController');

Route::get('/otro', function () {
    //return \DB::table('informix.accpo')->get();
    // $data = \DB::table('informix.accpo')->create([
    //     'accpoccic' => 2
    // ]);

    // Usrs::create([
    //     'accpoccic' => 3,
    //     'accponact' => 5
    // ]);

    //return \DB::table('informix.adusr')->where('adusrusrn', 'SUP')->get();
    //return \DB::table('informix.adusr')->where('adusrusrn', 'SUP')->update(['adusrcula' => '111111']);

    // return Usrs::paginate(10);
    return \DB::select('select * from informix.vadmcs');
});