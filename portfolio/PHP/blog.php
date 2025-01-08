<?php

include_once 'db_connect.php';
include 'header.php'; 
$crud = new CRUD(); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $data = [
        'title' => $_POST['title'],
        'content' => $_POST['content']
    ];

   
    if (isset($_POST['add'])) {
        if ($crud->createContent('blog', $data)) {
            echo "<p>Blog post added successfully!</p>";
        } else {
            echo "<p>Error adding blog post.</p>";
        }
    }
   
    elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        if ($crud->updateContent('blog', $data, $id)) {
            echo "<p>Blog post updated successfully!</p>";
        } else {
            echo "<p>Error updating blog post.</p>";
        }
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if ($crud->deleteContent('blog', $id)) {
        echo "<p>Blog post deleted successfully!</p>";
    } else {
        echo "<p>Error deleting blog post.</p>";
    }
}


$blogContent = $crud->getContent('blog');
?>

<div class="content">
    <h1>Manage Blog Section</h1>

    
    <form method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Blog Title" required>
        
        <label for="content">Content</label>
        <textarea name="content" id="content" placeholder="Blog Content" required></textarea>
        
        <button type="submit" name="add">Add New Blog Post</button>
    </form>

    <h2>Existing Blog Posts</h2>
    <?php if ($blogContent->num_rows > 0) { ?>
        <?php while ($row = $blogContent->fetch_assoc()) { ?>
            <div class="blog-item">
                <form method="POST">
                    <label for="title_<?php echo $row['id']; ?>">Title</label>
                    <input type="text" name="title" id="title_<?php echo $row['id']; ?>" value="<?php echo $row['title']; ?>" required>
                    
                    <label for="content_<?php echo $row['id']; ?>">Content</label>
                    <textarea name="content" id="content_<?php echo $row['id']; ?>" required><?php echo $row['content']; ?></textarea>
                    
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update">Update</button>
                </form>
                <a href="?delete=true&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog post?')">Delete</a>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No blog posts available.</p>
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