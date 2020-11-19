<?php
header('Content-Type: application/json');
class Write
{
    private $light; //lights database
    private $database;
    private const LIGHT_STATE_ON = 1;
    private const LIGHT_STATE_OFF = 0;
    function __construct()
    {
        include_once 'Database.php';
        include_once 'models/Light.php';
        // Instantiate DB & connect
        $db = new Database();
        $this->database = $db->connect();
        // Instantiate blog light object
        $this->light = new Light($this->database);
    }

    public function rowCountForLightArray($light_array_num){
        $countMatchQuery = 'SELECT *
                            FROM lit_schema.lights
                            WHERE
                            light_strip_owner = :owner';
        $countMatchStatement = $this->database->prepare($countMatchQuery);
        // Bind Data
        $countMatchStatement->bindParam(':owner', $light_array_num);
        $countMatchStatement->execute();
        return $countMatchStatement->rowCount();
    }

    public function turnOnLightArray($light_array_num)
    {
        $lightState = Write::LIGHT_STATE_ON;
        $query = 'UPDATE lights 
                SET 
                    state = :state
                WHERE
                    light_strip_owner = :owner';
        // $countMatchQuery = 'SELECT *
        //                     FROM lit_schema.lights
        //                     WHERE
        //                     light_strip_owner = :owner';
        // $countMatchStatement = $this->database->prepare($countMatchQuery);
        // // Bind Data
        // $countMatchStatement->bindParam(':owner', $light_array_num);
        // $countMatchStatement->execute();
        if($this->rowCountForLightArray($light_array_num) < 1){
            //no rows matched query
            return false;
        }

        $statment = $this->database->prepare($query);
        // Bind Data
        $statment->bindParam(':state', $lightState);
        $statment->bindParam(':owner', $light_array_num);
        if($statment->execute()){
            //check that there is at least 1 matching row
            //if($statment->fetchColumn() > 0){
                return true;
            //}
        }
        return false;



// if ($statment->execute()) {
        //     return true;
        // } else {
        //     // Print error if something goes wrong
        //     printf("Error: %s.\n", $statment->error);
        //     return false;
        // }


        // try {
        //     $query = 'UPDATE lights 
        //         SET 
        //             state = :state
        //         WHERE
        //             light_strip_owner = :owner';
        //     $statment = $this->database->prepare($query);
        //     // Bind Data
        //     $statment->bindParam(':state', $lightState);
        //     $statment->bindParam(':owner', $light_array_num);
        //     $statment->execute();           
        // } catch( PDOException $e ) {
        //     // Print error if something goes wrong
        //     printf("Error: %s.\n", $statment->error);
        //     return false;
        //     die("dead");
        //     return false;
        // }catch(Exception $e){
        //     return false;
        // }
        // return true;
    }

    public function turnOnSingleLight($light_num)
    {
        $lightState = Write::LIGHT_STATE_ON;
        $query = 'UPDATE lights 
                SET 
                    state = :state
                WHERE
                    light_id = :lightNum';

        $statment = $this->database->prepare($query);
        // Bind Data
        $statment->bindParam(':state', $lightState);
        $statment->bindParam(':lightNum', $light_num);

        if ($statment->execute()) {
            return true;
        } else {
            // Print error if something goes wrong
            printf("Error: %s.\n", $statment->error);
            return false;
        }
    }

    public function turnOffLightArray($light_array_num)
    {
        $lightState = Write::LIGHT_STATE_OFF;
        $query = 'UPDATE lights 
                SET 
                    state = :state
                WHERE
                    light_strip_owner = :owner';

        $statment = $this->database->prepare($query);
        // Bind Data
        $statment->bindParam(':state', $lightState);
        $statment->bindParam(':owner', $light_array_num);

        if ($statment->execute()) {
            return true;
        } else {
            // Print error if something goes wrong
            printf("Error: %s.\n", $statment->error);
            return false;
        }
    }
}
