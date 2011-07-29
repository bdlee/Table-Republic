<?

class conn {

    private static $mysqli;
    
    public static function get() {
        if(!isset(self::$mysqli)) {
            self::$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }
        
        return self::$mysqli;
    }
    
    public static function close() {
        self::$mysqli->close();
    }
}

?>