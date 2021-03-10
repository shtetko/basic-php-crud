<?php
    session_start();
	include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Basic PHP CRUD</title>
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
                                    Posts Title
                                </div>
                            </div>
                            <div class="col">
                                <a href="post-create.php" class="btn btn-primary float-right">+ Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <?php if($_SESSION['successMsg']): ?>
                        <div class="alert alert-success alert-dismissible">
                            <span><?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg']); ?></span>
                            <button class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php endif ?>
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            		$query = "SELECT * FROM posts";
                            		$row = mysqli_query($conn, $query);
                            		
                            		foreach( $row as $post ) {
                            	?>
                            	<tr>
                                    <td><?php echo $post['id']; ?></td>
                                    <td><?php echo $post['title']; ?></td>
                                    <td><?php echo $post['description']; ?></td>
                                    <td>
                                        <a href="post-edit.php?postId=<?php echo $post['id']; ?>">Edit</a> |
                                        <a href="#" data-id="<?php echo $post['id']; ?>" onclick="deletePost(this)">Delete</a>
                                    </td>
                                </tr>
                            	<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        // delete post
    	if ( isset($_GET['postId']) ) {
    	    $postId = $_GET['postId'];
    	    $deleteQuery = mysqli_query($conn, "DELETE FROM posts WHERE id=$postId");
    	    
    	    if ($deleteQuery) {
    	        $_SESSION['successMsg'] = 'A post deleted successfully.';
    	        header('Location: index.php');
    	    }
    	}
    ?>
    <script>
       const deletePost = (ele) => {
           const postId = ele.getAttribute('data-id');
           const _confirm = confirm("Are you want to delete post?");
           
           if ( _confirm ) {
               location.href = `index.php?postId=${postId}`;
           }
       }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>