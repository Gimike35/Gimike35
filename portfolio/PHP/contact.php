<?php

include_once 'db_connect.php';
include 'header.php'; 
$crud = new CRUD(); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $data = [
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address']
    ];

    
    if (isset($_POST['add'])) {
        if ($crud->createContent('contact', $data)) {
            echo "<p>Contact information added successfully!</p>";
        } else {
            echo "<p>Error adding contact information.</p>";
        }
    }
    
    elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        if ($crud->updateContent('contact', $data, $id)) {
            echo "<p>Contact information updated successfully!</p>";
        } else {
            echo "<p>Error updating contact information.</p>";
        }
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if ($crud->deleteContent('contact', $id)) {
        echo "<p>Contact information deleted successfully!</p>";
    } else {
        echo "<p>Error deleting contact information.</p>";
    }
}


$contactContent = $crud->getContent('contact');
?>

<div class="content">
    <h1>Manage Contact Section</h1>

    
    <form method="POST">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" placeholder="Phone" required>
        
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        
        <label for="address">Address</label>
        <textarea name="address" id="address" placeholder="Address" required></textarea>
        
        <button type="submit" name="add">Add New Contact Information</button>
    </form>

    <h2>Existing Contact Information</h2>
    <?php if ($contactContent->num_rows > 0) { ?>
        <?php while ($row = $contactContent->fetch_assoc()) { ?>
            <div class="contact-item">
                <form method="POST">
                    <label for="phone_<?php echo $row['id']; ?>">Phone</label>
                    <input type="text" name="phone" id="phone_<?php echo $row['id']; ?>" value="<?php echo $row['phone']; ?>" required>
                    
                    <label for="email_<?php echo $row['id']; ?>">Email</label>
                    <input type="email" name="email" id="email_<?php echo $row['id']; ?>" value="<?php echo $row['email']; ?>" required>
                    
                    <label for="address_<?php echo $row['id']; ?>">Address</label>
                    <textarea name="address" id="address_<?php echo $row['id']; ?>" required><?php echo $row['address']; ?></textarea>
                    
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update">Update</button>
                </form>
                <a href="?delete=true&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this contact information?')">Delete</a>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No contact information available.</p>
    <?php } ?>
</div>

<?php

include 'footer.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    
</body>
</html>