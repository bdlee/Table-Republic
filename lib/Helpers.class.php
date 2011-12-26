<?

class Helpers {
    public function is_ie() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && 
        (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
            return true;
        else
            return false;
    }
        
    /*
     * @getTimes
     * returns an array of times from start to end in intervals specified by $interval (in hours)
     */
    public function getTimes($start = 0, $end = 23.5, $interval = .5) {
        $times = array();
        for($i = $start; $i <= $end; $i = $i + $interval) {
            $times[] = new Datetime(date('G:i',$i * 60 * 60));
        }
        return $times;
    }
    
    public function defaultDate() {
        return new DateTime();
    }
}

?>