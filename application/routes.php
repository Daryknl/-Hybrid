<?php
/**
 *	&HybridCMS
 *	CMS (Content Management System) for Habbo Emulators.
 *
 *	@author     GarettMcCarty <mrgarett@gmail.com> DB:GarettisHere
 *	@version    1.0.0
 *	@link       http://github.com/GarettMcCarty/HybridCMS
 *	@license    Attribution-NonCommercial 4.0 International
 */

namespace application;
use application\library\Router;

if(!defined('HybridSecure'))
{
    global $config;
    
    if(isset($config, $config['domain']))
    {
        $location = sprintf('Location: http://%s/404', $config['domain']);
        header($location);
    }
    echo 'Sorry a internal application error has occurred.';
    $error = sprintf('[AUTH] The file %s was denied access', basename(__FILE__));
    error_log($error);
    exit;
}

/**
 * Hybird Routes
 */
Router::GET('/', function (){
    // TODO: Frontpage View
});

Router::GET('/login', function (){
    // TODO: Login View
});
Router::POST('/login', function (){
    // TODO: Login Action
});

Router::GET('/register', function (){
    // TODO: Register View
});
Router::POST('/register', function (){
    // TODO: Register Action
});

Router::GET('/community/[string]', function ($page){
    # Community Page 
    switch($page)
    {
        default:
            // TODO: main community page... Hmmm
            break;
    }
});
Router::POST('/community/[string]', function ($page){
    # Community Action
    switch($page)
    {
        default:
            // TODO: switch action based on current request
            break;
    }
});

Router::GET('/profile/[int]', function ($id = NULL){
    # User Profile
    if(is_null($id))
    {
        // Get Current user logged-in user id.
    }
    # Show Profile Page
});
Router::POST('/profile/[int]', function ($id = NULL){
    # User Profile
    if(is_null($id))
    {
        // Get Current user logged-in user id.
    }
    # Return Accounts Profile Information in JSON or XML
});

Router::GET('/admin', function (){
    # TODO: Admin Dashboard or redirect to /admin/login
});

Router::GET('/admin/[string]', function ($page){
    # TODO: Admin Page
    switch($page)
    {
		#\application\controller\Admin::isView([string])
        case method_exists('\application\controller\Admin', sprintf('do%sView', $page)):
            // TODO: do controller action
            break;
        default:
            // Dashboard
            break;
    }
});
Router::POST('/admin/[string]', function ($page){
    # TODO: Admin Action
    switch($page)
    {
		#\application\controller\Admin::isAction([string])
        case method_exists('\application\controller\Admin', sprintf('do%sAction', $page)):
            // TODO: do controller action
            break;
        default:
            // Nothing
            break;
    }
});