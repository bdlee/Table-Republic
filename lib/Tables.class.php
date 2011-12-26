<?


// This is basically a DAO and a DTO. Why bother splitting them up?
class Table extends DataObject {

    private $id;
    public $restaurantId;
    public $name;
    public $tableMin;
    public $tableMax;
    public $standingMin;
    public $standingMax;
    private $reservations;
    
    public function __construct($id = null) {
    }
    
    // lookup a user by email password. returns the user obj
    public static function getTablesByRestaurant($restaurantId, $fields = null) {
        $mysqli = conn::get();
        
        if(isset($fields['date'])) {
            $oDate = new Datetime($fields['date']);
        } else {
            $oDate = Helpers::defaultDate();
        }
        $date = $mysqli->real_escape_string($oDate->format('Y-m-d H:i:s'));
        $dayofweek = $mysqli->real_escape_string($oDate->format('w'));
        $number = isset($fields['num']) ? $fields['num'] : null;
        $time = isset($fields['time']) ? $fields['time'] : null;
        
        $sql = sprintf("SELECT t.* FROM `tables` t, `reservations` s WHERE t.restaurant_id = s.restaurant_id AND t.id = s.table_id AND t.restaurant_id = '%s'",
            $mysqli->real_escape_string($restaurantId));
        $sql .= " AND (s.end_date > '$date' OR s.end_date IS NULL) AND s.start_date <= '$date'";
        if($fields != null) // do this only if a search query was put through
            $sql .= " AND s.days_of_week LIKE '%$dayofweek%'";
        if($number != null) { // number of guests
            $sql .= sprintf(" AND (t.table_min <= %d AND t.table_max >= %d", $number, $number);
            $sql .= sprintf(" OR t.standing_min <= %d AND t.standing_max >=%d)", $number, $number);
        }
        if($time != null) // time of reservation
            $sql .= sprintf(" AND s.start_time <= '%s' AND s.end_time >='%s'", $time, $time);
        $sql .= " GROUP BY t.id ORDER BY s.start_time ASC, t.table_min ASC";

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
        $table->id = $row['id'];
        $table->restaurantId = $row['restaurant_id'];
        $table->name = $row['name'];
        $table->tableMin = $row['table_min'];
        $table->tableMax = $row['table_max'];
        $table->standingMin = $row['standing_min'];
        $table->standingMax = $row['standing_max'];
        
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
    public function getReservations($fields = null) {
        if(!isset($this->reservations)) {
            $this->reservations = Reservations::getReservationsByTable($this->restaurantId, $this->id, $fields);
        }
        return $this->reservations;
    }
}

?>