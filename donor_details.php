<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php
// Show all errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if donor ID is passed in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Donor ID not provided.");
}

$donor_id = intval($_GET['id']);

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "blood_donation");
if (!$conn) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}

// Query the donor with blood group
$sql = "SELECT * FROM donor_details 
        JOIN blood ON donor_details.donor_blood = blood.blood_id 
        WHERE donor_id = $donor_id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("❌ Donor not found.");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-danger"><?php echo htmlspecialchars($row['donor_name']); ?>'s Profile</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>Blood Group:</strong> <?php echo $row['blood_group']; ?></li>
            <li class="list-group-item"><strong>Mobile No:</strong> <?php echo $row['donor_number']; ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?php echo $row['donor_mail']; ?></li>
            <li class="list-group-item"><strong>Gender:</strong> <?php echo $row['donor_gender']; ?></li>
            <li class="list-group-item"><strong>Age:</strong> <?php echo $row['donor_age']; ?></li>
            <li class="list-group-item"><strong>Address:</strong> <?php echo $row['donor_address']; ?></li>
        </ul>
        <a href="home.php" class="btn btn-secondary mt-4">← Back to Home</a>
    </div>
</div>

</body>
</html>
