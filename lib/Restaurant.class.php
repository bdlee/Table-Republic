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
        if(empty($id)) {
            // new restaurant
        } else {
            // lookup the restaurant in the DB
        }
    }
    
    public static function getActiveRestaurants() {
        $mysqli = conn::get();
        
        $sql = "SELECT r.* FROM restaurants r, tables s WHERE r.id = s.restaurant_id 
            AND s.end_date > NOW() AND s.start_date < NOW()
            GROUP BY r.id";
        
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
    public function getTables() {
        if(empty($this->tables)) {
            $this->tables = Table::getTablesByRestaurant($this->id);
        }
        return $this->tables;
    }
}

?>