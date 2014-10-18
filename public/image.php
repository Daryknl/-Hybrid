<?php
    /**
     *	&HybridCMS
     *	CMS (Content Management System) for Habbo Emulators.
     *
     *	@author     GarettMcCarty <mrgarett@gmail.com> DB:GarettisHere
     *	@version    0.0.5
     *	@link       http://github.com/GarettMcCarty/HybridCMS
     *	@license    Attribution-NonCommercial 4.0 International
     */

    # Application Security
    # 1 = Internal Script, 2 = API Access       - Please use access level 2 if your unsure.
    defined('HybridSecure') or define('HybridSecure', 2);

    require( dirname(__FILE__) . '/application/bootstrap.php' );

    # Image Data
    $image = '#';

    # Image Source
    $file = isset($_GET, $_GET['src'])  ? $_GET['src']  : null;
    $type = isset($_GET, $_GET['type']) ? $_GET['type'] : 'png';

    # External Resouce?
    $external = false;

    # Theme Where Image is Stored
    # TODO: Dynamicly get theme from database
    $theme = 'default';
    if(isset($_GET, $_GET['theme']) == true) {
        $theme = (is_dir( sprintf('themes/%s', $_GET['theme']) ) == true) ? $_GET['theme'] : $theme;
    } elseif(isset($_GET, $_GET['location']) && $_GET['location'] == 'external') {
        $external = true;
    }

    # Retrieve Image Format
    function getFileFormat() {
        global $type;
        $dataTypes = ['png' => 'image/png', 'jpg' => 'image/jpeg', 'gif' => 'image/gif'];
        
        if(array_key_exists($type, $dataTypes)) {
            return $dataTypes[ $type ];
        }
        return false;
    }

    # Retrieve Image Data
    function getFileData() {
        global $file, $type, $external, $theme;
        
        if($external == true) {
            $resource = curl_init($file);
            curl_setopt($resource, CURLOPT_NOBODY, true);
            curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
            curl_exec($resource);
            if(curl_getinfo($resource, CURLINFO_HTTP_CODE) == 200) {
                return file_get_contents($file);
            }
            curl_close($resource);
        } else {
            if(file_exists( $image = sprintf('themes/%s/img/%s.%s', $theme, $file, $type) )) {
                return file_get_contents($image);
            }
        }
        return false;
    }

    # encode image
    if(is_null($file) == false && $resource = getFileData() && $format = getFileFormat()) {
        $image = sprintf('%s,base64,%s', $format, base64_encode($resource));
    }

    # echo image string
    echo $image;