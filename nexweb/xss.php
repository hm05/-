<?php include 'header.php'; ?>
<div class="container">
    <h2>Cross-Site Scripting (XSS)</h2>
    <?php
    if (isset($_GET['input'])) {
        echo "You entered: " . htmlspecialchars($_GET['input'], ENT_QUOTES, 'UTF-8');
    }
    ?>
    <form method="GET">
        <input type="text" name="input">
        <button type="submit">Submit</button>
    </form>
</div>
<?php include 'footer.php'; ?>
