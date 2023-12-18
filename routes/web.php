<?php

use App\Models\User;
use App\Models\Tutor;
use Spatie\Csp\AddCspHeaders;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PromoteController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InfoTutorController;
use App\Http\Controllers\recommendController;
use App\Http\Controllers\TutorAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FacebookChatController;
use App\Http\Controllers\TutorRegisterController;


use App\Http\Controllers\CourseRegisterController;
use App\Http\Controllers\Auth\TutorLoginController;

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


Auth::routes();


// ------------------------------------------------------User----------------------------------------------------------------------


// Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


// ยังไม่ได้ login
Route::group(['middleware' => 'no_user'], function () {
    Route::get('/', function () { })->name('nouserhome')
        ->uses([TutorController::class, 'nouserShowTutor']);
    // หน้าค้นหา tutors ทั้งหมด
    Route::match(array('GET', 'POST'),'/tutorsList', [TutorController::class, 'tutorsList'])->name('tutorsList');
    // หน้าดูประวัติติวเตอร์
    Route::get('/tutorDetails/{id}', [TutorController::class, 'TutorDetails'])->name('nouserTutorDetails');

    // หน้าคอร์สเมื่อไม่มีการล็อกอิน
    Route::get('/course', [CourseController::class, 'nouserCourseList'])->name('nouser.course');
    // หน้าดูรายละเอียดคอร์ส
    Route::get('/courseDetails/{id}', [CourseController::class, 'courseDetails'])->name('nouserCourseDetails');



});


// ล็อกอินแล้ว
// Route::get('/home', function () { })->name('home')
//     ->uses([HomeController::class, 'index']);


Route::get('/home', [HomeController::class, 'homereturn'])->name('homereturn');
Route::get('/home/{userId}', [HomeController::class, 'index'])->name('home');
Route::get('/recommend/{userId}', [recommendController::class, 'calculateCosineSimilarity']);


// -----------courses------------------------------------
Route::get('/courses', [CourseController::class, 'CoursesList'])->name('CoursesList');
Route::get('/courses_add', function () {
    return view('courses.add');

});
Route::get('/reviews', function () {
    return view('reviews.index');
});

Route::get('/profile', function () {
    return view('Profile.profile');
});
Route::resource('/reviews', ReviewsController::class);
//------ หน้า profile
Route::get('/profile/{id}', [UserController::class, 'index'])->name('user.profile');
Route::get('/history/{id}', [UserController::class, 'history'])->name('user.history');
Route::post('/profile/{id}', [UserController::class, 'uploadProfile'])->name('Profile.uploadProfile');

Route::post('/profile/useredit/{id}', [UserController::class, 'editProfile'])->name('Profile.editProfile');
// รายละเอียด คอร์สและติวเตอร์
Route::get('/tutor_details/{id}', [TutorController::class, 'userTutorDetails'])->name('userTutorDetails');
Route::post('/tutor_details/{id}', [CommentController::class, 'userComment'])->name('userComment');
Route::get('/course_Details/{id}', [CourseController::class, 'userCourseDetails'])->name('userCourseDetails');
Route::get('/tutorList', [TutorController::class, 'userTutorsList'])->name('userTutorsList');

Route::controller(CourseRegisterController::class)->prefix('course/register')->name('reg.')->group(function(){
    Route::match(array('GET', 'POST'),'register/{id}/new','index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::post('/save', 'save')->name('save');
    // Route::get('/edit/{UNID}', 'edit')->name('edit');
    // Route::post('/update','update')->name('update');
    // Route::post('/delete',  'delete')->name('delete');

});

Route::controller(CourseRegisterController::class)->prefix('approve/course')->name('reg.')->group(function(){
    Route::post('approve/docno',  'approve_docno')->name('approve.docno');
});

// --------userform matching-----------------
// Route::get('/userform', function () {
//     return view('Matching.index');
// });

// -------------------------------ฟอร์มเก็บข้อมูล--------------------------------------
Route::get('/userform', [MatchingController::class, 'userform'])->name('userform');
Route::post('/userform', [MatchingController::class, 'store'])->name('userform.store');
// ลอง
// Route::get('/userformtest', [MatchingController::class, 'userformtest'])->name('userformtest');


Route::get('/tutorform', [MatchingController::class, 'tutorform'])->name('tutorform');
Route::post('/tutorform', [MatchingController::class, 'tutorstore'])->name('tutorform.store');




// ------------------------------------------------------Admin----------------------------------------------------------------------

Route::get('admin', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::resource('admin/news', NewsController::class)->middleware('is_admin');
Route::resource('admin/tutors', TutorController::class)->middleware('is_admin');
Route::resource('admin/courses', PromoteController::class)->middleware('is_admin');

Route::get('admin/courses/edit/{id}', [PromoteController::class, 'CoursesEdit'])->name('admin.courses.edit')->middleware('is_admin');
Route::post('admin/courses/edit/{id}}', [PromoteController::class, 'CoursesUpdate'])->name('admin.courses.update')->middleware('is_admin');
Route::delete('admin/courses/edit/{id}}', [PromoteController::class, 'destroy'])->name('admin.courses.destroy')->middleware('is_admin');


Route::delete('/admin/tutors/{id}', [TutorController::class, 'destroy'])->name('softDeleteRoute')->middleware('is_admin');








// ------------------------------------------------------tutor----------------------------------------------------------------------
Route::prefix('tutor')->group(function () {
    Route::get('/', [TutorAuthController::class, 'showLoginForm'])->name('tutor.login');

    // Route::get('/login', [TutorAuthController::class, 'showLoginForm'])->name('tutor.login');
    Route::post('/login', [TutorAuthController::class, 'handlelogin'])->name('tutor.handleLogin');

    // Route::post('/login', [TutorAuthController::class, 'handlelogintest'])->name('tutor.handleLogin');

    Route::post('/logout', [TutorAuthController::class, 'logout'])->name('tutor.logout');
    Route::get('/register', [TutorAuthController::class, 'showRegistrationForm'])->name('tutor.registerPage');
    Route::post('/register', [TutorRegisterController::class, 'create'])->name('tutor.register');
});


Route::prefix('tutor')->middleware(['auth:tutor'])->group(function () {
    // Route::get('/home', [TutorController::class, 'dashboard'])->name('tutor.home');
    Route::get('/home', function () { })->name('tutor.home')
        ->uses([TutorController::class, 'indexTutor']);
    Route::get('/profile/{id}', [TutorController::class, 'profile'])->name('tutor.profile');
    Route::post('/profile/{id}', [TutorController::class, 'uploadProfile'])->name('tutor.profile.upload');
    Route::post('/profile/edit/{id}', [TutorController::class, 'editprofile'])->name('tutor.edit.profile');
    Route::get('/promoteTutor', [TutorController::class, 'promote'])->name('tutor.promote');
    Route::get('/mycourses/{id}', [CourseController::class, 'mycourses'])->name('tutor.mycourse');
    Route::get('/mycourses/{id}/register', [CourseController::class, 'mycoursesregister'])->name('tutor.mycourse.register');
    Route::get('/mycourses/detail/{id}', [CourseController::class, 'mycoursesdetail'])->name('tutor.mycourse.detail');
    Route::post('/mycourses/detail/{id}', [CourseController::class, 'mycoursesdetailupdate'])->name('tutor.mycourse.update');

    Route::get('/feedback/{id}', [CommentController::class, 'feedback'])->name('feedback');
    Route::get('/course', [CourseController::class, 'tutorCourseList'])->name('tutor.courseList');
    Route::get('/tutorLists', [TutorController::class, 'tutorTutorsList'])->name('tutorTutorsList');
    Route::get('/add_course', [CourseController::class, 'addCourseForm'])->name('tutor.addCourseForm');
    Route::post('/add_course', [CourseController::class, 'addCourse'])->name('tutor.addCourse');
    Route::get('/tutors_details/{id}', [TutorController::class, 'tutorTutorDetails'])->name('tutorDetails');
    Route::get('/courses_Details/{id}', [CourseController::class, 'tutorCourseDetails'])->name('tutorCourseDetails');
});



//------------------------------matching------------------------------------------------------



// ----------------------------------------ลอง------------------------------------------






// Route::get('/recommend-tutors/{userId}', [recommendController::class, 'recommendTutorsToUser'])->name('recommend.tutors');


// Route::get('/test/{userId}', [recommendController::class, 'recommendTutors']);














// /////////////////////////////





Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments/{comment}/destroy', [CommentController::class, 'destroy'])->name('comments.destroy');

// Route::middleware(['auth'])->group(function () {
//     Route::delete('/comments/{id}', 'CommentController@destroy');
// });



Route::get('/comments/{comment}/data', [CommentController::class, 'getcommentid'])->name('comments.data');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
//Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::post('/comments/update', [CommentController::class, 'update'])->name('comments.update');

Route::delete('/courses/{course}/delete', 'CourseController@delete')->name('courses.delete');

// Route::get('/comments/{comment}/edit', 'CommentController@edit')->name('comments.edit');
// Route::put('/comments/{comment}', 'CommentController@update')->name('comments.update');


// Route::controller(ImageslideController::class)->prefix('comments')->name('comments.')->group(function(){


//     Route::get('/imageslide','index')->name('index');
//     Route::get('/imageslide/add','add')->name('add');
//     Route::post('/imageslide/store','store')->name('store');
//     Route::post('/imageslide/delete','delete')->name('delete');
//     Route::get('/imageslide/edit/{id}','edit')->name('edit');
//     Route::post('/imageslide/update','update')->name('update');

// });
