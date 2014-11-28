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

class Page
{
    protected $title;
    protected $stylesheets = [];
    protected $javascrypts = [];
    protected $meta = [];
    protected $body = [];
    
    public function __construct($title = NULL, $body = '')
    {
        $this->title  = $title;
        $this->body[] = $body;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getTitle()
    {
        return $this->title;
    }
    
    public function addStylesheet($path)
    {
        $this->stylesheets[] = $path;
    }
    public function getStylesheet()
    {
        return $this->stylesheets;
    }
    
    public function addJavascript($path)
    {
        $this->javascrypts[] = $path;
    }
    public function getJavascript()
    {
        return $this->javascrypts;
    }
    
    /**
     * Set Header Content
     * @param mixed $source 
     * @param mixed $data 
     */
    public function setHeader($source, $data = false)
    {
        ob_start();
        
        if($data == false || file_exists($source)):
            $this->body['header'] = $this->render($source);
        else:
            $this->body['header'] = $source;
        endif;
    }
    public function render($source)
    {
        $source = str_ireplace(array('.', '_'), DIRECTORY_SEPARATOR, $source);
        require_once(sprintf('%s/%s.php', dirname(__FILE__), $source));
        $this->body['content'][] = ob_get_contents();
        ob_clean();
    }
    public function setFooter($source, $data = false)
    {
        if($data == false || file_exists($source)):
            $this->body['footer'] = $this->render($source);
        else:
            $this->body['footer'] = $source;
        endif;
        
        ob_end_clean();
    }
    
    public function publish()
    {
        $variables = array(
            'title'     => $this->getTitle(),
            'params'    => $this->body
        );
        extract($variables);
        require('system/layout.php');
    }
}