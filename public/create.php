<?php

/**
 * Create a new user
 */

require "../config/common.php";

if (isset($_POST['submit'])) {
    require_once '../src/DBconnect.php';

    try {
        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname"  => $_POST['lastname'],
            "email"     => $_POST['email'],
            "age"       => $_POST['age'],
            "location"  => $_POST['location']
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        $success_message = "User successfully added";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php include "templates/header.php"; ?>

<?php if (isset($success_message)) : ?>
    <div class="success">
        <?php echo $success_message; ?>
    </div>
<?php endif; ?>

<h2>Add a user</h2>

<form method="post">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" required>
    
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" required>
    
    <label for="email">Email Address</label>
    <input type="email" name="email" id="email" required>
    
    <label for="age">Age</label>
    <input type="number" name="age" id="age">
    
    <label for="location">Location</label>
    <input type="text" name="location" id="location">
    
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
