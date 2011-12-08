<?


// This is basically a DAO and a DTO. Why bother splitting them up?
class Reservations extends DataObject {

    private $id;
    public $restaurantId;
    public $tableId;
    private $daysofweek;
    private $reservationStartTime;
    private $reservationEndTime;
    public $startDate;
    public $endDate;
    
    public function __construct($id = null) {
        
    }
    
    public function save() {
        if(empty($this->id)) {
            $sql = "INSERT INTO reservations (`id`,`table_id`,`restaurant_id`) VALUES ";
        }
    }
    
    // lookup a user by email password. returns the user obj
    public static function getReservationsByTable($restaurantId, $tableId, $active = true) {
        $mysqli = conn::get();
        
        $sql = sprintf("SELECT * FROM reservations WHERE restaurant_id = '%s' AND table_id = '%s'",
            $mysqli->real_escape_string($restaurantId),
            $mysqli->real_escape_string($tableId));
        if($active) $sql .= " AND end_date > NOW() AND start_date < NOW()";
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
        $table->tableId = $row['table_id'];
        $table->daysofweek = $row['days_of_week'];
        $table->reservationStartTime = $row['reservation_start_time'];
        $table->reservationEndTime = $row['reservation_end_time'];
        $table->startDate = $row['start_date'];
        $table->endDate = $row['end_date'];
        
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