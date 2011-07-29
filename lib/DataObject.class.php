<?

abstract class DataObject {
    abstract protected function row2obj($row);
    
    protected function getRow($result) {
        if($result === FALSE) {
            $mysqli = conn::get();
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        if($result->num_rows < 1) return NULL;
        $row = $result->fetch_assoc();
        
        return static::row2obj($row);
    }
    protected function getList($result) {
        if($result === FALSE) {
            $mysqli = conn::get();
            throw new Exception($mysqli->error, $mysqli->errno);
        }
        $return = array();
        while($row = $result->fetch_assoc()) {
            $return[] = static::row2obj($row);
        }
        return $return;
    }
}

?>