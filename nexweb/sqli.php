<?php include 'header.php'; ?>
<div class="container">
    <h2>SQL Injection (SQLi)</h2>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "testdb");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $mysqli->query("SELECT * FROM users WHERE id = $id");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "User: " . $row["username"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    }
    $mysqli->close();
    ?>
    <form method="GET">
        <input type="text" name="id" placeholder="Enter User ID">
        <button type="submit">Submit</button>
    </form>
</div>
<?php include 'footer.php'; ?>
