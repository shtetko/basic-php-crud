<?php
    session_start();
    include('connect.php');
    
    $titleError = '';
    $descriptionError = '';
    
    if (isset($_GET['postId'])) {
        $post_id_to_update = $_GET['postId'];
        $row = mysqli_query($conn, "SELECT * FROM posts WHERE id=$post_id_to_update");
        
        if (mysqli_num_rows($row)) {
            foreach ($row as $post) {
                $title = $post['title'];
                $description = $post['description'];
            }
        }
    }
    
    if (isset($_POST['post_create_btn'])) {
        $postId = mysqli_real_escape_string($conn, $_POST['postId']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
        if (empty($title)) {
        	$titleError = 'The title field is required.';
        }
        
        if (empty($description)) {
        	$descriptionError = 'The description filed is required.';
        }
        
        if (!empty($title) && !empty($description)) {
        	$query = "UPDATE posts SET title='$title', description='$description' WHERE id=$postId"; 
        	
        	if (!mysqli_query($conn, $query)) {
        		echo mysqli_error($conn);
        	} else {
        	    $_SESSION['successMsg'] = 'A post updated successfully.';
        		header("location:index.php");
        	}
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Edit Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="card-title">
                                    Post Edition Form
                                </div>
                            </div>
                            <div class="col">
                                <a href="index.php" class="btn btn-dark float-right">&lt;&lt; Back</a>
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form">
                        <input type="hidden" value="<?php echo $post_id_to_update;?>" name="postId" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" placeholder="Enter title" value="<?php echo $title; ?>" class="form-control <?php if (!empty($titleError)) echo 'is-invalid'; ?>" />
                                <span class="text-danger" ><?php echo $titleError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control <?php if (!empty($descriptionError)) echo 'is-invalid'; ?>" placeholder="Description ..." name="description"><?php echo $description; ?></textarea>
                                <span class="text-danger" ><?php echo $descriptionError; ?></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" name="post_create_btn">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>.