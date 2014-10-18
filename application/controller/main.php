<?php
    /**
     *	&HybridCMS
     *	CMS (Content Management System) for Habbo Emulators.
     *
     *	@author		GarettMcCarty <mrgarett@gmail.com> DB:GarettisHere
     *	@version	0.0.5
     *	@link		http://github.com/GarettMcCarty/HybridCMS
     *	@license	Attribution-NonCommercial 4.0 International
     */

    # Application Namespace
    namespace HybridCMS\Application\Controller;
    
    # Application Security Check
    if(!defined('HybridSecure')) {
        global $config;

        echo 'Sorry a internal error occurred.';
        if(isset($config, $config['domain']) == true) {
            header(sprintf('Location: http://%s/404', $config['domain']));
        }
        error_log(sprintf('[%s] &HybridCMS Authication Failure.', basename(__FILE__)));
        exit;
    }

    /**
     * Main Controller
     */
    class Main {
        
        protected $registry;
        protected $options;
        
        public function __construct($registry) {
            $this->registry = $registry;
            
            $this->options['uri'] = $this->buildURL();
        }
        
        public function run() {
            # is the account authicated?
            $authicated = array_key_exists('account', $_SESSION) ? true : false;
            
            switch( $this->options['uri'][0] ) {
                case 'login':
                    if(isset($_POST, $_POST['authication'])) {
                        $email    = filter_input(INPUT_POST, 'authicate_mail');
                        $username = filter_input(INPUT_POST, 'authicate_username');
                        $password = filter_input(INPUT_POST, 'authicate_password');
                        
                        // TODO: Try to authicate user
                    }
                    
                    $view = new \HybridCMS\Application\View\FrontPage();
                    $view->login();
                    break;
                case 'register':
                    echo 'register';
                    break;
                case 'logout':
                    echo 'logout';
                    break;
                case 'dashboard':
                    echo 'me';
                    break;
                case 'client':
                    echo 'client';
                    break;
                case null:
                case 'frontpage':
                default:
                    echo 'frontpage<br />requested: ', $this->options['uri'][0];
                    break;
            }
        }
        public function buildURL() {
            $request = filter_input(INPUT_SERVER, 'REQUEST_URI');
            
            if(stripos($request, 'index.php') == true) {
                $request = str_ireplace('/index.php', '', $request);
            }
            
            $request = ltrim($request, '/');
            
            return explode('/', $request);
        }
    }