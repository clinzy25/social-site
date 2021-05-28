<?php
include 'includes/header.php';
include 'includes/classes/Users.php';
include 'includes/classes/Post.php';

if (isset($_POST['post'])) {
  $post = new Post($con, $userLoggedIn);
  $post->submitPost($_POST['post-text'], 'none');
  header("Location: index.php");
}
?>

  <!-- User details -->
    <div class="user-details column">
      <a href="<?php echo $userLoggedIn; ?>"> 
        <img src="<?php echo $user['profile_pic']; ?>" alt="">
      </a>
      <div class="user-details-left-right">
        
      <a href="<?php echo $userLoggedIn; ?>">
      <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>
      </a>
      <br>
      <?php
      echo 'Posts: ' . $user['num_posts'] . '<br>';
      echo 'Likes: ' . $user['num_likes'];
      ?>
      </div>
    </div>
    
    <!-- News feed column -->
    <div class="main-column column">
      <form action="index.php" class="post-form" method="POST" >
        <textarea name="post-text" id="post-text" placeholder="Got something to say?"></textarea>
        <input type="submit" name='post' id='post-button' value='Post'>
        <hr>
      </form>
    </div>
  </div>
</body>
</html>