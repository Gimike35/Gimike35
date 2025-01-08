<?php


include_once 'CRUD.php'; 


include_once 'db_connect.php';
$crud = new CRUD();


$aboutContent = $crud->getContent('about');
$servicesContent = $crud->getContent('services');
$portfolioContent = $crud->getContent('portfolio');
$testimonialsContent = $crud->getContent('testimonials');
$blogContent = $crud->getContent('blog');
$contactContent = $crud->getContent('contact');
$faqContent = $crud->getContent('faq');
$footerContent = $crud->getContent('footer');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Portfolio</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

    <!-- Header Section -->
    <header>
        <h1>Your Portfolio Name</h1>
        <nav>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
        </nav>
    </header>

    <!-- About Section -->
    <section id="about">
        <h2>About</h2>
        <?php while ($row = $aboutContent->fetch_assoc()) { ?>
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['content']; ?></p>
        <?php } ?>
    </section>

    <!-- Services Section -->
    <section id="services">
        <h2>Services</h2>
        <?php while ($row = $servicesContent->fetch_assoc()) { ?>
            <div class="service">
                <h3><?php echo $row['service_name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
            </div>
        <?php } ?>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio">
        <h2>Portfolio</h2>
        <?php while ($row = $portfolioContent->fetch_assoc()) { ?>
            <div class="project">
                <h3><?php echo $row['project_title']; ?></h3>
                <p><?php echo $row['project_description']; ?></p>
                <img src="uploads/<?php echo $row['project_image']; ?>" alt="Project Image">
            </div>
        <?php } ?>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials">
        <h2>Testimonials</h2>
        <?php while ($row = $testimonialsContent->fetch_assoc()) { ?>
            <div class="testimonial">
                <p>"<?php echo $row['testimonial']; ?>"</p>
                <h4>- <?php echo $row['client_name']; ?></h4>
            </div>
        <?php } ?>
    </section>

    <!-- Blog Section -->
    <section id="blog">
        <h2>Blog</h2>
        <?php while ($row = $blogContent->fetch_assoc()) { ?>
            <div class="blog-post">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['content']; ?></p>
                <small>Posted on: <?php echo $row['created_at']; ?></small>
            </div>
        <?php } ?>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <h2>Contact</h2>
        <?php while ($row = $contactContent->fetch_assoc()) { ?>
            <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
        <?php } ?>
    </section>

        <!-- FAQ Section -->
        <section id="faq">
        <h2>Frequently Asked Questions</h2>
        <?php while ($row = $faqContent->fetch_assoc()) { ?>
            <div class="faq-item">
                <h3><?php echo $row['question']; ?></h3>
                <p><?php echo $row['answer']; ?></p>
            </div>
        <?php } ?>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Portfolio Name. All rights reserved.</p>
        <?php while ($row = $footerContent->fetch_assoc()) { ?>
            <p><?php echo $row['content']; ?></p>
        <?php } ?>
    </footer>

</body>
</html>