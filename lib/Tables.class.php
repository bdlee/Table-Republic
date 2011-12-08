<?


// This is basically a DAO and a DTO. Why bother splitting them up?
class Table extends DataObject {

    private $id;
    public $restaurantId;
    public $tableMin;
    public $tableMax;
    private $reservations;
    
    public function __construct($id = null) {
    }
    
    // lookup a user by email password. returns the user obj
    public static function getTablesByRestaurant($restaurantId, $fields = null) {
        $mysqli = conn::get();
        
        if(isset($fields['date'])) {
            $oDate = new Datetime($fields['date']);
        } else {
            $oDate = new Datetime();
        }
        $date = $mysqli->real_escape_string($oDate->format('Y-m-d H:i:s'));
        $dayofweek = $mysqli->real_escape_string($oDate->format('w'));
        $number = isset($fields['number']) ? $fields['number'] : null;
        $time = isset($fields['time']) ? $fields['time'] : null;
        
        $sql = sprintf("SELECT t.* FROM tables t, reservations r WHERE t.restaurant_id = r.restaurant_id AND t.id = r.table_id AND t.restaurant_id = '%s'",
            $mysqli->real_escape_string($restaurantId));
        $sql .= " AND r.end_date > NOW() AND r.start_date < NOW()";
        if($fields) // do this only if a search query was put through
            $sql .= " AND r.days_of_week = '%$dayofweek%'";
        if($number) // number of guests
            $number = sprintf(" AND t.table_min < %d AND table_max > %d", $number, $number);
        if($time) // time of reservation
            $time = sprintf(" AND r.start_time < '%s' AND r.end_time > '%s'", $time, $time);
        $sql .= " GROUP BY t.id ORDER BY r.start_time ASC, t.table_min ASC";
        
        $result = $mysqli->query($sql);
        
        if($result === FALSE) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        
        return self::getList($result);
    }
    
    public static function getActiveTables($fields = null) {
        $mysqli = conn::get();
        
        if(isset($fields['date'])) {
            $oDate = new Datetime($fields['date']);
        } else {
            $oDate = new Datetime();
        }
        $date = $mysqli->real_escape_string($oDate->format('Y-m-d H:i:s'));
        $dayofweek = $mysqli->real_escape_string($oDate->format('w'));
        $number = isset($fields['number']) ? $fields['number'] : null;
        $time = isset($fields['time']) ? $fields['time'] : null;
        
        $sql = "SELECT * FROM tables WHERE 1";
        $sql .= " AND (s.end_date IS NULL OR s.end_date > $date) AND s.start_date < $date";
        if($number != null) {
            $number = sprintf('%d',$mysqli->real_escape_string($number));
            $sql .= " AND t.table_min < $number AND t.table_max > $number";
        }
        $sql .= " ORDER BY reservation_date ASC, reservation_start_time ASC, table_min ASC";
        
        $result = $mysqli->query($sql);
        
        if($result === FALSE) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        
        return self::getList($result);
    }
    
    protected function row2obj($row) {
        $table = new Table();
        $table->id = $row['table_id'];
        $table->restaurantId = $row['restaurant_id'];
        $table->tableMin = $row['table_min'];
        $table->tableMax = $row['table_max'];
        
        return $table;
    }
    
    // DTO functions
    public function getId() {
        return $this->id;
    }
    public function getDisplayDate() {
        $date = strtotime($this->reservationDate);
        
        return date('D, M j, Y', $date);
    }
    public function getDisplayTime() {
        $time = strtotime($this->reservationStartTime);
        
        return date('g:i A', $time);
    }
    public function getReservations() {
        if(!isset($this->reservations)) {
            $this->reservations = Reservations::getReservationsByTable($this->restaurantId, $this->id);
        }
        return $this->reservations;
    }
}

?>