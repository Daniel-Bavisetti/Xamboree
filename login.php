<?php
session_start();
require_once('config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

$username = $_POST['username'];
$password = $_POST['password'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_phone = mysqli_real_escape_string($conn,$_POST['email_phn']);
    $password = mysqli_real_escape_string($conn,$_POST['password']); 

    $query = "SELECT * FROM users WHERE (email = '$email_or_phone' OR phone = '$email_or_phone')";
    $result = mysqli_query($conn,$query);
    $count = mysqli_num_rows($result);

    if($count == 1) {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $hashed_password = $row['password'];

        if(password_verify($password, $hashed_password)) {
            $_SESSION['login_user'] = $row['id'];
            header("location: dashboard.php");
        } else {
            $error = "Invalid Password";
        }
    } else {
        $error = "Email or Phone Number not found";
    }
}
?>

<?php if(isset($error)) { ?>
    <div><?php echo $error; ?></div>
<?php } ?>
