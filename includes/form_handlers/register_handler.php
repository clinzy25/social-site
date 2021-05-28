  <?php
  $fname = '';
  $lname = '';
  $email = '';
  $email2 = '';
  $password = '';
  $password2 = '';
  $date = '';
  $error_array = []; // Declare empty array

  /**
   * @link https://meeraacademy.com/php-isset-function-check-if-variable-is-set/
   */
  if (isset($_POST['register_button'])) {
    //Register form values
    //strip_tags = remove html tags for security
    //$_POST selects reg_fname from form and stores it as $fname
    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_replace(' ', '', $fname); // Remove spaces
    $fname = ucfirst(strtolower($fname)); // Uppercase first letter only
    $_SESSION['reg_fname'] = $fname; //Stores first name into session variable, keeps values after register button is clicked

    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname;

    $email = strip_tags($_POST['reg_email']);
    $email = str_replace(' ', '', $email);
    $email = ucfirst(strtolower($email));
    $_SESSION['reg_email'] = $email;

    $email2 = strip_tags($_POST['reg_email2']);
    $email2 = str_replace(' ', '', $email2);
    $email2 = ucfirst(strtolower($email2));
    $_SESSION['reg_email2'] = $email2;

    $password = strip_tags($_POST['reg_password']);
    $_SESSION['reg_password'] = $password;
    $password2 = strip_tags($_POST['reg_password2']);
    $_SESSION['reg_password2'] = $password2;

    $date = date('Y-m-d');

    if ($email == $email2) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email is valid format
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        //Check if email already exists
        $e_check = mysqli_query(
          $con,
          "SELECT email FROM users WHERE email='$email'"
        );
        // Count number of rows returned
        $num_rows = mysqli_num_rows($e_check);
        if ($num_rows > 0) {
          array_push($error_array, 'Email already in use<br>');
        }
      } else {
        array_push($error_array, 'Invalid email format<br>');
      }
    } else {
      array_push($error_array, "Emails don't match<br>");
    }

    if (strlen($fname) > 25 || strlen($fname) < 2) {
      array_push(
        $error_array,
        'Your first name must be between 2 and 25 characters<br>'
      );
    }

    if (strlen($lname) > 25 || strlen($lname) < 2) {
      array_push(
        $error_array,
        'Your last name must be between 2 and 25 characters<br>'
      );
    }

    if ($password != $password2) {
      array_push($error_array, 'Your passwords do not match<br>');
    } else {
      if (preg_match('/[^A-Za-z0-9]/', $password)) {
        array_push(
          $error_array,
          'Your password can only contain English characters or numbers<br>'
        );
      }
    }

    if (strlen($password) > 30 || strlen($password) < 5) {
      array_push(
        $error_array,
        'Your password must be between 5 and 30 characters<br>'
      );
    }

    if (empty($error_array)) {
      $password = md5($password); //encrypt password for db
      // Generate username by concat first name and last name
      $username = strtolower($fname . '_' . $lname);
      $check_username_query = mysqli_query(
        $con,
        "SELECT username FROM users WHERE username='$username'"
      );
      $i = 0;
      // If username exists add number to username
      while (mysqli_num_rows($check_username_query) != 0) {
        $i++;
        $username = $username . '_' . $i;
        $check_username_query = mysqli_query(
          $con,
          "SELECT username FROM users WHERE username='$username'"
        );
      }
      // Profile pic assignment
      $rand = rand(1, 3);
      if ($rand == 1) {
        $profile_pic = 'assets/images/profile-pics/defaults/head_deep_blue.png';
      }
      if ($rand == 2) {
        $profile_pic =
          'assets/images/profile-pics/defaults/head_pomegranate.png';
      }
      if ($rand == 3) {
        $profile_pic = 'assets/images/profile-pics/defaults/head_wisteria.png';
      }

      // Insert into db
      $query = mysqli_query(
        $con,
        "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',' )"
      );
      array_push(
        $error_array,
        "<span style='color: #14C800;' >You're all set! Go ahead and login. </span><br>"
      );

      // Clear session vars
      $_SESSION['reg_fname'] = '';
      $_SESSION['reg_lname'] = '';
      $_SESSION['reg_email'] = '';
      $_SESSION['reg_email2'] = '';
      $_SESSION['reg_password'] = '';
      $_SESSION['reg_password2'] = '';
    }
  }

?>
