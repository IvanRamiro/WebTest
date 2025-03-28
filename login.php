<?php
include('db.php');

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_SESSION['user_id'])) {
    header("Location: ADMIN DASHBOARD/dashboard.php");
    exit();
}
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill in both email and password.";
    } else {

      $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        $stmt->execute();
        $stmt->store_result();


        if ($stmt->num_rows > 0) {

          $stmt->bind_result($id, $db_email, $db_password);

            $stmt->fetch();

            if ($password === $db_password) {

              $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $db_email;

                $_SESSION['timeout'] = time();

                header("Location: ADMIN DASHBOARD/dashboard.php"); // Redirect to a protected page
                exit();
            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "No user found with that email.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
    
<section class="vh-100" style="background-color: #0a1473;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>

            <?php
            if (!empty($error)) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
            ?>

            <!-- Login Form -->
            <form method="POST" action="login.php">
                <div class="form-outline mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control form-control-lg" required />
                    </div>
                    <label class="form-label" for="typeEmailX-2">Email</label>
                </div>

                <div class="form-outline mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control form-control-lg" required />
                    </div>
                    <label class="form-label" for="typePasswordX-2">Password</label>
                </div>

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                <hr class="my-4">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>

<?php

$conn->close();
?>
