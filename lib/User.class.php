<?


// This is basically a DAO and a DTO. Why bother splitting them up?
class User extends DataObject {

    private $id;
    public $email;
    private $password;
    public $fname;
    public $lname;
    public $validated;
    
    public function __construct($id = null, $password = null) {
        if(empty($id)) {
            // new user
        } else {
            // lookup the user in the DB
        }
    }
    
    public static function getUser($email, $password) {
        $mysqli = conn::get();
        
        $sql = sprintf("SELECT * FROM users WHERE email LIKE '%s' AND password LIKE MD5('%s')",
            $mysqli->real_escape_string($email),
            $mysqli->real_escape_string(PASS_SEED . $email . $password));
        
        $result = $mysqli->query($sql);
        return self::getRow($result);
    }
    public static function getUserByEmail($email) {
        $mysqli = conn::get();
        
        $sql = sprintf("SELECT * FROM users WHERE email LIKE '%s'",
            $mysqli->real_escape_string($email));
        
        $result = $mysqli->query($sql);
        return self::getRow($result);
    }
    
    public function save() {
        $mysqli = conn::get();
        
        $isNew = empty($this->id);
        
        if($isNew) {
            $sql = sprintf("INSERT INTO `users` (`id`, `email`, `fname`, `lname`, `password`, `last_login`, `validated`) VALUES (NULL, '%s', '%s', '%s', '%s', NOW(), 0)",
                $mysqli->real_escape_string($this->email),
                $mysqli->real_escape_string($this->fname),
                $mysqli->real_escape_string($this->lname),
                $mysqli->real_escape_string($this->password)
            );
        } else {
            $sql = sprintf("UPDATE `users` SET `email` = '%s', `fname` = '%s', `lname` = '%s', `password` = '%s'",
                $mysqli->real_escape_string($this->email),
                $mysqli->real_escape_string($this->fname),
                $mysqli->real_escape_string($this->lname),
                $mysqli->real_escape_string($this->password)
            );
        }
        if(($result = $mysqli->query($sql)) === FALSE) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        return $mysqli->insert_id;
    }
    
    protected function row2obj($row) {
        $user = new User();
        $user->id = $row['id'];
        $user->email = $row['email'];
        $user->fname = $row['fname'];
        $user->lname = $row['lname'];
        $user->password = $row['password'];
        $user->validated = ($row['validated'] == 1);
        
        return $user;
    }
    
    // DTO functions
    public function getId() {
        return $this->id;
    }
    public function getPassword($pswd) {
        return $this->password;
    }
    public function setPassword($pswd) {
        $this->password = md5(PASS_SEED . $this->email . trim($pswd));
    }
    public function checkPassword($pswd) {
        return (!empty($this->pswd) && ($this->pswd == md5(PASS_SEED . $this->email . trim($pswd))));
    }
}

?>