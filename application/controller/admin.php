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

/**
 * Summary of Admin
 */
class Admin extends Controller
{
    protected $account = NULL;
    
    public function __construct()
    {
        $this->account = new Account();
    }
    
    /**
     * Check to see if user has admin privilage
     */
    private function check()
    {
        if($this->account->getID() != 0)
        {
            if($this->account->hasPrivilege('admin') == true)
            {
                return true;
            }
        }
        return false;
    }
    
    # Login
    public function doLoginAction()
    {
    
    }
    public function doLoginView()
    {
    
    }
    
    # articles
    public function doArticleView()
    {
        # TODO: Build Article Edit View.
    }
    public function doArticleAction($method = 'NEW', $article_id = NULL)
    {
        $articlemap = \application\model\mapper\articleMap();
        $article = null;
        
        switch($method)
        {
            case 'NEW':
                /**
                 * $data = [postdata];
                 * $article = new model\Article($data);
                 * $articleMap->createEntity($article);
                 */
                break;
            case 'EDIT':
                /**
                 * $data = [database array]
                 * $article = new model\Article($data);
                 * $article->setContent($post[newContent]) ..ect.
                 * $articleMap->updateEntity($article);
                 */
                break;
            case 'REMOVE':
                /**
                 * $articleMap->deleteEntity($article_id);
                 */
                break;
            default:
                // Do Nothing
                break;
        }
    }
}
