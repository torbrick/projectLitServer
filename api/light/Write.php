<?php
header('Content-Type: application/json');
class Write
{
    private $light; //lights database
    private $database;
    private const LIGHT_STATE_ON = '1';
    private const LIGHT_STATE_OFF = '0';
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
    public function turnOnLightArray($light_array_num)
    {
        $lightState = Write::LIGHT_STATE_ON;
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
