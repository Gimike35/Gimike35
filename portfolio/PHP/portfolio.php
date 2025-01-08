<?php

include_once 'db_connect.php';
include 'header.php'; 
$crud = new CRUD(); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $data = [
        'project_title' => $_POST['project_title'],
        'project_description' => $_POST['project_description'],
        'project_image' => $_FILES['project_image']['name'] 
    ];

    
    if (isset($_POST['add'])) {
        
        move_uploaded_file($_FILES['project_image']['tmp_name'], "uploads/" . $data['project_image']);
        
        if ($crud->createContent('portfolio', $data)) {
            echo "<p>Portfolio item added successfully!</p>";
        } else {
            echo "<p>Error adding portfolio item.</p>";
        }
    }
    
    elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        
        if ($_FILES['project_image']['name']) {
            move_uploaded_file($_FILES['project_image']['tmp_name'], "uploads/" . $_FILES['project_image']['name']);
            $data['project_image'] = $_FILES['project_image']['name'];
        } else {
            unset($data['project_image']); }

        if ($crud->updateContent('portfolio', $data, $id)) {
            echo "<p>Portfolio item updated successfully!</p>";
        } else {
            echo "<p>Error updating portfolio item.</p>";
        }
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if ($crud->deleteContent('portfolio', $id)) {
        echo "<p>Portfolio item deleted successfully!</p>";
    } else {
        echo "<p>Error deleting portfolio item.</p>";
    }
}


$portfolioContent = $crud->getContent('portfolio');
?>

<div class="content">
    <h1>Manage Portfolio Section</h1>

    <!-- Form for adding new portfolio item -->
    <form method="POST" enctype="multipart/form-data">
        <label for="project_title">Project Title</label>
        <input type="text" name="project_title" id="project_title" placeholder="Project Title" required>
        
        <label for="project_description">Project Description</label>
        <textarea name="project_description" id="project_description" placeholder="Project Description" required></textarea>
        
        <label for="project_image">Project Image</label>
        <input type="file" name="project_image" id="project_image" required>
        
        <button type="submit" name="add">Add New Portfolio Item</button>
    </form>

    <h2>Existing Portfolio Items</h2>
    <?php if ($portfolioContent->num_rows > 0) { ?>
        <?php while ($row = $portfolioContent->fetch_assoc()) { ?>
            <div class="portfolio-item">
                <form method="POST" enctype="multipart/form-data">
                    <label for="project_title_<?php echo $row['id']; ?>">Project Title</label>
                    <input type="text" name="project_title" id="project_title_<?php echo $row['id']; ?>" value="<?php echo $row['project_title']; ?>" required>
                    
                    <label for="project_description_<?php echo $row['id']; ?>">Project Description</label>
                    <textarea name="project_description" id="project_description_<?php echo $row['id']; ?>" required><?php echo $row['project_description']; ?></textarea>
                    
                    <label for="project_image_<?php echo $row['id']; ?>">Project Image</label>
                    <input type="file" name="project_image" id="project_image_<?php echo $row['id']; ?>">
                    <img src="uploads/<?php echo $row['project_image']; ?>" alt="Project Image" style="width: 100px; height: auto;">

                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update">Update</button>
                </form>
                <a href="?delete=true&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this portfolio item?')">Delete</a>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No portfolio items available.</p>
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