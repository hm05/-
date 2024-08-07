<?php
session_start();
include 'header.php';
?>
<div class="container">
    <h2>Login</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Vulnerable SQL Query
        $conn = new mysqli("localhost", "root", "", "testdb");
        $result = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

        if ($result->num_rows > 0) {
            $_SESSION['loggedin'] = true;
            header('Location: index.php');
            exit;
        } else {
            echo "Invalid credentials.";
        }
    }
    ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
<?php include 'footer.php'; ?>
