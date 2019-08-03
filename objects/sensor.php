<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once('PHPMailer/src/Exception.php');
    require_once('PHPMailer/src/PHPMailer.php');
    require_once('PHPMailer/src/SMTP.php');

class Sensor{
    // Database connection and table name
    private $conn;
    private $table_name = "sensor";

    public $id;
    public $type;
    public $value;
    public $status;
    public $created;

    public function __construct($db){
        $this->conn = $db;
    }

	function read(){
        $query = "SELECT * FROM sensor WHERE type = ? ORDER BY created DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->type);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->type = $row['type'];
        $this->value = $row['value'];
        $this->status = $row['status'];
        $this->created = $row['created'];
    }

    function gets(){
        $query = "SELECT * FROM sensor WHERE type = ? ORDER BY created DESC LIMIT 12";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->type);
        $stmt->execute();

        return $stmt;
    }

    function create(){
        $getOne = $_GET["tipe"];
        $getTwo = $_GET["nilai"];
        $getThree = $_GET["deskrip"];
        
        $query = "INSERT INTO sensor (type, value, status) VALUES (:type, :value, :status)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':type', $getOne);
        $stmt->bindValue(':value', $getTwo);
        $stmt->bindValue(':status', $getThree);
/*
        if (isset($_GET["type"]) && !empty($_GET["type"])) {
            $getOne = $_GET["type"];
        }
        if (isset($_GET["value"]) && !empty($_GET["value"])) {
            $getTwo = $_GET["value"];
        }
        if (isset($_GET["status"]) && !empty($_GET["status"])) {
            $getThree = $_GET["status"];
        }
*/
        // Executed query
        if($getOne == 101 && $getTwo < 20 && !empty($getTwo) && !empty($getThree)) {
            $mail = new PHPMailer(true);

        	$mail->SMTPDebug = 0;
        	$mail->isSMTP();
        	$mail->Host = "smtp.gmail.com";
        	$mail->SMTPAuth = true;
        	$mail->Username = "gapkuid@gmail.com";
        	$mail->Password = "Jakarta*13";
        	$mail->SMTPSecure = "tls";
        	$mail->Port = 587;

        	$mail->From = "notifications@aquafish.id";
        	$mail->FromName = "Aquafish Alert";
            $mail->addAddress("prifkywahyu@gmail.com");
            $mail->addAddress("munaufal4@gmail.com");

        	$mail->Subject = "[Alert] Temperature Sensor = $getTwo";
            $mail->msgHTML("Hai! Aquafish mendeteksi bahwa nilai Temperature Sensor Anda sekarang adalah $getTwo dan itu mengindikasikan dalam keadaan dibawah normal.<br><br>Tapi jangan khawatir, pompa akan bekerja untuk Anda dalam menaikkan suhu dengan cara mengisi air akuarium.<br><br>Terima kasih, Aquafish Team.");
            $mail->AltBody = 'This is a plain-text message body';

        	if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        	}
        	else {
        	     $stmt->execute();
        	     return true;
        	}
        }
        elseif($getOne == 101 && $getTwo > 30 && !empty($getThree)) {
            $mail = new PHPMailer(true);

        	$mail->SMTPDebug = 0;
        	$mail->isSMTP();
        	$mail->Host = "smtp.gmail.com";
        	$mail->SMTPAuth = true;
        	$mail->Username = "gapkuid@gmail.com";
        	$mail->Password = "Jakarta*13";
        	$mail->SMTPSecure = "tls";
        	$mail->Port = 587;

        	$mail->From = "notifications@aquafish.id";
        	$mail->FromName = "Aquafish Alert";
            $mail->addAddress("prifkywahyu@gmail.com");
            $mail->addAddress("munaufal4@gmail.com");

        	$mail->Subject = "[Alert] Temperature Sensor = $getTwo";
            $mail->msgHTML("Hai! Aquafish mendeteksi bahwa nilai Temperature Sensor Anda sekarang adalah $getTwo dan itu mengindikasikan dalam keadaan diatas normal.<br><br>Tapi jangan khawatir, pompa akan bekerja untuk Anda dalam menurunkan suhu dengan cara mengurangi air akuarium.<br><br>Terima kasih, Aquafish Team.");
            $mail->AltBody = 'This is a plain-text message body';

        	if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        	}
        	else {
                $stmt->execute();
        	    return true;
        	}
         }
         elseif($getOne == 202 && $getTwo > 12 && !empty($getThree)) {
            $mail = new PHPMailer(true);

        	$mail->SMTPDebug = 0;
        	$mail->isSMTP();
        	$mail->Host = "smtp.gmail.com";
        	$mail->SMTPAuth = true;
        	$mail->Username = "gapkuid@gmail.com";
        	$mail->Password = "Jakarta*13";
        	$mail->SMTPSecure = "tls";
        	$mail->Port = 587;

        	$mail->From = "notifications@aquafish.id";
        	$mail->FromName = "Aquafish Alert";
            $mail->addAddress("prifkywahyu@gmail.com");
            $mail->addAddress("munaufal4@gmail.com");

        	$mail->Subject = "[Alert] Turbidity Sensor = $getTwo";
            $mail->msgHTML("Hai! Aquafish mendeteksi bahwa nilai Turbidity Sensor Anda sekarang adalah $getTwo dan itu mengindikasikan dalam keadaan air yang keruh.<br><br>Tapi jangan khawatir, pompa akan bekerja untuk Anda dalam meningkatkan kualitas air dengan cara menguras air akuarium.<br><br>Terima kasih, Aquafish Team.");
            $mail->AltBody = 'This is a plain-text message body';

        	if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        	}
        	else {
                $stmt->execute();
        	    return true;
        	}
         }
         elseif($getOne == 303 && $getTwo < 14 && !empty($getTwo) && !empty($getThree)) {
            $mail = new PHPMailer(true);

        	$mail->SMTPDebug = 0;
        	$mail->isSMTP();
        	$mail->Host = "smtp.gmail.com";
        	$mail->SMTPAuth = true;
        	$mail->Username = "gapkuid@gmail.com";
        	$mail->Password = "Jakarta*13";
        	$mail->SMTPSecure = "tls";
        	$mail->Port = 587;

        	$mail->From = "notifications@aquafish.id";
        	$mail->FromName = "Aquafish Alert";
            $mail->addAddress("prifkywahyu@gmail.com");
            $mail->addAddress("munaufal4@gmail.com");

        	$mail->Subject = "[Alert] Water Level Sensor = $getTwo";
            $mail->msgHTML("Hai! Aquafish mendeteksi bahwa nilai Water Level Sensor Anda berada pada $getTwo dan itu indikasi ketinggian air dalam keadaan dibawah normal.<br><br>Tapi jangan khawatir, pompa akan bekerja untuk Anda dalam menaikkan ketinggian air dengan cara mengisi air akuarium.<br><br>Terima kasih, Aquafish Team.");
            $mail->AltBody = 'This is a plain-text message body';

        	if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        	}
        	else {
                $stmt->execute();
        	    return true;
        	}
         }
         elseif($getOne == 303 && $getTwo > 23 && !empty($getThree)) {
            $mail = new PHPMailer(true);

        	$mail->SMTPDebug = 0;
        	$mail->isSMTP();
        	$mail->Host = "smtp.gmail.com";
        	$mail->SMTPAuth = true;
        	$mail->Username = "gapkuid@gmail.com";
        	$mail->Password = "Jakarta*13";
        	$mail->SMTPSecure = "tls";
        	$mail->Port = 587;

        	$mail->From = "notifications@aquafish.id";
        	$mail->FromName = "Aquafish Alert";
            $mail->addAddress("prifkywahyu@gmail.com");
            $mail->addAddress("munaufal4@gmail.com");

        	$mail->Subject = "[Alert] Water Level Sensor = $getTwo";
            $mail->msgHTML("Hai! Aquafish mendeteksi bahwa nilai Water Level Sensor Anda berada pada $getTwo dan itu indikasi ketinggian air dalam keadaan diatas normal.<br><br>Tapi jangan khawatir, pompa akan bekerja untuk Anda dalam menurunkan ketinggian air dengan cara menguras air akuarium.<br><br>Terima kasih, Aquafish Team.");
            $mail->AltBody = 'This is a plain-text message body';

        	if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        	}
        	else {
                $stmt->execute();
        	    return true;
        	}
         }
         else {
            $stmt->execute();
            return true;
        }

        return false;
    }
}
?>