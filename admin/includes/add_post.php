<?php
if(isset($_POST['create_post'])) {
   $post_title        = escape( $_POST['title']);
   $post_catagory_id  = escape($_POST['post_catagory']);
   $post_status       = escape($_POST['post_status']);  
   $post_image        = escape(($_FILES['image']['name']));
   $post_image_temp   = escape(($_FILES['image']['tmp_name']));
   $post_auther       =escape($_SESSION['firstname']." ".$_SESSION['lastname']);
   $post_tags         = escape($_POST['post_tags']);
   $post_content      = escape($_POST['post_content']);
   $post_date         = escape(date('d-m-y'));


move_uploaded_file($post_image_temp, "../image/$post_image" );
 
$query = "INSERT INTO posts(post_catagory_id, post_title,post_auther, post_date,post_image,post_content,post_tags,post_status) ";
             
$query .= "VALUES({$post_catagory_id},'{$post_title}','{$post_auther}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";
$create_post_query = mysqli_query($connection, $query);  
confirmQuery($create_post_query);


$the_post_id=mysqli_insert_id($connection);///this gives recently inserted id of that post

echo "New Post Created" . " <a href='../post.php?p_id=$the_post_id' class='btn btn-primary btn-sm' >View Created Posts ?</a>";

echo  " <a href='posts.php' class='btn btn-info btn-sm' >Edit more Posts ?</a> <br><br><hr>";
}
?>
<form action="" method="post" enctype="multipart/form-data">   
     
     <div class="form-group">
        <label for="title">Post Title</label>
         <input type="text" class="form-control" name="title">
     </div>

    <div class="form-group">
      <label for="category">  Post Catagory</label>
      <select name="post_catagory" id="">
                                                         <?php  
                                                         //updating the post with cat_id and post_Catagory_id
                                                         $query = "SELECT * FROM catagories ";
                                                         $select_catagories = mysqli_query($connection,$query);
                                                         while($row = mysqli_fetch_assoc($select_catagories )) {
                                                         $cat_id = $row['cat_id'];
                                                         $cat_title = $row['cat_title'];
                                                         if($cat_id==$post_catagory_id){
                                                            echo "<option selected value='{$cat_id}'> $cat_title </option> ";
                                                         }

                                                         echo "<option  value='{$cat_id}'> $cat_title </option> ";
                                                         }
                                                         ?> 
                                                         </select> 









     </div> <br>
    


      <div class="form-group"> 
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
     </div>
     
     <br>   
     
   <div class="form-group">
        <label for="post_image">Post Image</label>
         <input type="file"  name="image">
     </div>
<br>
     <div class="form-group">
        <label for="post_tags">Post Tags</label>
         <input type="text" class="form-control" name="post_tags">
     </div>
     <br>
     <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control "name="post_content" id="" cols="30" rows="10">
        </textarea>
     </div>
     
     <br>

      <div class="form-group">
         <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
     </div>


</form>
   
