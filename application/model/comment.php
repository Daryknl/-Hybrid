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

namespace application\model;

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
 * Comment Object Model
 * 
 * @see Hybrid::Model
 */
class Comment
{
    protected $id;
    protected $article;
    protected $author;
    protected $votes;
    protected $timestamp;
    
    public function __construct(array $entity)
    {
        $this->id        = $entity['id'];
        $this->article   = $entity['article'];
        $this->author    = $entity['author'];
        $this->votes     = $entity['votes'];
        $this->timestamp = $entity['timestamp'];
    }
    
    public function setID($id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }
    
    public function setArticle($parent)
    {
        $this->article = $parent;
    }
    public function getArticle()
    {
        return $this->article;
    }
    
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function setTimestamp($datetime)
    {
        $this->timestamp = $datetime;
    }
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
