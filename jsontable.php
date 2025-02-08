<?php

include '../db.php'; // Make sure to include your database connection file

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS payments_json (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    payment_details JSON NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table payments created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Payment details to be inserted
$payments = [
    [
        "user_id" => 1,
        "payment_details" => [
        "amount" => 100,
        "currency" => "INR",
        "status" => "Paid"
        ]
    ]
];

$user_id = 1;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO payments_json (user_id, payment_details) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $payment_details_json);

foreach ($payments as $payment) {
    $user_id = $payment['user_id'];
    $payment_details_json = json_encode($payment['payment_details']);
    $stmt->execute();
}

echo "New records created successfully";

$stmt->close();
$conn->close();
?>
