<?php 
if(isset($_POST['checkBoxArray'])){
  
    
    foreach($_POST['checkBoxArray'] as $postValueId ){
        
        $bulk_options = $_POST['bulk_options'];
              

    switch($bulk_options) {

              case 'active':              
                    $query = "UPDATE users SET user_status = '{$bulk_options}' WHERE user_id = {$postValueId}  ";              
                    $update_to_published_status = mysqli_query($connection,$query);       
                    confirmQuery($update_to_published_status); 
               break;

               case 'deactive':
                    $query = "UPDATE users SET user_status = '{$bulk_options}' WHERE user_id = {$postValueId}  ";              
                    $update_to_published_status = mysqli_query($connection,$query);       
                    confirmQuery($update_to_published_status); 
                  
                   break;
                case 'delete':
                    $query = "DELETE FROM users WHERE user_id = '{$postValueId}' ";
                    $delete_query = mysqli_query($connection,$query);     
                    confirmQuery($delete_query); 

                    break;

                case 'admin':
                    $query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id = {$postValueId}  ";              
                    $update_to_published_status = mysqli_query($connection,$query);       
                    confirmQuery($update_to_published_status); 
                    break;
                 
                case 'subscriber':
                    $query = "UPDATE users SET user_role = '{$bulk_options}' WHERE user_id = {$postValueId}  ";              
                    $update_to_published_status = mysqli_query($connection,$query);       
                    confirmQuery($update_to_published_status); 
                 break;
                        
                    default:
                    # code...
                    break;
            }
    }
}


?>








<form action="" method="POST">



<table class="table  table-hover table-bordered"  style="background-color:white;" >
                    <div id="bulkOptionContainer" class="col-xs-4" style="padding-left: 0px;">

                    <select class="form-control" name="bulk_options" id="">
                            <option value="">Select Options</option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                            
                            <option value="admin">Admin</option>
                            <option value="subscriber">Subscriber</option>
                            <option value="delete">Delete</option>
                    </select>

                    </div> 

                        
                    <div class="col-xs-4">

                    <input     type="submit" name="submit" class="btn btn-success   " onclick="return confirm('Are you sure!?')" value="Apply"      >
                    <a class="btn btn-primary" href="users.php?source=add_user">Add New Users</a> <br><br>

                    </div>
 

                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>ID</th>
                                    <th>username</th>
                                    <th>password</th>
                                    <th>firstname </th>
                                    <th>last name</th> 
                                    <th>email</th> 
                                    <th>image</th>
                                    <th>role</th>
                                    <th>randsalt</th>                                    
                                    <th>activate/ <br>deactivate</th>   
                                    <th>Delete/ <br> Edit</th>   
                                    <th>User Status</th>

                                </tr>
                            </thead>
<tbody>
  <?php 

$query="SELECT * from users  ";
$select_user=mysqli_query($connection,$query);
// display catagory query
while($row=mysqli_fetch_assoc($select_user)){
$user_id=$row['user_id']; 
$user_username =$row['user_username'];
$user_password= substr($row['user_password'],0,10);
$user_firstname= $row['user_firstname']; 
$user_lastname =$row['user_lastname'];
$user_email =$row['user_email'];
$user_image =$row['user_image'];
$user_role =$row['user_role'];
$randSalt =$row['randSalt']; 
$user_status =$row['user_status'];




echo "<tr>";  ?>

<td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $user_id; ?>"></td>
<?php
echo "<td scope='row'> {$user_id}</td>";
echo "<td> {$user_username}</td>";
echo "<td> {$user_password}</td>"; 
echo "<td> {$user_firstname}</td>";
echo "<td> {$user_lastname}</td>";
echo "<td> {$user_email}</td>"; 
echo "<td><img width='100' height='40' src='../image/$user_image' alt='image'></td>";  
echo "<td> {$user_role}</td>";   
echo "<td> {$randSalt}</td>";
echo "<td> <a  onClick=\"javascript:return confirm('are you sure you want to activate');\" href='users.php?active=$user_id'  class=' btn btn-sm btn-success ' > activate</a> 
         <a  onClick=\"javascript:return confirm('are you sure you want to Deactivate');\" href='users.php?deactive=$user_id' class='btn btn-sm btn-danger' >deactivate </a> 
           </td>";//push id into search bar
echo "<td> <a  onClick=\"javascript:return confirm('are you sure you want to Delete');\" href='users.php?delete={$user_id}' class='btn btn-sm btn-danger' >Delete</a> 
            
       <a  onClick=\"javascript:return confirm('are you sure you want to edit');\" class='btn btn-sm btn-info' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            
echo "<td> {$user_status}</td>"; 
echo "</td>";
}
?>
                            </tbody>
                        </table>
</form>

<?php 

//delete post query   after getting the delete parameter from the echo "<td> <a href='posts.php?delete={$post_id}'>Delete</a>   </td>"
if(isset($_GET['delete'])){
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){

            $the_user_id =mysqli_real_escape_string ($connection,$_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
            $delete_query = mysqli_query($connection,$query);
            header("location:users.php");
        }

    

    
    }
}

if(isset($_GET['active'])){
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){
        $the_user_id = $_GET['active'];
        $query = "UPDATE users SET user_status = 'active' WHERE user_id = {$the_user_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("location:users.php");
        }
    }
}
    
if(isset($_GET['deactive'])){
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){

    $the_post_id = $_GET['deactive'];
    $query = "UPDATE users SET user_status = 'deactive' WHERE user_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection,$query);
    header("location:users.php");
        }}
    }







    //edit post query


?>

