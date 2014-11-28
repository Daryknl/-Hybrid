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

namespace application\view;

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

class View
{
    protected static $instance = NULL;
    
    public static function getInstance()
    {
        if(!self::$instance instanceof self)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Build page from database
     * @param array $data
     */
    public static function build(array $data)
    {
        if(!isset($data['title'], $data['body']))
        {
            return;
        }
        
        $content = new Page($data['title'], $data['body']);
        
        if(isset($data['stylesheets']))
        {
            foreach($data['stylesheets'] as $source)
            {
                $content->addStylesheet($source);
            }
        }
        
        if(isset($data['javascripts']))
        {
            foreach($data['javascripts'] as $source)
            {
                $content->addJavascript($source);
            }
        }
        $content->render('system.header');
        if(isset($data['header']))
        {
            $content->setHeader($data['header']);
        }
        $content->render('system.footer');
        if(isset($data['footer']))
        {
            $content->setFooter($data['footer']);
        }
		
		return $content->publish();
    }
}
