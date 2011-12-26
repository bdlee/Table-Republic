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
    public $cuisine;
    public $price;
    private $features;
    private $banner;
    private $tables;
    
    private $minSeatCapacity;
    private $maxSeatCapacity;
    private $minStandCapacity;
    private $maxStandCapacity;
    
    private $details;
    
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
            $oDate = Helpers::defaultDate();
        }
        $date = $mysqli->real_escape_string($oDate->format('Y-m-d H:i:s'));
        $dayofweek = $mysqli->real_escape_string($oDate->format('w'));
        $number = isset($fields['num']) ? $fields['num'] : null;
        $time = isset($fields['time']) ? $fields['time'] : null;
        
        $sql = "SELECT r.* FROM `restaurants` r, `tables` t, `reservations` s WHERE r.id = t.restaurant_id AND r.id = s.restaurant_id AND t.id = s.table_id ";
        $sql .= " AND (s.end_date > '$date' OR s.end_date IS NULL) AND s.start_date <= '$date'";
        if($fields != null) // do this only if a search query was put through
            $sql .= " AND s.days_of_week LIKE '%$dayofweek%'";
        if($number != null) { // number of guests
            $sql .= sprintf(" AND (t.table_min <= %d AND t.table_max >= %d", $number, $number);
            $sql .= sprintf(" OR t.standing_min <= %d AND t.standing_max >=%d)", $number, $number);
        }
        if($time != null) // time of reservation
            $sql .= sprintf(" AND s.start_time <= '%s' AND s.end_time >='%s'", $time, $time);
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
        $restaurant->cuisine = $row['cuisine'];
        $restaurant->price = $row['price'];

        return $restaurant;
    }
    
    // DTO functions
    public function getId() {
        return $this->id;
    }
    public function getFeatures() {
        if(!isset($this->features)) {
            $this->features = array();
            $mysqli = conn::get();
            
            $sql = sprintf("SELECT f.feature FROM `restaurant_features` rf, `features` f WHERE f.id = rf.feature_id AND rf.restaurant_id = '%s'
                ORDER BY priority DESC",
                $mysqli->real_escape_string($this->id)
            );
            $result = $mysqli->query($sql);
            if($result === FALSE) {
                throw new Exception($mysqli->error, $mysqli->errno);
            }
            
            while($row = $result->fetch_row()) {
                $this->features[] = $row[0];
            }
        }
        return $this->features;
    }
    public function getBanner() {
        return null;
    }
    public function getTables($fields = null) {
        if(!isset($this->tables)) {
            $this->tables = Table::getTablesByRestaurant($this->id, $fields);
        }
        return $this->tables;
    }
    
    public function getMinSeatCapacity() {
        if(!isset($this->minSeatCapacity)) {
            $this->_setCapacity();
        }
        return $this->minSeatCapacity;
    }
    public function getMaxSeatCapacity() {
        if(!isset($this->maxSeatCapacity)) {
            $this->_setCapacity();
        }
        return $this->maxSeatCapacity;
    }
    public function getMinStandCapacity() {
        if(!isset($this->minStandCapacity)) {
            $this->_setCapacity();
        }
        return $this->minStandCapacity;
    }
    public function getMaxStandCapacity() {
        if(!isset($this->maxStandCapacity)) {
            $this->_setCapacity();
        }
        return $this->maxStandCapacity;
    }
    private function _setCapacity() {
        $mysqli = conn::get();
        
        $sql = sprintf("SELECT MIN(table_min), MAX(table_max),MIN(standing_min), MAX(standing_max) FROM `tables` WHERE restaurant_id = '%s'",
            $mysqli->real_escape_string($this->id)
        );
        $result = $mysqli->query($sql);
        if($result === FALSE) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        
        $row = $result->fetch_row();
        $this->minSeatCapacity = $row[0];
        $this->maxSeatCapacity = $row[1];
        $this->minStandCapacity = $row[2];
        $this->maxStandCapacity = $row[3];
    }
    
    public function getDetails() {
        if(!isset($this->details)) $this->_setDetails();
        return $this->details['details'];
    }
    public function getSpaceDetails() {
        if(!isset($this->details)) $this->_setDetails();
        return $this->details['space'];
    }
    public function getFoodDetails() {
        if(!isset($this->details)) $this->_setDetails();
        return $this->details['food'];
    }
    public function getGroupDetails() {
        if(!isset($this->details)) $this->_setDetails();
        return $this->details['groups'];
    }
    private function _setDetails() {
        $mysqli = conn::get();
        
        $sql = sprintf("SELECT * FROM `restaurant_details` WHERE restaurant_id = '%s'",
            $mysqli->real_escape_string($this->id)
        );
        $result = $mysqli->query($sql);
        if($result === FALSE) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        
        $row = $result->fetch_assoc();
        $this->details = $row;
    }
}

?>