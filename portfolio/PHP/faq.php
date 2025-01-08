<?php

include_once 'db_connect.php';
include 'header.php'; 
$crud = new CRUD(); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $data = [
        'question' => $_POST['question'],
        'answer' => $_POST['answer']
    ];

   
    if (isset($_POST['add'])) {
        if ($crud->createContent('faq', $data)) {
            echo "<p>FAQ added successfully!</p>";
        } else {
            echo "<p>Error adding FAQ.</p>";
        }
    }
    
    elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        if ($crud->updateContent('faq', $data, $id)) {
            echo "<p>FAQ updated successfully!</p>";
        } else {
            echo "<p>Error updating FAQ.</p>";
        }
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if ($crud->deleteContent('faq', $id)) {
        echo "<p>FAQ deleted successfully!</p>";
    } else {
        echo "<p>Error deleting FAQ.</p>";
    }
}


$faqContent = $crud->getContent('faq');
?>

<div class="content">
    <h1>Manage FAQ Section</h1>

    
    <form method="POST">
        <label for="question">Question</label>
        <input type="text" name="question" id="question" placeholder="Enter your question" required>
        
        <label for="answer">Answer</label>
        <textarea name="answer" id="answer" placeholder="Enter your answer" required></textarea>
        
        <button type="submit" name="add">Add New FAQ</button>
    </form>

    <h2>Existing FAQs</h2>
    <?php if ($faqContent->num_rows > 0) { ?>
        <?php while ($row = $faqContent->fetch_assoc()) { ?>
            <div class="faq-item">
                <form method="POST">
                    <label for="question_<?php echo $row['id']; ?>">Question</label>
                    <input type="text" name="question" id="question_<?php echo $row['id']; ?>" value="<?php echo $row['question']; ?>" required>
                    
                    <label for="answer_<?php echo $row['id']; ?>">Answer</label>
                    <textarea name="answer" id="answer_<?php echo $row['id']; ?>" required><?php echo $row['answer']; ?></textarea>
                    
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update">Update</button>
                </form>
                <a href="?delete=true&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this FAQ?')">Delete</a>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No FAQs available.</p>
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