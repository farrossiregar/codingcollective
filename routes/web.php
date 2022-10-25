<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;

date_default_timezone_set("Asia/Bangkok");

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

Route::get('/', Home::class)->name('home')->middleware('auth');
Route::get('login', App\Http\Livewire\Login::class)->name('login');
Route::post('diskalert',function(){
    //send_wa(['phone'=>'081289992707','message'=>'Warning, Disk server alibaba penuh, silahkan cek']);
    send_wa(['phone'=>'087775365856','message'=>"Warning, Disk server alibaba penuh, silahkan cek"]);
});

Route::get('readerpdf',function(){
    // Parse PDF file and build necessary objects.
    $parser = new \Smalot\PdfParser\Parser();
    // $pdf = $parser->parseFile('/var/www/erp-pmt/public/sample-pdf.pdf');
    $pdf = $parser->parseFile('/var/www/erp-pmt/public/sample-pdf.pdf');

    $text = $pdf->getText();
    echo $text;

    // $data = $pdf->getPages()[0]->getDataTm();
    // $data = $pdf->getPages();
    // dd($data);
});

// All login
Route::group(['middleware' => ['auth']], function(){    
    Route::get('get-employees',function(){

        $results = \App\Models\Employee::orderBy('name','ASC');

        if(isset($_GET['search'])) $results->where('name','LIKE',"%{$_GET['search']}%")->orWhere('nik','LIKE',"%{$_GET['search']}%");

        $data = [];
        // $data['total_count'] = 10;
        // $data['items'] = [];
        foreach($results->paginate(10) as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['name'] = $item->nik .' / '.$item->name;
        }

        return response()->json($data);
    })->name('ajax.get-employees');

    Route::get('profile',App\Http\Livewire\Profile::class)->name('profile');
    Route::get('back-to-admin',[App\Http\Controllers\IndexController::class,'backtoadmin'])->name('back-to-admin');
    Route::get('setting',App\Http\Livewire\Setting::class)->name('setting');
    Route::get('users/insert',App\Http\Livewire\User\Insert::class)->name('users.insert');
    Route::get('user-access', App\Http\Livewire\UserAccess\Index::class)->name('user-access.index');
    Route::get('user-access/insert', App\Http\Livewire\UserAccess\Insert::class)->name('user-access.insert');
    Route::get('user-access/edit/{id}', App\Http\Livewire\UserAccess\Edit::class)->name('user-access.edit');
    Route::get('users',App\Http\Livewire\User\Index::class)->name('users.index');
    Route::get('users/edit/{id}',App\Http\Livewire\User\Edit::class)->name('users.edit');
    
});