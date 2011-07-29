<?


// This is basically a DAO and a DTO. Why bother splitting them up?
class Table extends DataObject {

    private $id;
    public $restaurantId;
    public $userId;
    public $startDate;
    public $endDate;
    public $tableMin;
    public $tableMax;
    private $reservationDate;
    private $reservationStartTime;
    private $reservationEndTime;
    private $restaurant;
    
    public function __construct($id = null) {
        if(empty($id)) {
            // new user
        } else {
            // lookup the user in the DB
        }
    }
    
    // lookup a user by email password. returns the user obj
    public static function getTablesByRestaurant($restaurantId, $active = true) {
        $mysqli = conn::get();
        
        $sql = sprintf("SELECT * FROM tables WHERE restaurant_id = %s",
            $mysqli->real_escape_string($restaurantId));
        if($active) $sql .= " AND end_date > NOW() AND start_date < NOW() AND user_id = 0";
        $sql .= " ORDER BY reservation_date ASC, reservation_start_time ASC, table_min ASC";
        
        $result = $mysqli->query($sql);
        
        if($result === FALSE) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        
        return self::getList($result);
    }
    
    public static function getActiveTables() {
        $mysqli = conn::get();
        
        $sql = "SELECT * FROM tables WHERE end_date > NOW() AND start_date < NOW()";
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
        $table->userId = $row['user_id'];
        $table->startDate = $row['start_date'];
        $table->endDate = $row['end_date'];
        $table->tableMin = $row['table_min'];
        $table->tableMax = $row['table_max'];
        $table->reservationDate = $row['reservation_date'];
        $table->reservationStartTime = $row['reservation_start_time'];
        $table->reservationEndTime = $row['reservation_end_time'];
        
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
    public function getRestaurant() {
        if(empty($this->restaurant)) {
            $this->restaurant = new Restaurant($this->restaurantId);
        }
        return $this->restaurant;
    }
}

?>