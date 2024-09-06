 <?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomPageController;

Route::get('about-us', [CustomPageController::class, 'about'])->name('about-us'); 
