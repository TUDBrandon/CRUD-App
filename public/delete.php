<?php

/**
 * Delete a user
 */

require "../config/common.php";

// Process delete operation after confirmation
if (isset($_POST["id"]) && isset($_POST["confirm"])) {
    try {
        require_once '../src/DBconnect.php';
        
        // Delete record
        $id = $_POST["id"];
        
        $sql = "DELETE FROM users WHERE id = :id";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        
        $success_message = "User successfully deleted";
        
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// Get all users
try {
    require_once '../src/DBconnect.php';
    
    $sql = "SELECT * FROM users";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    $result = $statement->fetchAll();
    
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($success_message)) : ?>
    <div class="success">
        <?php echo $success_message; ?>
    </div>
<?php endif; ?>

<h2>Delete users</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Age</th>
            <th>Location</th>
            <th>Date</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["id"]); ?></td>
            <td><?php echo escape($row["firstname"]); ?></td>
            <td><?php echo escape($row["lastname"]); ?></td>
            <td><?php echo escape($row["email"]); ?></td>
            <td><?php echo escape($row["age"]); ?></td>
            <td><?php echo escape($row["location"]); ?></td>
            <td><?php echo escape($row["date"]); ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo escape($row["id"]); ?>">
                    <input type="hidden" name="confirm" value="yes">
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
