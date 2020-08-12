
<?php 
if(isset($_SESSION['user_id'])){

    $the_user_id =$_SESSION['user_id'];
    $query=  "select * from users where user_id='{$the_user_id}'";
    $user_select_query=mysqli_query($connection,$query);
    confirmQuery($user_select_query);
    while($row=mysqli_fetch_assoc($user_select_query)){
        $user_id        = $row['user_id'];
        $user_username       = $row['user_username'];
        $user_password  = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $user_email     = $row['user_email'];
        $post_image     = $row['user_image'];
        $user_role      = $row['user_role'];


    
}
}
?>
       


<form action="" method="GET" enctype="multipart/form-data">        
    <div class="form-group ">
        <img width='350' height='250' src='../image/<?php echo $post_image?>' alt='image' >
    </div> <br><br>
     <div class="form-group">
          <label for="user_id">User ID:<?php echo $user_id; ?></label>
    </div>
    
    <div class="form-group">
          <label for="user_firstname">Firstname:<?php echo $user_firstname; ?></label>
    </div>
     <div class="form-group">
          <label for="user_lastname">Lastname:<?php echo $user_lastname; ?></label>
    </div>
    
    <div class="form-group">
          <label for="user_username">Username:<?php echo $user_username; ?></label>
    </div>
     <div class="form-group">
          <label for="user_email">E-mail:<?php echo $user_email; ?></label>
    </div>
     <div class="form-group">
          <label for="user_role">Role:<?php echo $user_role; ?></label>
    </div>
        <div class="form-group">
            <a href='profile.php?source=update_profile' class='btn  btn-info'>Update Profile </a>'
          
       </div> <div class="form-group">
              <a  href='profile.php?delete=<?php echo $user_id?>'class='btn  btn-info'>Delete Profile </a>
          
       </div>
 
 
 </form>

     <?php 
      if(isset($_GET['delete'])){
            if(isset($_SESSION['user_role'])){
              
            $the_user_id = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
            $delete_query = mysqli_query($connection,$query);
            confirmQuery($delete_query);
            
            header("location:../index.php");
            session_destroy();
                }}
            
        




?>





















                       
