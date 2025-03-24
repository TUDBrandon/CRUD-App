<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 */

require "../config/common.php";

if (isset($_POST['submit'])) {
  try {
    require_once '../src/DBconnect.php';

    $user = [
      "id"        => $_POST['id'],
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location']
    ];

    $sql = "UPDATE users 
            SET id = :id, 
              firstname = :firstname, 
              lastname = :lastname, 
              email = :email, 
              age = :age, 
              location = :location 
            WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->execute($user);

    $success_message = "User successfully updated";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

// Get the user to edit
if (isset($_GET["id"])) {
  try {
    require_once '../src/DBconnect.php';

    $id = $_GET["id"];

    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "Something went wrong!";
  exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($success_message)) : ?>
  <div class="success">
    <?php echo $success_message; ?>
  </div>
<?php endif; ?>

<h2>Edit a user</h2>

<form method="post">
  <input name="id" type="hidden" id="id" value="<?php echo escape($user["id"]); ?>">
  
  <label for="firstname">First Name</label>
  <input type="text" name="firstname" id="firstname" value="<?php echo escape($user["firstname"]); ?>" required>
  
  <label for="lastname">Last Name</label>
  <input type="text" name="lastname" id="lastname" value="<?php echo escape($user["lastname"]); ?>" required>
  
  <label for="email">Email Address</label>
  <input type="email" name="email" id="email" value="<?php echo escape($user["email"]); ?>" required>
  
  <label for="age">Age</label>
  <input type="number" name="age" id="age" value="<?php echo escape($user["age"]); ?>">
  
  <label for="location">Location</label>
  <input type="text" name="location" id="location" value="<?php echo escape($user["location"]); ?>">
  
  <input type="submit" name="submit" value="Submit">
</form>

<a href="update.php">Back to update page</a>

<?php require "templates/footer.php"; ?>
