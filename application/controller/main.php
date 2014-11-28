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

namespace application\controller;

if(!defined('HybridSecure'))
{
    if(class_exists('Configuration', true) !== false)
    {
        try {
            $application = Configuration::get('app');
            if(isset($application['url']))
            {
                $location = sprintf('Location: %s/404', $application['url']);
                header($location);
                unset($application);
            }
        } catch(\Exception $ex) {}
    }
    echo 'Sorry a internal application error has occurred.';
    $error = sprintf('[AUTH] The file %s was denied access', basename(__FILE__));
    error_log($error);
    exit;
}

class Main extends Controller
{
    # HybridCMS Template
    protected $template = [];
    
    public function __construct()
    {
        if(!$this->template instanceof \application\view\View)
        {
            $this->template = new \application\view\Page();
            
            $title = $this->database->select('hybrid_settings', 'variable=\'domain\'', 'value');
            if(!is_null($title))
            {
                $this->template->setTitle( $title );   
            }
        }
    }
    
    # Login Controller Handler
    public function login()
    {
        try {
            
        } catch(\Exception $ex) {
        
        }
    }
    # Register Controller Function
    public function register()
    {
        try {
        
        } catch(\Exception $ex) {
        
        }
    }
    # Client Controller Function
}
