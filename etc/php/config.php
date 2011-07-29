<?
    require_once(dirname(__FILE__) . "/site.creds.php");
    
    function includeAll($path, $recursive = false) {
        
        //using the opendir function
        $dir_handle = @opendir($path) or die("Unable to open $path");

        //running the while loop
        while ($file = readdir($dir_handle)) 
        {
            if($recursive && is_dir($path.$file) && !( $file == '.' || $file == '..')) {
                includeAll($path.$file.'/', $recursive);
            } else {
                $inc = basename($file, '.php') . '.php';

                if(file_exists($path.$inc)) {
                    include_once $path.$inc;
                }
            }
        }

        //closing the directory
        closedir($dir_handle);
    }
    
    includeAll(dirname(__FILE__) . "/../../lib/", true);
    
    session_start();
?>