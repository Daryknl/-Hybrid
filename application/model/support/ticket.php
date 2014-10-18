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
    namespace HybridCMS\Application\Model;
    
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
    
    class Support_Ticket {
        protected $id;          // Ticket ID
        protected $status;      // Ticket Status    Pending, Open, Closed
        protected $author;      // Ticket Owner. Who opened it.
        protected $title;       // Ticket Title
        protected $message;     // Ticket Message
        protected $timestamp;   // Ticket Timestamp
        protected $subject;     // Ticket Subject
        
        public function __construct() {}
        
        public function setID() {}
        public function getID() {}
        
        public function setStatus() {}
        public function getStatus() {}
        
        public function setAuthor() {}
        public function getAuthor() {}
        
        public function setTitle() {}
        public function getTitle() {}
        
        public function setMessage() {}
        public function getMessage() {}
        
        public function setTimestamp() {}
        public function getTimestamp() {}
        
        public function setSubject() {}
        public function getSubject() {}
    }