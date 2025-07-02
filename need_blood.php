<?php
include 'conn.php';

$donors = [];
$noDonorsFound = false;

if (isset($_POST['search'])) {
    $bg = $_POST['blood'] ?? '';

    if ($bg !== '') {
        // Prepare statement to get donors with matching blood group
        $stmt = $conn->prepare("SELECT donor_details.*, blood.blood_group 
                                FROM donor_details 
                                JOIN blood ON donor_details.donor_blood = blood.blood_id 
                                WHERE donor_blood = ? 
                                ORDER BY RAND() LIMIT 5");
        $stmt->bind_param("i", $bg);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $donors[] = $row;
            }
        } else {
            $noDonorsFound = true;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Need Blood - BloodBank Management</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <style>
    body { background-color: #f9f9f9; }
    .page-header {
      color: #dc3545;
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 40px;
      text-align: center;
      letter-spacing: 1.5px;
    }
    .btn-search {
      background-color: #dc3545;
      border: none;
      font-weight: 600;
      padding: 12px 30px;
      font-size: 1.1rem;
      transition: background-color 0.3s ease;
      width: 100%;
      margin-top: 24px;
    }
    .btn-search:hover {
      background-color: #b02a37;
    }
    .card {
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
      border-radius: 10px;
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-6px);
    }
    .card-img-top {
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      height: 280px;
      object-fit: cover;
    }
    .alert {
      max-width: 700px;
      margin: 40px auto 0;
      font-size: 1.1rem;
    }
    .results-row {
      margin-top: 40px;
    }
  </style>
</head>
<body>

<?php 
$active = 'need';
include('head.php'); 
?>

<div class="container" style="min-height: 84vh; padding: 20px;">
  <h1 class="page-header">Need Blood</h1>

  <form method="post" novalidate>
    <div class="form-row justify-content-center">
      <div class="form-group col-md-5">
        <label for="blood">Blood Group <span class="text-danger">*</span></label>
        <select name="blood" id="blood" class="form-control" required>
          <option value="" selected disabled>Select blood group</option>
          <?php
            $bgResult = $conn->query("SELECT * FROM blood");
            while ($bgRow = $bgResult->fetch_assoc()) {
              $selected = (isset($_POST['blood']) && $_POST['blood'] == $bgRow['blood_id']) ? 'selected' : '';
              echo '<option value="'.htmlspecialchars($bgRow['blood_id']).'" '.$selected.'>'.htmlspecialchars($bgRow['blood_group']).'</option>';
            }
          ?>
        </select>
      </div>

      <div class="form-group col-md-7">
        <label for="reason">Reason for Blood Need <span class="text-danger">*</span></label>
        <textarea class="form-control" id="reason" name="address" rows="2" placeholder="Explain why you need blood" required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
      </div>
    </div>

    <button type="submit" name="search" class="btn btn-search">Search Donors</button>
  </form>

  <?php if (isset($_POST['search'])): ?>
    <div class="row results-row justify-content-center">
      <?php if (!$noDonorsFound): ?>
        <?php foreach ($donors as $donor): ?>
          <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
            <div class="card">
              <img src="image/blood_drop_log.jpg" class="card-img-top" alt="Blood Drop" />
              <div class="card-body">
                <h5 class="card-title text-danger font-weight-bold"><?php echo htmlspecialchars($donor['donor_name']); ?></h5>
                <p class="card-text mb-1"><strong>Blood Group:</strong> <?php echo htmlspecialchars($donor['blood_group']); ?></p>
                <p class="card-text mb-1"><strong>Mobile No.:</strong> <?php echo htmlspecialchars($donor['donor_number']); ?></p>
                <p class="card-text mb-1"><strong>Gender:</strong> <?php echo htmlspecialchars($donor['donor_gender']); ?></p>
                <p class="card-text mb-1"><strong>Age:</strong> <?php echo htmlspecialchars($donor['donor_age']); ?></p>
                <p class="card-text mb-0"><strong>Address:</strong> <?php echo htmlspecialchars($donor['donor_address']); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="alert alert-danger text-center">No donors found for the selected blood group.</div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

</div>

</body>
</html>
