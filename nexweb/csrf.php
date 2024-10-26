<?php
session_start();
include 'header.php';

if (!isset($_SESSION['loggedin'])) {
    echo "<div class='container'><h2>Access Denied</h2><p>You need to log in to access this page.</p></div>";
    include 'footer.php';
    exit;
}

$current_email = "user@email.com";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_email = $_POST['email'];
    echo "<div class='container'><h3>Email successfully updated to: $new_email</h3></div>";
}

?>
<div class="container">
    <h2>Account Settings</h2>
    <p>Current Email: <?php echo $current_email; ?></p>
    <form method="POST" action="">
        <label for="email">New Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Update Email</button>
    </form>
</div>
<?php include 'footer.php'; ?>
