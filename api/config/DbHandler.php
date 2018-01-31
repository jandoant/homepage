<?php
class DbHandler
{
    private $host = "localhost";
    private $db_name = "homepage";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function connect()
    {
        $this->conn=null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function disconnect(){
        $this->conn=null;
    }

    public function read_persons($person_id=null){
        
        if ($person_id == null){
            return $this->read_all_persons(); 
        } else {
            return $this->read_single_person($person_id);
        }
    }

    public function read_attendance(){
        $query = "SELECT 
                    persons.id AS person_id, 
                    persons.firstname AS firstname, 
                    events.id AS event_id, 
                    attendance.status_id 
                FROM events 
                CROSS JOIN persons 
                LEFT JOIN attendance 
                    ON persons.id = attendance.person_id 
                        AND events.id = attendance.event_id";
        
        $result = $this->query_db($query);

        $attendance_arr = array(); 

        if ($result->rowCount() > 0) {
            //create node in persons array            
            
            $attendance_arr["persons"] = array();
            
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            
            $prev_pid = 0; 
            $arr_index = -1; 
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                
                extract($row);

                $events_arr = array(
                    "id"=>$event_id,
                    "attendance_status"=>$status_id
                );

                if($prev_pid != $person_id){
                    $arr_index++;
                    $person_obj = array(
                        "id"=>$person_id,
                        "firstname"=>$firstname, 
                        "events"=>array(
                        ));
    
                    array_push($attendance_arr["persons"], $person_obj);
                }              

                array_push($attendance_arr["persons"][$arr_index]["events"],$events_arr ); 

                $prev_pid = $person_id; 
                    
            }               

            }
            //print_r($attendance_arr);
            return $attendance_arr;
        }



    private function query_db($query){
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single_person($person_id){
        
        $person_object = null; 

        $query = "SELECT * FROM persons WHERE id=".$person_id;       
        $result = $this->query_db($query);
        
        if ($result->rowCount() == 1){
            $row = $result->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $person_object = array(
                "id" => $id,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email);
        }
        return $person_object;
    }

    private function read_all_persons(){
        //init empty person arr
        $persons_arr = array();
        $query = "SELECT * FROM persons";
        $result = $this->query_db($query);

        if ($result->rowCount() > 0) {
            //create node in persons array
            $persons_arr["persons"] = array();

            // retrieve our table contents
            // fetch() is faster than fetchAll()
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                
                extract($row);

                $person_object = array(
                "id" => $id,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email);

                //person array füllenextract($row)extract($row);;
                array_push($persons_arr["persons"], $person_object);
            }            
        }
        return $persons_arr;
    }    
}
?>
