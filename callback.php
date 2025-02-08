<?php
require_once('../db.php');

// Get the data sent via GET method
$data = $_GET;

// Check if the data is valid
if (isset($data['razorpay_payment_link_status']) && $data['razorpay_payment_link_status'] == 'paid') {
    // Payment successful
    $payment_id = $data['razorpay_payment_link_id'];

    // Update the enrollments table
    $stmt = $conn->prepare("UPDATE enrollments SET status = 'completed' WHERE payment_id = ?");
    $stmt->bind_param("s", $payment_id);

    if ($stmt->execute()) {
        // Payment status updated successfully
        $message = "Thank you for your payment! Your transaction was successful.";
    } else {
        // Error updating payment status
        $message = "Error updating payment status: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Payment failed or some error occurred
    $message = "Payment failed or was not completed.";
}

// Optionally, you can log the callback data to a file for debugging
file_put_contents('razorpay_callback_log.txt', print_r($data, true), FILE_APPEND);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .confirmation-container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .confirmation-container h1 {
            color: #333;
        }
        .confirmation-container p {
            color: #666;
            margin: 15px 0;
        }
        .confirmation-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .confirmation-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h1><?php echo htmlspecialchars($message); ?></h1>
        <?php if (isset($data['razorpay_payment_link_id'])): ?>
            <p>Your Payment ID: <?php echo htmlspecialchars($data['razorpay_payment_link_id']); ?></p>
        <?php endif; ?>
        <a href="index.php">Return to Home</a>
    </div>
</body>
</html>
