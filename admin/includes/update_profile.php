<?php 
if(isset($_SESSION['user_id'])){
   $the_user_id= $_SESSION['user_id'];

}
$query="SELECT * from users where user_id=$the_user_id ";
$select_post_by_id =mysqli_query($connection,$query);

// display catagory query 
while($row=mysqli_fetch_assoc($select_post_by_id)){
    $user_id = $row['user_id'];
    $user_username = $row['user_username'];
    $old_password= $row['user_password'];//db password 
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $post_image =$row['user_image'];
    $user_status=$row['user_status'];
}
//geting data from form 
if(isset($_POST['update_post'])) {
    $user_firstname =escape( $_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_username = escape($_POST['user_username']);
    $user_email = escape($_POST['user_email']);
    $new_password = escape($_POST['user_password']);//new entered password
    $post_image          =  $_FILES['image']['name'];
    $post_image_temp     =  $_FILES['image']['tmp_name'];
    $user_status=escape($_POST['user_status']);
    
              move_uploaded_file($post_image_temp,"../image/$post_image");
              //image update query 
              if(empty($post_image)) {
        
               $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
               $select_image = mysqli_query($connection,$query);
                   
               while($row = mysqli_fetch_array($select_image)) {
                   
                  $post_image = $row['user_image']; 
               
               }
               
               
       }

       if(!empty($new_password)){

       
      
        if($new_password!=$old_password){
 
          $hash_password= password_hash($new_password,PASSWORD_BCRYPT,array('cost'=>12));
        }
        else{
          $hash_password=$old_password;
 
        }
       }
       else{
          $hash_password=$old_password;
 
       }
   $query ="UPDATE `users` SET 
   `user_username`= '{$user_username}',
   `user_password`='{$hash_password}',
   `user_firstname`='{$user_firstname}',
   `user_lastname`='{$user_lastname}',
   `user_email`='{$user_email}',
   `user_image`='{$post_image}',
   
   `user_status`='{$user_status}'
   
   WHERE user_id = {$the_user_id} ";
 
 $update_post = mysqli_query($connection,$query);
confirmQuery($update_post);

echo "Profile Updated" . " <a href='profile.php' class='btn btn-primary btn-sm' >View profile ?</a> <br><br><hr>";

}


?>



<form action="" method="POST" enctype="multipart/form-data">    
     
     
     
     <div class="form-group">
        <label for="title">Firstname</label>
         <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
     </div>
     
     
     

      <div class="form-group">
        <label for="post_status">Lastname</label>
         <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
     </div>
    
    
     

     <div class="form-group">
      <label for="user_image">user image</label> <br>
      <img width="100" src="../image/<?php echo $post_image; ?>" alt="user_image">
      <input  type="file" name="image">
    </div><br>

     <div class="form-group">
        <label for="post_tags">Username</label>
         <input type="text" value="<?php echo $user_username; ?>" class="form-control" name="user_username">
     </div>
     
     <div class="form-group">
        <label for="post_content">Email</label>
         <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
     </div>
     
     <div class="form-group">
        <label for="post_content">Password</label>
         <input type="password" value="<?php echo $old_password; ?>" class="form-control" name="user_password">
     </div>
    
      <div class="form-group">
       <label for="user_status">User Statur:</label>
       <select name="user_status" id="">
       
    <option value="<?php echo $user_status; ?>"><?php echo $user_status; ?></option>
       <?php 

          if($user_status== 'active') {
          
             echo "<option value='deactive'>deactie</option>";
          
          } else {
          
            echo "<option value='active'>active</option>";
          
          }
    
      ?>
        
       </select>
       
      </div>
      


      <div class="form-group">
         <input class="btn btn-primary" type="submit" name="update_post" value="Update Profile">
     </div>


</form>
   
           
