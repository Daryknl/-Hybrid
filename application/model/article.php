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
 * Article Object Model
 * 
 * @see Hybird::Model
 */
class Article
{
    protected $id;
    protected $title;
    protected $author;
    protected $imagePreview;
    protected $summary;
    protected $content;
    protected $category;
    protected $tags = array();
    
    /**
     * Article constructer
     * @param array $entity - Article data. 
     */
    public function __construct(array $entity)
    {
        $this->id       = $entity['id'];
        $this->title    = $entity['title'];
        $this->author   = $entity['author'];
        $this->imagePreview = $entity['imagePreview'];
        $this->summary  = $entity['summary'];
        $this->content  = $entity['content'];
        $this->tags     = $entity['tags'];
    }
    
    /**
     * set the articles id
     * @param int $id - the article id
     */
    public function setID($id)
    {
        $this->id = $id;
    }
    
    /**
     * get the articles id
     * @return int - the article id
     */
    public function getID()
    {
        return $this->id;
    }
    
    /**
     * set the title of the article
     * @param string $title - article title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * get the title of the article
     * @return string - the article title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * set the author of the article
     * @param string $author - The authors name
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    /**
     * get the authors name
     * @return string - The authors name
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    /**
     * set the articles image
     * @param string $source - the image location for the article, ex: [domain]/public/images/articles/[article:id].jpeg 
     */
    public function setImagePreview($source)
    {
        $this->imagePreview = $source;
    }
    /**
     * get the articles image
     * @return string - the image location
     */
    public function getImagePreview()
    {
        return $this->imagePreview;
    }
    
    /**
     * set the summary for the article
     * @param string $summary - the short story for the article 
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }
    /**
     * get the summary of the article
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }
    
    /**
     * set the main content of the article
     * @param string $content - the article's main content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    /**
     * get the main content of the article
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * set the category for the article
     * @param array $category - an array of categorys the article belongs to
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
    
    /**
     * get the categorys the article belongs to
     * @return array
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * set tags for the article
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }
    
    /**
     * get tags for the article
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }
}
