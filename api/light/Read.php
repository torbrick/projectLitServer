<?php
header('Content-Type: application/json');
class Read
{

    private $light; //lights database

    function __construct()
    {
        include_once 'Database.php';
        include_once 'models/Light.php';
        // Instantiate DB & connect
        $db = new Database();
        $database = $db->connect();
        // Instantiate blog light object
        $this->light = new Light($database);
    }

    public function readAllLights()
    {

        //light query
        $result = $this->light->read();
        // Get row count
        $num = $result->rowCount();

        // Check if any lights
        if ($num > 0) {
            // light array
            $lights_arr = array();
            // $lights_arr['data'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $light_item = array(
                    'id' => $light_id,
                    'light_strip_owner' => $light_strip_owner,
                    'state' => $state,
                    'red' => $red,
                    'green' => $green,
                    'blue' => $blue
                );

                // Push to "data"
                array_push($lights_arr, $light_item);
                // array_push($lights_arr['data'], $light_item);
            }

            // Turn to JSON & output
            echo json_encode($lights_arr);
            return;
        } else {
            // No lights
            echo json_encode(
                array('message' => 'No lights Found')
            );
            return;
        }
    }
    public function readOneLightArray($light_array_num)
    {
        //light query
        $result = $this->light->read_single_light_array($light_array_num);
        // Get row count
        $num = $result->rowCount();

        // Check if any lights
        if ($num > 0) {
            // light array
            $lights_arr = array();
            // $lights_arr['data'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $light_item = array(
                    'id' => $light_id,
                    'light_strip_owner' => $light_strip_owner,
                    'state' => $state,
                    'red' => $red,
                    'green' => $green,
                    'blue' => $blue
                );

                // Push to "data"
                array_push($lights_arr, $light_item);
                // array_push($lights_arr['data'], $light_item);
            }

            // Turn to JSON & output
            echo json_encode($lights_arr);
        } else {
            // No lights
            echo json_encode(
                array('message' => 'No lights Found')
            );
        }
    }
}
