<?php
session_start();
include 'header.php';

if (!isset($_SESSION['loggedin'])) {
    echo "<div class='container'><h2>Access Denied</h2><p>You need to log in to access this page.</p></div>";
    include 'footer.php';
    exit;
}

class User {
    public $username;
    public $role;

    public function __construct($username, $role) {
        $this->username = $username;
        $this->role = $role;
    }
}

if (!isset($_COOKIE['user_session'])) {
    $user = new User("regular_user", "user");
    $serializedData = serialize($user);
    setcookie('user_session', $serializedData, time() + 3600, "/");
    $message = "Welcome, new user! You are logged in as a regular user.";
    $showAdminButton = true;
} else {
    
    $cookieData = $_COOKIE['user_session'];
    $user = unserialize($cookieData);

    if ($user instanceof User) {
        $message = "Welcome back, " . htmlspecialchars($user->username) . "! Your role is: " . htmlspecialchars($user->role);

        
        if ($user->role === 'admin') {
            
            $showAdminButton = true;

            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $message = "Welcome to the Admin Panel!";
                $showAdminButton = false; 
            }
        } else {
            $showAdminButton = false; 
        }
    } else {
        $message = "Invalid session data.";
        $showAdminButton = false;
    }
}
?>

<div class="container">
    <h2>Session Management</h2>
    <p><?php echo $message; ?></p>
    <?php if (isset($showAdminButton) && $showAdminButton): ?>
        <div style="margin-top: 20px;">
            <form method="POST" action="">
                <button type="submit" class="btn-primary">Access Admin Panel</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
