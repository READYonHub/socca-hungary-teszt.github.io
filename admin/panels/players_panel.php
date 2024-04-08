<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
} ?>
<?php
include("../headers/header.php");
?>


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

<div class="player-container">
    <h1>Műveletek</h1>
    <a href="../players/players_create.php" class="text-light text-decoration-none">Új Játékos</a>
    <a href="../players/players_existing.php" class="text-light text-decoration-none">Meglévő játékosok módosítása</a>
    <a href="../players/players_health.php" class="text-light text-decoration-none">Játékosok egészségügyi adatai</a>
    <a href="../players/players_qr_kod.php" class="text-light text-decoration-none">Játékos QR-kód létrehozása</a>
</div>

<style>
    .player-container {
        display: flex;
        flex-direction: column;
        padding: 30px;
        background-color: #252525;
        color: #fff;
        gap: 15px;
        width: 100vw;
    }

    .player-container a {
        text-decoration: none;
        padding: 10px;
        background-color: #d0d0d7;
        border-radius: 8px;
        color: #000;
        max-width: 300px;
    }

    .player-container a:hover {
        filter: brightness(.9);
    }
</style>

<?php
//include("./templates/visibility.php");
?>
<?php
include("../headers/footer.php");
?>