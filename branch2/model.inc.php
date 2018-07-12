<?php

Class Model
{

    public $x;
    public $y;
    public $f;
    public $action;

   public function Model()
    {
     //   $this->x = $x;
     //   $this->y = $y;
      //  $this->f = $f;
    }


/*    public function Model($x, $y, $f)
    {
        $this->x = $x;
        $this->y = $y;
        $this->f = $f;
    }
*/
    //Set value
    public function setX($data)
    {
        $this->x = $data;
    }

    public function setY($data)
    {
        $this->y = $data;
    }

    public function setF($data)
    {
        $this->f = $data;
    }

    public function setAction($data)
    {
        $this->action = $data;
    }

    //Get value
    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getF()
    {
        return $this->f;
    }

    public function getAction()
    {
        return $this->action;
    }

    function valid($x, $y, $f) {

        if (empty($f)) {
            return false;
        } else { //When textboxes are not empty, check if inputs are valid.
            if (($x >= 0 && $x <= 300) && ($y >= 0 && $y <= 300) && $this->chkF($f) == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    function chkF($data) {
        if ($data == "N" || $data == "S" || $data == "E" || $data == "W") return true;
        else return false;
    }

    function insertData($x, $y, $f) {

        $database = "drone_move";

        $db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

        if ($db_found) {

            $SQL = $db_found->prepare("INSERT INTO move2 (x, y, f) VALUES (?, ?, ?)");
            $SQL->bind_param('sss', $x, $y, $f);
            $SQL->execute();

            $SQL->close();
            $db_found->close();
        }
        else {
            print "Database NOT Found ";
        }
    }

    function updateAction($data) {

        $database = "drone_move";

        $db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

        if ($db_found) {

            $SQL = $db_found->prepare('SELECT MAX(ID) AS ID FROM move2');
            $SQL->execute();

            $result = $SQL->get_result();

            if ($result->num_rows >0) {

                $db_field = $result->fetch_assoc();

                $SQL = $db_found->prepare('SELECT move FROM move2 WHERE ID=?');
                $SQL->bind_param('s', $db_field['ID']);
                $SQL->execute();

                $result = $SQL->get_result();
                $db_action = $result->fetch_assoc();
                $data = $db_action['move'].$data;

                $SQL = $db_found->prepare("UPDATE move2 SET move=? WHERE ID=?");
                $SQL->bind_param('ss',  $data, $db_field['ID']);
                $SQL->execute();
            }
            else {
                $errorMessage = "username FAILED";
            }
            $SQL->close();
            $db_found->close();
        }
        else {
            print "Database NOT Found ";
        }
    }
}
?>