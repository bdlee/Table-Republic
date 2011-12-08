<?

// This is basically a DAO and a DTO. Why bother splitting them up?
class Restaurant extends DataObject {

    private $id;
    public $name;
    public $description;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $zip;
    public $phone;
    private $tables;
    
    public function __construct($id = null) {
        
    }
    
    public static function getRestaurant($id) {
        $mysqli = conn::get();
        
        $sql = sprintf("SELECT * FROM restaurants WHERE id = '%s'",
            $mysqli->real_escape_string($id)
        );
        
        $result = $mysqli->query($sql);
        
        if($result === FALSE) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        
        return self::getRow($result);
    }
    
    public static function getActiveRestaurants($fields = null) {
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
        
        $sql = "SELECT r.* FROM restaurants r, tables t, reservations s WHERE r.id = t.restaurant_id AND r.id = s.restaurant_id AND t.id = s.table_id ";
        $sql .= " AND (s.end_date > '$date' OR s.end_date IS NULL) AND s.start_date < '$date'";
        if($fields)
            $sql .= " AND s.days_of_week LIKE '%$dayofweek%'";
        if($number != null) {
            $number = sprintf('%d',$mysqli->real_escape_string($number));
            $sql .= " AND t.table_min <= $number AND t.table_max >= $number";
        }
        if($time != null) {
            $time = sprintf("'%s'",$mysqli->real_escape_string($time));
            $sql .= " AND s.start_time <= $time AND s.end_time >= $time";
        }
        $sql .= " GROUP BY r.id";
        
        $result = $mysqli->query($sql);
        
        if($result === FALSE) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        
        return self::getList($result);
    }
    
    protected function row2obj($row) {
        $restaurant = new Restaurant();
        $restaurant->id = $row['id'];
        $restaurant->name = $row['name'];
        $restaurant->description = $row['description'];
        $restaurant->address1 = $row['address1'];
        $restaurant->address2 = $row['address2'];
        $restaurant->city = $row['city'];
        $restaurant->state = $row['state'];
        $restaurant->zip = $row['zip'];
        $restaurant->phone = $row['phone'];

        return $restaurant;
    }
    
    // DTO functions
    public function getId() {
        return $this->id;
    }
    public function getTables($fields = null) {
        if(!isset($this->tables)) {
            $this->tables = Table::getTablesByRestaurant($this->id, $fields);
        }
        return $this->tables;
    }
}

?>