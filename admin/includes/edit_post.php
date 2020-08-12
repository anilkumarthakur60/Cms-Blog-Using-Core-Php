<?php 
if(isset($_GET['p_id'])){
   $the_post_id= $_GET['p_id'];

}
//query for the selecting the particular post having the id from search bar 
$query="SELECT * from posts where post_id=$the_post_id ";
$select_post_by_id =mysqli_query($connection,$query);

// display catagory query 
while($row=mysqli_fetch_assoc($select_post_by_id)){
               $post_id=$row['post_id']; 
               $post_title= $row['post_title'];
               $post_catagory_id= $row['post_catagory_id']; 
               $post_status =$row['post_status'];
               $post_image =$row['post_image'];
               $post_tags =$row['post_tags'];
               $post_content=$row['post_content'];
               $post_comment_count =$row['post_comment_count'];
               $post_date =$row['post_date']; 
               $post_auther=$row['post_auther'];
}
//geting data from form 
if(isset($_POST['update_post'])) {
  $post_title          = escape( $_POST['post_title']);
  $post_catagory_id    =  escape($_POST['post_catagory']);
  $post_status         =  escape($_POST['post_status']);
  $post_image          = escape( $_FILES['image']['name']);
  $post_image_temp     = escape( $_FILES['image']['tmp_name']);
  $post_content        = escape( $_POST['post_content']);
  $post_tags           = escape( $_POST['post_tags']);
  $post_auther=escape($_POST['post_auther']);
              move_uploaded_file($post_image_temp,"../image/$post_image");
              //image update query 
              if(empty($post_image)) {
        
               $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
               $select_image = mysqli_query($connection,$query);
                   
               while($row = mysqli_fetch_array($select_image)) {
                   
                  $post_image = $row['post_image']; 
               
               }
               
               
       }
   //post updating query
    
   $query = "UPDATE posts SET ";
   $query .="post_title  = '{$post_title}', ";
   $query .="post_catagory_id = '{$post_catagory_id}', ";
   $query .="post_date   =  now(), ";
   $query .="post_status = '{$post_status}', ";
   $query .="post_tags   = '{$post_tags}', ";
   $query .="post_content= '{$post_content}', ";
   $query .="post_image  = '{$post_image}', ";
   
   $query .="post_auther  = '{$post_auther}' ";
   $query .= "WHERE post_id = {$the_post_id} ";
 
 $update_post = mysqli_query($connection,$query);
confirmQuery($update_post);

echo "Post Updated" . " <a href='../post.php?p_id=$the_post_id' class='btn btn-primary btn-sm' >View Edited Posts ?</a>";

echo  " <a href='posts.php' class='btn btn-info btn-sm' >Edit more Posts ?</a> <br><br><hr>";

}
?>

<form action="" method="post" enctype="multipart/form-data">    
     
     <div class="form-group">
        <label for="title">Post Title</label>
         <input type="text" value="<?php echo  $post_title;  ?>" class="form-control" name="post_title">
     </div>

     <div class="form-group">
       <label for="catagory">Post By </label>
       
                                                        <select name="post_auther" id="">
                                                         <?php  
                                                         //updating the post with cat_id and post_Catagory_id
                                                         $query = "SELECT * FROM users ";
                                                         $select_auther = mysqli_query($connection,$query);
                                                         while($row = mysqli_fetch_assoc($select_auther)) {
                                                         $user_id = $row['user_id'];
                                                         $user_name = $row['user_firstname']." ".$row['user_lastname']  ;                                                   
                                                         if($user_name==$post_auther){
                                                            echo "<option selected  value='{$post_auther}'> $post_auther </option> ";                                                         
                                                         }
                                                         else{
                                                            echo "<option   value='{$user_name}'> $user_name  </option> ";                                                         
                                                         }                                                           
                                                         }
                                                         ?>
                                                         </select> 
    </div> <br>

    <div class="form-group">
       <label for="catagory">Post Catagory </label>
       
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

      <?php 
      //updating post status
      ?>
    <label for="post_status">Post Status</label>       
      <select name="post_status" id="">
          
          <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>
                    
                    <?php
                     if($post_status == 'published') {
          
                        echo "<option value='draft'>draft</option>";
                     
                     } else {
                     
                       echo "<option value='published'>publish</option>";
                     
                     }
                  ?>
                </select>
     </div><br>  

   <div class="form-group">
       <label for="post_image">post image</label> <br>
       <img width="100" src="../image/<?php echo $post_image; ?>" alt="">
       <input  type="file" name="image">
     </div><br>


     <div class="form-group">
        <label for="post_tags">Post Tags</label>
         <input type="text" value="<?php echo  $post_tags;  ?>"   class="form-control" name="post_tags">
     </div><br>

     <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control "  name="post_content" id="" cols="30" rows="10"><?php echo str_replace('\r\n','</br>',$post_content);  ?>
        </textarea>
     </div><br>

      <div class="form-group">
         <input class="btn btn-primary" type="submit" name="update_post" value="Publish Edited Post">
     </div>


</form>




