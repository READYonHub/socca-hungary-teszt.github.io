<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>

<?php
$id = $_GET['id'];
if ($id) {
    include("../../connect.php");
    $sqlEdit = "SELECT * FROM news WHERE id = $id";
    $result = mysqli_query($conn, $sqlEdit);
} else {
    echo "Nincs ilyen poszt";
}

?>
<style>
    .n-container {
        display: flex;
        flex-direction: column;
        background-color: #252525;
        width: 100vw;
        gap: 10px;
        padding: 30px;
        color: #fff;
    }

    .n-container h1 {
        margin-bottom: 10px;
    }

    .n-container input {
        padding: 10px;
        max-width: 400px;
        border-radius: 8px;
        border: none;
    }

    .n-container textarea {
        padding: 10px;
        max-width: 400px;
        border-radius: 8px;
        border: none;
    }

    .n-container input[type="submit"] {
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
    }

    .n-container input[type="submit"]:hover {
        filter: brightness(.9);
    }
</style>
<form action="./news_process.php" method="post" class="n-container">
    <h1>Hír módosítása</h1>
    <?php
    while ($data = mysqli_fetch_array($result)) {
    ?>
        <label for="title">Cím:</label>
        <input type="text" name="title" id="title" placeholder="Cím" value="<?php echo $data['title']; ?>" required>

        <label for="content">Tartalom:</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Poszt" required><?php echo $data['content']; ?></textarea>

        <label for="summary">Összefoglaló:</label>
        <textarea name="summary" id="summary" cols="30" rows="10" placeholder="Összefoglaló" required><?php echo $data['summary']; ?></textarea>

        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <br>
        <input type="submit" value="Módosítás" name="update">
    <?php
    }
    ?>
</form>



<?php
include("../headers/footer.php");
?>