<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PagesControllers\HomePageController;
use App\Http\Controllers\PagesControllers\SermonsPageController;
use App\Http\Controllers\PagesControllers\MinistriesPageController;
use App\Http\Controllers\PagesControllers\InvolvementPageController;
use App\Http\Controllers\PagesControllers\AboutPageController;
use App\Http\Controllers\PagesControllers\EventsPageController;
use App\Http\Controllers\PagesControllers\DonationPageController;
use App\Http\Controllers\PagesControllers\ContactPageController;
use App\Http\Controllers\PagesControllers\TestimonialsPageController;
use App\Http\Controllers\PagesControllers\GalleryPageController;


use App\Http\Controllers\AdminPagesControllers\VisitorsController;
use App\Http\Controllers\AdminPagesControllers\ActivitiesController;
use App\Http\Controllers\AdminPagesControllers\ProjectsController;
use App\Http\Controllers\AdminPagesControllers\EventsController;
use App\Http\Controllers\AdminPagesControllers\DonationsController;

use App\Http\Controllers\AdminPagesControllers\TestimonialsController;
use App\Http\Controllers\AdminPagesControllers\SlidersController;
use App\Http\Controllers\AdminPagesControllers\LogosController;
use App\Http\Controllers\AdminPagesControllers\PartnersController;
use App\Http\Controllers\AdminPagesControllers\SocialmediaController;
use App\Http\Controllers\AdminPagesControllers\AboutController;
use App\Http\Controllers\AdminPagesControllers\ContactsetupController;
use App\Http\Controllers\AdminPagesControllers\ContactsController;
use App\Http\Controllers\AdminPagesControllers\ChangepasswordController;
use App\Http\Controllers\AdminPagesControllers\AdminsController;
use App\Http\Controllers\AdminPagesControllers\SearchengineController;
use App\Http\Controllers\AdminPagesControllers\GalleryController;


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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    $exitCode = Artisan::call('storage:link', [] );
echo $exitCode; // 0 exit code for no errors.
});






Route::get('/', [HomePageController::class, 'Index'])->name('home');

Route::get('/sermons', [SermonsPageController::class, 'Index'])->name('sermons');
Route::get('/sermon/{id}/{title}', [SermonsPageController::class, 'SermonDetails'])->name('sermon');

Route::get('/ministries', [MinistriesPageController::class, 'Index'])->name('ministries');
Route::get('/ministry/{id}/{title}', [MinistriesPageController::class, 'MinistryDetails'])->name('ministry');


Route::get('/involvements', [InvolvementPageController::class, 'Index'])->name('involvements');
Route::get('/involvement/{id}/{title}', [InvolvementPageController::class, 'InvolvementDetails'])->name('involvement');


Route::get('/events', [EventsPageController::class, 'Index'])->name('events');
Route::get('/event/{id}/{title}', [EventsPageController::class, 'EventDetails'])->name('event');


Route::get('/about', [AboutPageController::class, 'Index'])->name('about-us');

Route::get('/donate', [DonationPageController::class, 'Index'])->name('donate');


Route::get('/testimonials', [TestimonialsPageController::class, 'Index'])->name('client-says');
Route::post('post-testimonial', [TestimonialsPageController::class, 'postUserTestimonial'])->name('userTestimonial.post');

Route::resource('gallery',GalleryPageController::class);

Route::get('/contactus', [ContactPageController::class, 'Index'])->name('contact-us');
Route::post('post-contactmessage-creation', [ContactPageController::class, 'postUserContactMessage'])->name('usercontactmessage.post');
Route::post('post-booking-creation', [SafarisPackagesPageController::class, 'PostUserBooking'])->name('userbooking.post');

//Route::get('/services/{name}', [ServicesPageController::class, 'Index'])->name('services');
//Route::get('areasserved',[AreasPageController::class, 'Index'])->name('areas-served');

//show admin login form
Route::get('/admin', [AuthController::class, 'ShowAdminLogin'])->name('adminlogin');
//submit login form
Route::post('post-adminlogin', [AuthController::class, 'postAdminLogin'])->name('adminlogin.post'); 







Route::name('')->middleware('visitor')->group(function() {
    
Route::get('/', [HomePageController::class, 'Index'])->name('home');
Route::get('/about', [AboutPageController::class, 'Index'])->name('about-us');
Route::get('/donate', [DonationPageController::class, 'Index'])->name('donate');
Route::get('/programmes', [ActivitiesPageController::class, 'Index'])->name('programmes');
Route::get('/programme/{id}/{title}', [ActivitiesPageController::class, 'ProgrammeDetails'])->name('programme');
Route::get('/projects', [ProjectsPageController::class, 'Index'])->name('projects');
Route::get('/project/{id}/{title}', [ProjectsPageController::class, 'ProjectDetails'])->name('project');
Route::get('/events', [EventsPageController::class, 'Index'])->name('events');
Route::get('/event/{id}/{title}', [EventsPageController::class, 'EventDetails'])->name('event');
//Route::get('/service/{name}', [ServicesPageController::class, 'Index'])->name('service');
//Route::get('areasserved',[AreasPageController::class, 'Index'])->name('areas-served');
Route::get('/testimonials', [TestimonialsPageController::class, 'Index'])->name('testimonials');
Route::get('/contactus', [ContactPageController::class, 'Index'])->name('contact-us');
Route::resource('gallery',GalleryPageController::class);
    });





//admin pages
Auth::routes();

Route::resource('manage-visitors',VisitorsController::class);


Route::resource('manage-programmes',ActivitiesController::class);
Route::resource('manage-projects',ProjectsController::class);
Route::resource('manage-events',EventsController::class);
Route::resource('manage-donations',DonationsController::class);
Route::get('users-donations', [DonationsController::class,'UsersDonations']);
Route::get('update-donationstatus/{id}', [DonationsController::class,'Update_donationstatus']);




Route::resource('manage-testimonials',TestimonialsController::class);
Route::get('update-testimonialstatus/{id}', [TestimonialsController::class,'update_testimoniastatus']);

Route::resource('manage-sliders',SlidersController::class);

Route::resource('manage-seo',SearchengineController::class);
Route::resource('manage-logos',LogosController::class);

Route::resource('manage-partnerlogos',PartnersController::class);

Route::resource('manage-socialmedia',SocialmediaController::class);

Route::resource('manage-about',AboutController::class);

//Route::resource('manage-services',ServicesController::class);

//Route::resource('manage-areasserved',AreasservedController::class);



Route::resource('manage-contact-setup',ContactsetupController::class);

Route::resource('manage-contacts',ContactsController::class);

Route::resource('manage-seo',SearchengineController::class);


Route::resource('manage-gallery',GalleryController::class);

Route::resource('manage-changepassword',ChangepasswordController::class);
Route::resource('manage-admins',AdminsController::class);
Route::get('/manage-logout', [AuthController::class, 'Logout'])->name('logout');


//for preventing back button after logout
Route::group(['middleware' => 'prevent-back-history'],function(){
    Auth::routes();
Route::resource('manage-testimonials',TestimonialsController::class);
Route::get('update-testimonialstatus/{id}', [TestimonialsController::class,'update_testimoniastatus']);
Route::resource('manage-sliders',SlidersController::class);
Route::resource('manage-logos',LogosController::class);
Route::resource('manage-socialmedia',SocialmediaController::class);
Route::resource('manage-about',AboutController::class);

Route::resource('manage-visitors',VisitorsController::class);


Route::resource('manage-programmes',ActivitiesController::class);
Route::resource('manage-projects',ProjectsController::class);
Route::resource('manage-events',EventsController::class);
Route::resource('manage-donations',DonationsController::class);
Route::get('users-donations', [DonationsController::class,'UsersDonations']);
Route::get('update-donationstatus/{id}', [DonationsController::class,'Update_donationstatus']);
//Route::resource('manage-services',ServicesController::class);

Route::resource('manage-contact-setup',ContactsetupController::class);
Route::resource('manage-contacts',ContactsController::class);
Route::resource('manage-seo',SearchengineController::class);

//Route::resource('manage-areasserved',AreasservedController::class);
Route::resource('manage-gallery',GalleryController::class);

Route::resource('manage-changepassword',ChangepasswordController::class);
Route::resource('manage-admins',AdminsController::class);
Route::get('/manage-logout', [AuthController::class, 'Logout'])->name('logout');


/////////////////////////for clients or guests users ///////////



});


