<?php
/**
 * Class and Function List:
 * Function list:
 * - (()
 * - (()
 * - (()
 * - (()
 * Classes list:
 */
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('fbf_newsletter_signups', 'Subscriber');
Route::model('role', 'Role');
Route::model('deployments', 'Deployment');
Route::model('cloudAccounts', 'CloudAccount');
Route::model('tickets', 'Ticket');
Route::model('ticket_comments', 'TicketComments');
Route::model('engine_logs', 'EngineLog');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('subscriber', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

Route::pattern('account', '[0-9]+');
Route::pattern('ticket', '[0-9]+');
Route::pattern('deployment', '[0-9]+');
Route::pattern('enginelog', '[0-9]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array(
    'prefix' => 'admin',
    'before' => 'auth'
) , function () {
    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');
    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');
	
	Route::get('subscribers/{subscriber}/delete', 'AdminSubscribersController@getDelete');
    Route::post('subscribers/{subscriber}/delete', 'AdminSubscribersController@postDelete');
    Route::controller('subscribers', 'AdminSubscribersController');
	
	Route::get('tickets/{ticket}/show', 'AdminTicketsController@getShow');
    Route::get('tickets/{ticket}/edit', 'AdminTicketsController@getEdit');
    Route::post('tickets/{ticket}/edit', 'AdminTicketsController@postEdit');
    Route::get('tickets/{ticket}/delete', 'AdminTicketsController@getDelete');
    Route::post('tickets/{ticket}/delete', 'AdminTicketsController@postDelete');
    Route::controller('tickets', 'AdminTicketsController');
	Route::controller('accounts', 'AdminAccountsController');
	Route::controller('deployments', 'AdminDeploymentsController');
    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');
    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');
    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});
/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */
// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');
//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

Route::any('user/social/{action?}', array(
    "as" => "hybridauth",
    'uses' => 'UserController@socialLogin'
));

//:: Amazon login return URL ::
Route::post(URL::to(Config::get('amazon.return_route')), 'UserController@amazonLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');
//:: Application Routes ::

# Filter for detect language
Route::when('contact-us', 'detectLang');

# Contact Us Static Page
Route::get('contact-us', function () {
    // Return about us page
    return View::make('site/static/contact-us');
});

Route::when('roadmap', 'detectLang');
Route::get('roadmap', function () {
    // Return about us page
    return View::make('site/static/roadmap');
});

Route::when('data-security', 'detectLang');
Route::get('data-security', function () {
    // Return about us page
    return View::make('site/static/data-security');
});

Route::when('devops', 'detectLang');
Route::get('devops', function () {
    // Return about us page
    return View::make('site/static/devops');
});

Route::when('videos', 'detectLang');
Route::get('videos', function () {
    // Return about us page
    return View::make('site/static/videos');
});

/* We don't use the default blog stuff
# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');
*/
/** ------------------------------------------
 *  Authenticated User Routes
 *  ------------------------------------------
 */
Route::group(array(
    'before' => 'auth'
) , function () {
    # Resource route for the cloud account API crendentials
    Route::any('account/', 'AccountController@getIndex'); 
	Route::get('account/create', 'AccountController@getCreate');
    Route::get('account/{account}/edit', 'AccountController@getCreate');
	
	Route::any('ticket/', 'TicketController@getIndex'); 
	Route::get('ticket/create', 'TicketController@getCreate');
    Route::get('ticket/{ticket}/edit', 'TicketController@getCreate');
	Route::get('ticket/{ticket}/reply', 'TicketController@getReply');
	Route::any('ticket/{ticket}/close', 'TicketController@closeTicket');
	
	Route::any('deployment/', 'DeploymentController@getIndex');
    Route::get('deployment/create', 'DeploymentController@getCreate');
	Route::any('enginelog/', 'EnginelogController@getIndex'); 
	Route::get('deployment/{deployment}/log', 'DeploymentController@getLogs');
	Route::get('ServiceStatus/', 'WebserviceController@getIndex');
	Route::get('deployment/images', 'DeploymentController@getImages');
	Route::any('deployment/{deployment}/downloadKey', 'DeploymentController@getDownloadKey');
	Route::any('deployment/{deployment}/refresh', 'DeploymentController@checkStatus');
	
	//Route::post('deployment/startContainer', 'DeploymentController@startContainer');
    Route::any('deployment/docker/container/start', 'ContainerController@startContainerByDeployment');
	Route::any('deployment/docker/container/stop', 'ContainerController@stopContainerByDeployment');
	Route::any('deployment/docker/{deployment}/Containers',   'ContainerController@getContainersByDeployment');
	Route::any('deployment/docker/container/top', 'ContainerController@topByDeployment');
	Route::any('deployment/docker/container/logs', 'ContainerController@logsByDeployment');
	Route::any('deployment/docker/container/export', 'ContainerController@exportByDeployment');
	
	Route::any('account/docker/container/start', 'ContainerController@startContainerByAccount');
	Route::any('account/docker/container/stop', 'ContainerController@stopContainerByAccount');
	Route::any('account/docker/{account}/Containers',   'ContainerController@getContainersByAccount');
	Route::any('account/docker/container/top', 'ContainerController@topByAccount');
	Route::any('account/docker/container/logs', 'ContainerController@logsByAccount');
	Route::any('account/docker/container/export', 'ContainerController@exportByAccount');
	Route::any('awsPricing/', 'AWSPricingController@getIndex'); 
	
	Route::group(array(
        'before' => 'csrf'
    ) , function () {
        Route::post('account/create', 'AccountController@postEdit');
        Route::post('account/{account}/edit', 'AccountController@postEdit');
        Route::post('account/{account}/delete', 'AccountController@postDelete');
        Route::post('deployment/create', 'DeploymentController@postEdit');
        Route::post('deployment/{deployment}/delete', 'DeploymentController@postDelete');
		Route::post('deployment/{deployment}/terminate', 'DeploymentController@postTerminate');
		Route::post('deployment/{deployment}/instanceAction', 'DeploymentController@postInstanceAction');
		Route::post('ticket/create', 'TicketController@postEdit');
        Route::post('ticket/{ticket}/edit', 'TicketController@postEdit');
		Route::post('ticket/{ticket}/reply', 'TicketController@postReply');
        Route::post('ticket/{ticket}/delete', 'TicketController@postDelete');
    });
    
    
});
# Index Page - Last route, no matches
Route::get('/', array(
    'before' => 'detectLang',
    'uses' => 'HomeController@getIndex'
));