<?php
class general
{
    public $connect;
    public $user_id;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function collectUserID()
    {
        if (isset($_SESSION["admin_id"])) {
            $this->user_id = $_SESSION["admin_id"];
        } else {
            header("location:../index.php");
        }
    }

    protected function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function displaySuccessMessage($href)
    {
        echo "
            <script>
                window.alert('Success!');
                window.location.href='" . $href . "';
            </script>
        ";
        die();
    }

    public function errorMessage($message)
    {
        echo '
            <script>
                window.alert("' . $message . '");
            </script>
        ';
    }
}

class dashboard extends general
{
    public $noOfUsers;
    public $noOfActiveFlights;
    public $noOfReservations;

    public function selectNoOfUsers()
    {
        $sql = $this->connect->query("SELECT COUNT(user_id) AS noOfUsers FROM `user`");
        $result = $sql->fetch_assoc();
        $this->noOfUsers = $result["noOfUsers"];
    }

    public function selectNoOfReservations()
    {
        $sql = $this->connect->query("SELECT COUNT(reservation_id) AS noOfReservations FROM `reservation`");
        $result = $sql->fetch_assoc();
        $this->noOfReservations = $result["noOfReservations"];
    }

    public function selectActiveFlights()
    {
        $sql = $this->connect->query("SELECT COUNT(flight_id) AS noOfActiveFlights FROM `flight` WHERE depature_date > CURRENT_DATE");
        $result = $sql->fetch_assoc();
        $this->noOfActiveFlights = $result["noOfActiveFlights"];
    }
}

class user_management extends general
{
    public $action_button;

    public function selectUsers()
    {
        $sql = $this->connect->query("SELECT * FROM `user`");
        return $sql;
    }

    // public function checkUsersStatus($user_status)
    // {
    //     switch ($user_status) {
    //         case 1:
    //             $this->action_button = '<button type="submit" name="change_status" value="1" class="btn btn-view">Make Inactive</button>';
    //             break;
    //         case 0:
    //             $this->action_button = '<button type="submit" name="change_status" value="0" class="btn btn-edit">Make Active</button>';
    //             break;
    //     }
    // }

    // public function changeUserStatus()
    // {
    //     $user_id = $this->validateInput($_POST["user_id"]);
    //     $user_current_status = $this->validateInput($_POST["change_status"]);
    //     echo $user_current_status;
    //     // echo $user_id;
    //     die();

    //     $sql = $this->connect->query("UPDATE `user` SET is_active = 0 WHERE user_id = '$user_id'");

    //     if ($sql) {
    //         $this->displaySuccessMessage("user_management.php");
    //     } else {
    //         $this->errorMessage($this->connect->error);
    //     }
    // }
}


class flight_management extends general
{
    public $depature_city;
    public $destination_city;
    public $depature_date;
    public $depature_time;
    public $amount;

    public $flight_id;



    public function selectFlights()
    {
        $sql = $this->connect->query("SELECT * FROM `flight`");
        return $sql;
    }

    public function collectFormInputs()
    {
        $this->depature_city = $this->validateInput($_POST["depature_city"]);
        $this->destination_city = $this->validateInput($_POST["destination_city"]);
        $this->depature_date = $this->validateInput($_POST["depature_date"]);
        $this->depature_time = $this->validateInput($_POST["depature_time"]);
        $this->amount = $this->validateInput($_POST["amount"]);
    }

    public function insertIntoDB()
    {
        $flight_id = "FlightA" . rand(100, 9999);
        $sql = $this->connect->query("INSERT INTO `flight` (flight_id,depature_city,destination_city,depature_date,depature_time,amount) VALUES ('$flight_id','$this->depature_city','$this->destination_city','$this->depature_date','$this->depature_time','$this->amount')");

        if ($sql) {
            $this->displaySuccessMessage("flight_management.php");
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function deleteFromDB()
    {
        $this->flight_id = $this->validateInput($_POST["flight_id"]);

        $sql = $this->connect->query("DELETE FROM `flight` WHERE flight_id = '$this->flight_id'");

        if ($sql) {
            $this->displaySuccessMessage("flight_management.php");
        } else {
            $this->errorMessage($this->connect->error);
        }
    }
}

class view_reservation extends general
{
    public function selectReservations()
    {
        $sql = $this->connect->query("SELECT * FROM `reservation` INNER JOIN `user` ON reservation.user_id = user.user_id INNER JOIN `flight` ON reservation.flight_id = flight.flight_id WHERE reservation.status IS NULL");
        return $sql;
    }

    public function cancelFlight()
    {
        $reservation_id = $this->validateInput($_POST["reservation_id"]);

        $sql = $this->connect->query("UPDATE `reservation` SET `status` = 'Cancelled', `cancelled_by` = 'admin' WHERE reservation_id = $reservation_id");

        if ($sql) {
            $this->displaySuccessMessage("reservation_statistics.php");
        } else {
            $this->errorMessage($this->connect->error);
        }
    }

    public function confirmFlight()
    {
        $reservation_id = $this->validateInput($_POST["reservation_id"]);

        $sql = $this->connect->query("UPDATE `reservation` SET `status` = 'Confirmed' WHERE reservation_id = $reservation_id");

        if ($sql) {
            $this->displaySuccessMessage("reservation_statistics.php");
        } else {
            $this->errorMessage($this->connect->error);
        }
    }
}

class reservation_hisotry extends general
{
    public $status_badge;

    public function selectReservations()
    {
        $sql = $this->connect->query("SELECT * FROM `reservation` INNER JOIN `user` ON reservation.user_id = user.user_id INNER JOIN `flight` ON reservation.flight_id = flight.flight_id");
        return $sql;
    }

    public function modifyReservationStatusTag($status, $cancelled_by)
    {
        if ($status == NULL) {
            $this->status_badge = '<span class="status-pending">Pending</span>';
        } elseif ($status === "Confirmed") {
            $this->status_badge = '<span class="status-completed">Confirmed</span>';
        } elseif ($status === "Cancelled" && $cancelled_by === "user") {
            $this->status_badge = '<span class="status-canceled">Cancelled by user</span>';
        } elseif ($status === "Cancelled" && $cancelled_by === "admin") {
            $this->status_badge = '<span class="status-canceled">Cancelled by admin</span>';
        }
    }
}
