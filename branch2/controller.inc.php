<?php
require_once('model.inc.php');

Class Controller
{
    public $model;

    public function Controller()
    {
        $this->model = new Model();
    }

    public function show()
    {
        if (isset($_POST["submit_bttn"])) {

            $result = $this->model->valid($_POST["x"], $_POST["y"], $_POST["f"]);

            if ($result == true) {
                require_once 'main.php';
                require_once 'configure.php';

                $this->model->setX($_POST["x"]);
                $this->model->setY($_POST["y"]);
                $this->model->setF($_POST["f"]);

                $this->model->insertData($_POST["x"], $_POST["y"], $_POST["f"]);

            } else {
                require_once 'login.php';
            }
        } else if (isset($_POST["submit_move"])) {
            require_once 'main.php';
            require_once 'configure.php';

            $this->model->updateAction("m");

        } else if (isset($_POST["submit_left"])) {
            require_once 'main.php';
            require_once 'configure.php';

            $this->model->updateAction("L");

        } else if (isset($_POST["submit_right"])) {
            require_once 'main.php';
            require_once 'configure.php';

            $this->model->updateAction("R");

        } else if (isset($_POST["submit_report"])) {
            require_once 'main.php';

            echo "Report: --- Not Done---"; //Not working

        } else {
        require_once 'login.php';

        }

    }
}

?>
