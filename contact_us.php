<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Contact - BloodBank Management</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    #page-container {
      margin-top: 60px;
      min-height: 85vh;
      position: relative;
    }

    h1 {
      color: #dc3545;
      font-weight: 700;
      margin-bottom: 40px;
      text-align: center;
      letter-spacing: 1.2px;
    }

    .contact-form {
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgb(0 0 0 / 0.1);
      transition: box-shadow 0.3s ease;
    }

    .contact-form:hover {
      box-shadow: 0 10px 30px rgb(0 0 0 / 0.15);
    }

    .form-control:focus {
      box-shadow: 0 0 6px #dc3545;
      border-color: #dc3545;
    }

    label {
      font-weight: 600;
      color: #495057;
    }

    .btn-submit {
      background-color: #dc3545;
      border: none;
      font-weight: 600;
      padding: 12px 40px;
      font-size: 1.1rem;
      transition: background-color 0.3s ease;
      width: 100%;
      border-radius: 50px;
      margin-top: 20px;
    }

    .btn-submit:hover {
      background-color: #b02a37;
    }

    .contact-info {
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgb(0 0 0 / 0.1);
      height: 100%;
    }

    .contact-info h4 {
      font-weight: 700;
      color: #dc3545;
      margin-bottom: 25px;
    }

    .contact-info p {
      font-size: 1.1rem;
      color: #343a40;
      margin-bottom: 18px;
    }

    .alert {
      max-width: 700px;
      margin: 20px auto;
      font-size: 1.1rem;
      border-radius: 10px;
    }

    @media (max-width: 767.98px) {
      #page-container {
        margin-top: 30px;
      }
    }
  </style>
</head>

<body>
  <?php
  $active = 'contact';
  include 'head.php';
  ?>

  <div id="page-container" class="container">
    <h1>Contact Us</h1>

    <?php
    if (isset($_POST["send"])) {
      $name = htmlspecialchars($_POST['fullname']);
      $number = htmlspecialchars($_POST['contactno']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);

      $conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");
      $sql = "INSERT INTO contact_query (query_name, query_number, query_mail, query_message) VALUES ('{$name}', '{$number}', '{$email}', '{$message}')";
      $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Your query has been sent. We will contact you shortly.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';

      mysqli_close($conn);
    }
    ?>

    <div class="row">
      <div class="col-lg-7 mb-4">
        <form name="sentMessage" method="post" class="contact-form" novalidate>
          <div class="form-group">
            <label for="name">Full Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="fullname" required />
          </div>

          <div class="form-group">
            <label for="phone">Phone Number <span class="text-danger">*</span></label>
            <input type="tel" class="form-control" id="phone" name="contactno" required />
          </div>

          <div class="form-group">
            <label for="email">Email Address <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" required />
          </div>

          <div class="form-group">
            <label for="message">Message <span class="text-danger">*</span></label>
            <textarea rows="6" class="form-control" id="message" name="message" maxlength="999" style="resize:none" required></textarea>
          </div>

          <button type="submit" name="send" class="btn btn-submit">Send Message</button>
        </form>
      </div>

      <div class="col-lg-5">
        <div class="contact-info">
          <h4>Contact Details</h4>
          <p><strong>Address:</strong> SayedNagar, Dhaka, Bangladesh</p>
          <p><strong>Phone:</strong> <a href="tel:+8801768487848">01768487848</a></p>
          <p><strong>Email:</strong> <a href="mailto:iftfaisal120@gmail.com">iftfaisal120@gmail.com</a></p>
          <hr />
          <h5>We’re here to help you. Feel free to reach out!</h5>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
