<?php
class general
{
    public $connect;
    public $user_id;

    public $fullname;
    public $email;
    public $password;

    public $noOfQuestions;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function collectUserID()
    {
        if (isset($_SESSION["user_id"])) {
            $this->user_id = $_SESSION["user_id"];
            $this->collectUserDetails();
        } else {
            header("location:../index.php");
            die();
        }
    }

    public function collectUserDetails()
    {
        $sql = $this->connect->query("SELECT * FROM `user` WHERE user_id = $this->user_id");
        $result = $sql->fetch_assoc();

        $this->fullname = $result["fullname"];
        $this->email = $result["email"];
        $this->password = $result["password"];
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

final class dashboard extends general {}

final class flight_booking extends general
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
    }
    public function returnSearchResult()
    {
        $sql = $this->connect->query("SELECT * FROM `flight` WHERE depature_city = '$this->depature_city' OR destination_city = '$this->destination_city' OR depature_date = '$this->depature_date'");
        if ($sql->num_rows > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function bookFlight()
    {
        $this->flight_id = $this->validateInput($_POST["flight_id"]);

        if ($this->checkIfFlightExist($this->flight_id)) {
            $this->errorMessage("Sorry! You have already booked for this flight. Kindly check your flight history");
        } else {
            $sql = $this->connect->query("INSERT INTO `reservation` (flight_id,user_id) VALUES ('$this->flight_id',$this->user_id)");

            if ($sql) {
                $this->displaySuccessMessage("booking.php");
            } else {
                $this->errorMessage($this->connect->error);
            }
        }
    }

    public function checkIfFlightExist($flight_id)
    {

        $sql = $this->connect->query("SELECT * FROM `reservation` WHERE flight_id = '$flight_id' AND user_id = $this->user_id");

        if (!$sql->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }
}

final class reservation_management extends general
{
    public function selectUsersReservations()
    {
        $sql = $this->connect->query("SELECT * FROM `reservation` INNER JOIN `user` ON reservation.user_id = user.user_id INNER JOIN `flight` ON reservation.flight_id = flight.flight_id WHERE reservation.user_id = $this->user_id AND reservation.status IS NULL");
        return $sql;
    }

    public function cancelFlight()
    {
        $reservation_id = $this->validateInput($_POST["reservation_id"]);

        $sql = $this->connect->query("UPDATE `reservation` SET `status` = 'Cancelled', `cancelled_by` = 'user' WHERE reservation_id = $reservation_id");

        if ($sql) {
            $this->displaySuccessMessage("reservation_management.php");
        } else {
            $this->errorMessage($this->connect->error);
        }
    }
}

final class flight_history extends general
{
    public function selectConfirmedReservations()
    {
        $sql = $this->connect->query("SELECT * FROM `reservation` INNER JOIN `user` ON reservation.user_id = user.user_id INNER JOIN `flight` ON reservation.flight_id = flight.flight_id WHERE reservation.user_id = $this->user_id AND reservation.status = 'Confirmed'");
        return $sql;
    }

    public function selectCancelledReservations()
    {
        $sql = $this->connect->query("SELECT * FROM `reservation` INNER JOIN `user` ON reservation.user_id = user.user_id INNER JOIN `flight` ON reservation.flight_id = flight.flight_id WHERE reservation.user_id = $this->user_id AND reservation.status = 'Cancelled'");
        return $sql;
    }
}
