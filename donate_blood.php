<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Donate Blood - BloodBank Management</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .page-header {
      background: #dc3545;
      color: white;
      padding: 30px 0;
      margin-bottom: 40px;
      border-radius: 6px;
      box-shadow: 0 4px 10px rgb(220 53 69 / 0.4);
      text-align: center;
      font-weight: 700;
      font-size: 2.5rem;
      letter-spacing: 2px;
    }

    .form-label {
      font-weight: 600;
      color: #495057;
    }

    .btn-submit {
      background-color: #dc3545;
      border: none;
      font-weight: 600;
      padding: 12px 30px;
      font-size: 1.1rem;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    .btn-submit:hover {
      background-color: #b02a37;
    }

    textarea.form-control {
      resize: vertical;
    }

    @media (min-width: 768px) {
      .form-container {
        max-width: 700px;
        margin: 0 auto;
      }
    }
  </style>
</head>

<body>
  <?php
    $active = 'donate';
    include('head.php');
  ?>

  <div id="page-container" style="min-height: 84vh; padding: 20px;">
    <div class="container form-container bg-white p-4 rounded shadow-sm">
      <div class="page-header">Donate Blood</div>

      <form name="donor" action="savedata.php" method="post" novalidate>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="fullname" class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your full name" required />
          </div>

          <div class="form-group col-md-6">
            <label for="mobileno" class="form-label">Mobile Number <span class="text-danger">*</span></label>
            <input type="tel" class="form-control" id="mobileno" name="mobileno" placeholder="e.g. 017XXXXXXXX" required pattern="[0-9]{10,15}" />
          </div>
        </div>

        <div class="form-group">
          <label for="emailid" class="form-label">Email ID</label>
          <input type="email" class="form-control" id="emailid" name="emailid" placeholder="your.email@example.com" />
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
            <input type="number" min="18" max="65" class="form-control" id="age" name="age" placeholder="18-65" required />
          </div>

          <div class="form-group col-md-4">
            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
            <select id="gender" name="gender" class="form-control" required>
              <option value="" disabled selected>Select gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="form-group col-md-4">
            <label for="blood" class="form-label">Blood Group <span class="text-danger">*</span></label>
            <select id="blood" name="blood" class="form-control" required>
              <option value="" disabled selected>Select blood group</option>
              <?php
                include 'conn.php';
                $sql = "SELECT * FROM blood";
                $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <option value="<?php echo $row['blood_id']; ?>"><?php echo $row['blood_group']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
          <textarea id="address" name="address" class="form-control" rows="3" placeholder="Your address" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-submit">Submit</button>
      </form>
    </div>
  </div>

</body>

</html>
