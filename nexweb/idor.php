<?php
session_start();
include 'header.php';

if (!isset($_SESSION['loggedin'])) {
    echo "<div class='container'><h2>Access Denied</h2><p>You need to log in to access this page.</p></div>";
    include 'footer.php';
    exit;
}

$invoices = [
    1 => ['user' => 'user1', 'date' => '2025-01-10', 'amount' => '$200', 'status' => 'Paid'],
    2 => ['user' => 'user2', 'date' => '2025-01-12', 'amount' => '$350', 'status' => 'Pending'],
    3 => ['user' => 'user3', 'date' => '2025-01-15', 'amount' => '$150', 'status' => 'Paid']
];

if (!isset($_GET['invoice_id'])) {
    $default_invoice_id = 1;
    header("Location: idor.php?invoice_id=$default_invoice_id");
    exit;
}

$invoice_id = intval($_GET['invoice_id']);

if (array_key_exists($invoice_id, $invoices)) {
    $invoice = $invoices[$invoice_id];
} else {
    $invoice = null;
}

?>

<div class="container">
    <h2>View Invoice</h2>
    <?php if ($invoice): ?>
        <p><strong>User:</strong> <?php echo htmlspecialchars($invoice['user']); ?></p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($invoice['date']); ?></p>
        <p><strong>Amount:</strong> <?php echo htmlspecialchars($invoice['amount']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($invoice['status']); ?></p>
    <?php else: ?>
        <p>No invoice found for the given ID.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
