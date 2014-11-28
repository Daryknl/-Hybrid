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
use application\library\database\Adapter;
use application\library\database\AdapterInterface;

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

/**
 * Summary of Controller
 */
abstract class Controller
{
    protected $template = [];
    protected $database = NULL;
    
    public function __construct()
    {
        if(!$this->database instanceof AdapterInterface)
        {
            # Create Database Instance.
            $this->database = new Adapter();
        }
        
        if(!$this->template instanceof \application\view\View)
        {
            $this->template = new \application\view\Page();
            
            $title = $this->database->select('hybrid_settings', 'variable=\'sitename\'', 'value');
            if(!is_null($title))
            {
                $this->template->setTitle( $title );   
            }
        }
    }
    
    public function render($view, $params = array())
    {
    
    }
}
