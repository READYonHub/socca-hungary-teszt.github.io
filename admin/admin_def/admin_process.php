<?php
/* Lapvédelem mindig legfelül*/
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}
?>
<!--Művelet értesítők create/edit/delete-->
<?php
if (isset($_SESSION["create"])) {
?>
    <div class="alert alert-success">
        <?php
        echo $_SESSION["create"];
        ?>
    </div>
<?php
    unset($_SESSION["create"]);
}
?>
<?php
if (isset($_SESSION["update"])) {
?>
    <div class="alert alert-success">
        <?php
        echo $_SESSION["update"];
        ?>
    </div>
<?php
    unset($_SESSION["update"]);
}
?>
<?php
if (isset($_SESSION["delete"])) {
?>
    <div class="alert alert-success">
        <?php
        echo $_SESSION["delete"];
        ?>
    </div>
<?php
    unset($_SESSION["delete"]);
}
?>
<style>
    .alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #a94442;
        padding: 15px;
        border-radius: 5px;
        z-index: 9999;
    }
</style>


<?php
if (isset($_POST["submit_a"])) {
    include("../../connect.php");

    $email      =   trim(strip_tags(strtolower(mysqli_real_escape_string($conn, $_POST["email"]))));
    $passwrd    =   trim(strip_tags(sha1(mysqli_real_escape_string($conn, $_POST["passwrd"]))));
    $date       =   mysqli_real_escape_string($conn, $_POST["date"]);

    $sqlCheck   =   "SELECT * FROM admin_default WHERE email = '$email'";
    $result     =   mysqli_query($conn, $sqlCheck);

    if (mysqli_num_rows($result) > 0) {
        echo <<<WARNING
        <?php echo $muvelet_ertesito ?>
        <div class="alert" role="alert">
            A megadott E-mail cím már használatban van! <button onclick="closeAlert()"><Értettem</button>
        </div>
        <script type="text/javascript">
            function closeAlert() {
                var alertBox = document.querySelector('.alert');
                alertBox.style.display = 'none';
                window.location.href = "../panels/admin_panel.php";
            }
        </script>
WARNING;
    } else {
        $sqlInsert = "INSERT INTO admin_default(date, email, passwrd) VALUES ('$date','$email', '$passwrd')";

        if (mysqli_query($conn, $sqlInsert)) {
            session_start();
            $_SESSION["submit_a"] = "Administrator added successfully";
            header("Location: ../panels/admin_panel.php");
        } else {
            die("Data is not inserted!");
        }
    }
}
?>