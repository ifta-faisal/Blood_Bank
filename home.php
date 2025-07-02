<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #f8f9fa;">
  <!-- Header Banner -->
  <div class="jumbotron jumbotron-fluid text-white" style="background: linear-gradient(to right, #e52d27, #b31217); padding: 4rem 2rem;">
    <div class="container text-center">
      <h1 class="display-4 font-weight-bold">Blood Bank</h1>
      <p class="lead">Donate blood, save lives. Your help matters more than ever.</p>
      <div class="d-flex justify-content-center flex-wrap gap-3">
        <a href="donate_blood.php" class="btn btn-outline-light btn-lg px-5 m-2">Become a Donor</a>
        <a href="need_blood.php" class="btn btn-light btn-lg px-5 m-2 text-danger font-weight-bold">Need Blood</a>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container">
    <h2 class="text-center text-dark mb-5">Our Top Donors</h2>
    <div class="row">
      <?php
      include 'conn.php';
      $sql = "SELECT * FROM donor_details 
              JOIN blood ON donor_details.donor_blood = blood.blood_id 
              ORDER BY RAND() LIMIT 6";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-4">
            <div class="card border-0 shadow-sm rounded w-100">
              <img src="image/blood_drop_log.jpg" class="card-img-top" alt="Blood Drop" style="height: 250px; object-fit: cover;">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title text-center text-danger font-weight-bold"><?php echo htmlspecialchars($row['donor_name']); ?></h5>
                <ul class="list-unstyled mb-4">
                  <li><strong>Blood Group:</strong> <span class="text-danger"><?php echo htmlspecialchars($row['blood_group']); ?></span></li>
                  <li><strong>Mobile No:</strong> <?php echo htmlspecialchars($row['donor_number']); ?></li>
                  <li><strong>Gender:</strong> <?php echo htmlspecialchars($row['donor_gender']); ?></li>
                  <li><strong>Age:</strong> <?php echo htmlspecialchars($row['donor_age']); ?></li>
                  <li><strong>Address:</strong> <?php echo htmlspecialchars($row['donor_address']); ?></li>
                </ul>
                <a href="donor_details.php?id=<?php echo $row['donor_id']; ?>" class="btn btn-outline-primary btn-block mt-auto">
                  Contact Donor
                </a>
              </div>
            </div>
          </div>
      <?php }
      } else { ?>
        <div class="col-12">
          <p class="text-center text-muted">No donors found at the moment.</p>
        </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>
