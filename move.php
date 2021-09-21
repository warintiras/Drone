<?PHP
    $ID = 1; //Testing
    $action = "RLE"; //Testing
    require_once 'configure.php';

    $database = "drone_move";

    $db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

    if ($db_found) {

        //Use UPDATE, need WHERE, when submitted create ID
        //$SQL = $db_found->prepare("INSERT INTO move (action) VALUES (?)");
        $SQL = $db_found->prepare("UPDATE move SET action=? WHERE ID=?");

        $SQL->bind_param('ss',  $action, $ID);
        $SQL->execute();

        $SQL->close();
        $db_found->close();

        print "UPDATE ID 1 completed";
    }
    else {
        print "Database NOT Found ";
    }


?>