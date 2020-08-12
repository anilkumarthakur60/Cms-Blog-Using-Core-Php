<?php 
include "db.php";

include "../admin/functions.php";
session_start();
?>

<?php 
if(isset($_POST['login'])){
    $username=escape($_POST['username']);
    $password=escape($_POST['password']);
    
  
    
   
$query="SELECT * from users where user_username='{$username}' ";
$select_user=mysqli_query($connection,$query);
confirmQuery($select_user);
// display catagory query
while($row=mysqli_fetch_assoc($select_user)){
     $db_user_id=$row['user_id'];
    $db_user_username=$row['user_username'];
     $db_user_password=$row['user_password'];
     $db_user_firstname=$row['user_firstname'];
     $db_user_lastname=$row['user_lastname'];
     
     $db_user_email=$row['user_email'];
     $db_user_role=$row['user_role'];
     $db_user_status=$row['user_status'];
     

}
if($db_user_status=='active'){
 if(password_verify($password,$db_user_password) ){
    $_SESSION['user_id']=$db_user_id;  
    $_SESSION['username']=$db_user_username;    
    $_SESSION['firstname']=$db_user_firstname;    
    $_SESSION['lastname']=$db_user_lastname;      
    $_SESSION['user_role']=$db_user_role;
    $_SESSION['user_status']=$db_user_status;
    
    
    
    header("Location:../admin/");
    
}}
else{
    header("Location:../index.php");
}






}





?>





