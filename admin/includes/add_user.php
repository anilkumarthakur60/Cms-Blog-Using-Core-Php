

<?php
if(isset($_POST['create_user'])) {
   $user_firstname  =escape( $_POST['user_firstname']);
   $user_lastname   = escape($_POST['user_lastname']);
   $user_email      =escape( $_POST['user_email']);
   $user_username   =escape($_POST['user_username']);
   $user_password   = escape($_POST['user_password']);
   $user_cpasswor   = escape($_POST['user_cpassword']);
   $user_role       = escape($_POST['user_role']);
   $user_image      = escape(($_FILES['image']['name']));
   $user_image_temp = escape(($_FILES['image']['tmp_name']));
   $user_status=escape($_POST['user_status']);


   
move_uploaded_file($user_image_temp, "../image/$user_image" );

// //encrypt password
// $query="SELECT randSalt from users";
// $select_randsalt_query=mysqli_query($connection,$query);
// confirmQuery($select_randsalt_query);

// $row=mysqli_fetch_array($select_randsalt_query);
// $salt=$row['randSalt'];
// $password=crypt($user_password,$salt);//end of encrypt password


$password= password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>12));
                

$query ="INSERT INTO users(user_username, user_password, user_firstname, user_lastname, user_email, user_role, user_status,user_image)
                     VALUES ( '{$user_username}','{$password}','{$user_firstname}','{$user_lastname}','{$user_email}','$user_role', 'deactive'     ,'{$user_image}'   )";



$create_user_query = mysqli_query($connection, $query);  
confirmQuery($create_user_query);

echo "User Created: " . " " . "<a href='users.php' class='btn btn-sm btn-info'>View Users</a> "; 
}
?>
<form action="" method="post" enctype="multipart/form-data">    
     
     <div class="form-group"> 
        <label for="user_firstname">First Name</label>
         <input type="text" class="form-control" name="user_firstname">
     </div> 
     
     <div class="form-group">
        <label for="user_lastname">Last Name</label>
         <input type="text" class="form-control" name="user_lastname">
     </div> 
     
     <div class="form-group">
        <label for="user_email">E-mail</label>
         <input type="email" class="form-control" name="user_email">
     </div> 
     
     <div class="form-group">
        <label for="user_username">Username</label>
         <input type="text" class="form-control" name="user_username">
     </div> 
     <div class="form-group">
        <label for="user_password">Password</label>
         <input type="password" class="form-control" name="user_password">
     </div> 
     
     <div class="form-group">
        <label for="user_cpassword">Confirm Password</label>
         <input type="password" class="form-control" name="user_cpassword">
     </div> 
    <div class="form-group"> 
          <label for="user_role">User Role</label>
        <select name="user_role" id="">
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
     </div>
     
   <div class="form-group">
        <label for="post_image">User Image</label>
         <input type="file"  name="image">
     </div>

     <div class="form-group"> 
          <label for="user_status">User staus</label>
        <select name="user_status" id="">
            <option value="active">active</option>
            <option value="deactive">deactive</option>
        </select>
     </div>







    <div class="form-group">
         <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
     </div>


</form>
   


