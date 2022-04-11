<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','Frontend\FrontendController@homePage')->name('homepage');
/** frontend route **/
Route::get('/featured','Backend\FeaturedController@getFeaturedPosts')->name('featured');
Route::get('/popular','Backend\PopularController@getPopularPosts')->name('popular');
Route::get('/hotnews','Backend\HotNewsController@getHotNewsPosts')->name('hotnews');
Route::get('/trending','Backend\PostController@getTrendingPosts')->name('trending');
Route::get('/mostwatch','Backend\HotNewsController@getWatchPosts')->name('watch');

Route::get('/about','Frontend\FrontendController@aboutus')->name('about-us');
Route::get('/contact','Frontend\FrontendController@contactus')->name('contact-us');
Route::get('/blogs','Frontend\FrontendController@blog')->name('blog');
Route::get('/terms-and-condition','Frontend\FrontendController@terms')->name('terms');
Route::get('/privacy-policy','Frontend\FrontendController@privacy')->name('privacy');
Route::get('/blog-detail/{id}', 'Frontend\FrontendController@blogDetail')->name('blog-detail');
Route::get('/post-detail/{id}', 'Frontend\FrontendController@postDetail')->name('post-detail');
Route::get('/galleries','Frontend\FrontendController@gallery')->name('gallery');
Route::get('/gallery-detail/{id}', 'Frontend\FrontendController@galleryDetail')->name('gallery-detail');
Route::get('/categoryPost/{id}', 'Frontend\FrontendController@categoryPost')->name('cat-post');
Route::get('/subcategoryPost/{id}', 'Frontend\FrontendController@childPost')->name('childcat-post');
Route::get('/contributors','Frontend\FrontendController@contributor')->name('contributors');
Route::get('/contributors/{id}/','Frontend\FrontendController@contributorDetail')->name('contributor-detail');

Route::get('/search', 'Backend\PostController@search')->name('search');

Route::post('/post-detail/{id}/review', 'Backend\PostController@submitReview')->name('submit-review');
Route::post('/subscribe', 'Backend\SubscriberController@subscribe')->name('subscribe');
// Route::post('/contact/support', 'Backend\SupportController@submit')->name('submit-support');

Route::resource('support', 'Backend\SupportController');
Route::resource('newssignup', 'Frontend\NewsSignupController');

Route::post('advertise/visit', 'Backend\AdvertiseController@adsvisit')->name('ads_count');
Route::get('/media','Frontend\FrontendController@media')->name('media');
Route::get('media/category/{id}', 'Frontend\FrontendController@catVideo')->name('cat_video');
Route::get('media/subcategory/{id}', 'Frontend\FrontendController@subcatVideo')->name('subcat_video');
Route::get('media/childcategory/{id}', 'Frontend\FrontendController@childcatVideo')->name('childcat_video');
Route::get('media/videodetail/{id}', 'Frontend\FrontendController@videoDetail')->name('video-detail');
Route::get('media/featuredvideo', 'Frontend\FrontendController@getFeaturedVideo')->name('video-featured');
Route::get('media/popularvideo', 'Frontend\FrontendController@getPopularVideo')->name('video-popular');

Route::get('refreshcaptcha', 'Frontend\FrontendController@refreshCaptcha')->name('refreshcaptcha');

Route::get('stripe/', 'Frontend\FrontendController@stripe')->name('stripe');
Route::post('stripe-pay', 'Frontend\FrontendController@stripePay')->name('stripe-payment');
Route::get('poli/', 'Frontend\FrontendController@poli')->name('poli');
Route::post('poli-pay', 'Frontend\FrontendController@poliPay')->name('poli-payment');
Route::get('polipayment/token', 'Frontend\FrontendController@polipayment')->name('poli-res');

Route::get('program-list','Frontend\FrontendController@programList')->name('program-list');
Route::get('program-participant-form/{id}','Frontend\FrontendController@participantForm')->name('participant-form');
Route::post('program-participant-save','Frontend\FrontendController@participantSave')->name('participant-save');
/** end of frontend route **/


Route::post('/category/getchilds','Backend\CategoryController@getChildCats')->middleware('auth')->name('get-Child-Cats');
Route::group(['prefix'=>'admin','middleware' => ['auth','admin']], function () {
    Route::get('/','HomeController@admin')->name('admin');
    Route::resource('users', 'UserController');
    Route::get('/profile','UserController@profile')->withoutMiddleware(['admin'])->name("profile");
    Route::get('/profile/{id}', 'UserController@profileEdit')->withoutMiddleware(['admin'])->name('profile-edit');
    Route::put('/profile/{id}', 'UserController@profileUpdate')->withoutMiddleware(['admin'])->name('profile-update');

    Route::get('/app_users', 'UserController@app_users')->name('app-users');
    Route::get('/admin_list', 'UserController@admin_list')->name('list-admin');
    // Route::get('/editor_list', 'UserController@editor_list')->name('list-editor');
    // Route::get('/operator_list', 'UserController@operator_list')->name('list-operator');

    Route::resource('editor', 'Backend\EditorController')->withoutMiddleware(['admin']);
    // Route::resource('editor', 'Backend\EditorController');
    Route::resource('operator', 'Backend\OperatorController')->withoutMiddleware(['admin']);

    Route::resource('category', 'Backend\CategoryController');
    Route::get('sub-category', 'Backend\CategoryController@subCat')->name('sub_category');
    Route::resource('author', 'Backend\AuthorController');
    Route::resource('contributor', 'Backend\ContributorController');
    // Route::resource('post', 'Backend\PostController')->withoutMiddleware(['admin']);
  
    Route::resource('contact', 'Backend\ContactController');
    Route::resource('about', 'Backend\AboutController');
    Route::resource('review', 'Backend\ReviewController');
    Route::resource('question', 'Backend\QuestionController');
    Route::resource('answer', 'Backend\AnswerController');
    
    // Route::resource('video', 'Backend\VideoController')->withoutMiddleware(['admin']);;
    Route::resource('menu', 'Backend\MenuController');
    Route::resource('submenu', 'Backend\SubmenuController');
    Route::resource('childmenu', 'Backend\ChildmenuController');
    Route::post('/menu/submenu','Backend\SubmenuController@getsubmenu')->withoutMiddleware(['admin'])->name('get-submenu');
    Route::post('/menu/childmenu','Backend\ChildmenuController@getchildmenu')->withoutMiddleware(['admin'])->name('get-childmenu');
  
    Route::post('video/popular', 'Backend\VideoController@popular')->withoutMiddleware(['admin'])->name('popular-video');
    Route::Post('video/unpopular', 'Backend\VideoController@unpopular')->withoutMiddleware(['admin'])->name('unpopular-video');
    Route::post('video/feature', 'Backend\VideoController@feature')->withoutMiddleware(['admin'])->name('featured-video');
    Route::Post('video/unfeature', 'Backend\VideoController@unfeature')->withoutMiddleware(['admin'])->name('unfeatured-video');

    Route::resource('featured', 'Backend\FeaturedController')->withoutMiddleware(['admin']);
    Route::post('post/feature', 'Backend\PostController@feature')->withoutMiddleware(['admin'])->name('featured-post');
    Route::Post('post/unfeature', 'Backend\PostController@unfeature')->withoutMiddleware(['admin'])->name('unfeatured-post');
    Route::resource('popular', 'Backend\PopularController')->withoutMiddleware(['admin']);
    Route::post('post/popular', 'Backend\PostController@popular')->withoutMiddleware(['admin'])->name('popular-post');
    Route::Post('post/unpopular', 'Backend\PostController@unpopular')->withoutMiddleware(['admin'])->name('unpopular-post');
    Route::resource('hotNews', 'Backend\HotNewsController')->withoutMiddleware(['admin']);
    Route::post('post/hotNews', 'Backend\PostController@hotNews')->withoutMiddleware(['admin'])->name('hotNews-post');
    Route::Post('post/noHotNews', 'Backend\PostController@onHotNews')->withoutMiddleware(['admin'])->name('noHotNews-post');
    

    Route::resource('newsletter', 'Backend\NewsletterController');
    Route::get('newsletters/{id}', 'Backend\NewsletterController@newsletter_detail')->name('newsletter-detail');
    Route::post('/sendNewsletter', 'Backend\NewsletterController@sendNewsletter')->name('send_newsletter');
    Route::get('subscriber', 'Backend\SubscriberController@index')->name('subscrib');
    Route::delete('subscriber/{id}', 'Backend\SubscriberController@delete')->name('sub-del');

    Route::resource('privacy', 'Backend\PrivacyController');
    Route::resource('terms', 'Backend\TermnconditionController');
    Route::resource('usernotification', 'Backend\UserNotificationController'); 

    Route::get('daily-winner', 'Backend\QuizController@dailyWinner')->name('daily-winner');   
    Route::get('weekly-winner', 'Backend\QuizController@weeklyWinner')->name('weekly-winner');   
    Route::get('monthly-winner', 'Backend\QuizController@monthlyWinner')->name('monthly-winner');   
    Route::get('quiz', 'Backend\QuizController@participate')->name('participate-list');   

    Route::resource('poll', 'Backend\PollController');
    Route::resource('voting', 'Backend\VotingController');
    Route::get('voting-result', 'Backend\VotingController@votingResult')->name('voting-result');
    Route::get('participant-detail/{id}', 'Backend\VotingController@detail')->name('participant-detail');

    Route::resource('program', 'Backend\ProgramController');
    Route::post('upload-files', 'Backend\ProgramController@uploadLargeFiles')->name('upload-file');
    Route::get('program-participantlist/{id}', 'Backend\ProgramController@participantList')->name('program-participant-list');
    Route::resource('participant', 'Backend\ParticipantController');
    Route::get('program-participantlist-video/{video}', 'Backend\ParticipantController@view')->name('view-video');
    Route::get('program-participantlist-video/download/{video}', 'Backend\ParticipantController@download')->name('download-video');
        
});

Route::resource('post', 'Backend\PostController');
Route::resource('video', 'Backend\VideoController');
Route::resource('blog', 'Backend\BlogController');
Route::resource('gallery', 'Backend\GalleryController');
Route::resource('advertise', 'Backend\AdvertiseController');
Route::resource('feedback', 'Backend\FeedbackController');


Route::group(['prefix'=>'editor','middleware'=>['auth','editor']], function(){
    Route::get('/','HomeController@editor')->name('editor');
   
    Route::get('/publish_news', 'Backend\EditorController@publish_news')->name('editor-publish-post');
    Route::get('/publish_video', 'Backend\EditorController@publish_video')->name('editor-publish-video');
    Route::get('/publish_blog', 'Backend\EditorController@publish_blog')->name('editor-publish-blog');
    Route::get('/publish_gallery', 'Backend\EditorController@publish_gallery')->name('editor-publish-gallery');
});

Route::group(['prefix'=>'operator','middleware'=>['auth','operator']], function(){
    Route::get('/','HomeController@operator')->name('operator');
   
    Route::get('/publish_news', 'Backend\OperatorController@publish_news')->name('operator-publish-post');
    Route::get('/publish_video', 'Backend\OperatorController@publish_video')->name('operator-publish-video');
    Route::get('/publish_blog', 'Backend\OperatorController@publish_blog')->name('operator-publish-blog');
    Route::get('/publish_gallery', 'Backend\OperatorController@publish_gallery')->name('operator-publish-gallery');
    Route::get('/publish_advertise', 'Backend\OperatorController@publish_advertise')->name('operator-publish-advertise');
});

Route::group(['prefix'=>'user','middleware' => ['auth','user']], function(){
    /*User Dashboard Routes*/
    Route::get('/','HomeController@user')->name('user');
    /*User Dashboard Routes*/
});

Auth::routes();
Route::get('/foo', function () {
    // Artisan::call('storage:link');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('schedule:run');
    //Artisan::call('queue:work');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', 'HomeController@register');

Route::get('quizprogram', 'Backend\QuizprogramController@index')->name('quizprogram');
Route::get('quizprogram/create', 'Backend\QuizprogramController@create')->name('quizprogramcreate');
Route::post('quizprogram/store', 'Backend\QuizprogramController@store')->name("quizprogram/store");
Route::get('quizprogram/edit/{id}', 'Backend\QuizprogramController@edit')->name("quizprogram/edit");
Route::put('quizprogram/update/{id}', 'Backend\QuizprogramController@update')->name("quizprogram/update");
Route::delete('quizprogram/destroy/{id}', 'Backend\QuizprogramController@destroy')->name("quizprogram/destroy");

Route::get('quiz_questions', 'Backend\Quiz_questionsController@index')->name('quiz_questions');
Route::get('quiz_question/create', 'Backend\Quiz_questionsController@create')->name('quiz_question/create');
Route::post('quiz_question/store', 'Backend\Quiz_questionsController@store')->name("quiz_question/store");
Route::post('quiz_question/upload', 'Backend\Quiz_questionsController@upload')->name("quiz_question/upload");
Route::get('quiz_question/edit/{id}', 'Backend\Quiz_questionsController@edit')->name("quiz_question/edit");
Route::put('quiz_question/update/{id}', 'Backend\Quiz_questionsController@update')->name("quiz_question/update");
Route::delete('quiz_question/destroy/{id}', 'Backend\Quiz_questionsController@destroy')->name("quiz_question/destroy");
Route::post('quiz_question/delete_image', 'Backend\Quiz_questionsController@delete_image')->name("quiz_question/delete_image");
Route::post('quiz_question/delete_option_image', 'Backend\Quiz_questionsController@delete_option_image')->name("quiz_question/delete_option_image");


Route::get('company','Backend\CompanyController@index')->name('company');
Route::get('company/create','Backend\CompanyController@create')->name('company/create');
Route::get('company/store','Backend\CompanyController@store')->name('company/store');













