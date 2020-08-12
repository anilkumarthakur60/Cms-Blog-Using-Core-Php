<?php 

function redirect($location){

    return header("location".$location);
}

function escape($string){
global $connection;
return mysqli_real_escape_string($connection,$string);

}

 
function confirmQuery($result){
    
    global $connection;
    if(!$result){
        die("query failled". mysqli_error($connection) ) ;
     }
}


function user_online(){

    if(isset($_GET['onlineuser'])){
        
    global $connection; 

if(!$connection){
    session_start();
    include "../include/db.php";
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 5;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM user_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

        if($count == NULL) {

        mysqli_query($connection, "INSERT INTO user_online(session, time) VALUES('$session','$time')");
        } else {

        mysqli_query($connection, "UPDATE user_online SET time = '$time' WHERE session = '$session'");
        }
    $users_online_query =  mysqli_query($connection, "SELECT * FROM user_online WHERE time > '$time_out'");
    echo $count_user = mysqli_num_rows($users_online_query);


            } //!connection end here
        }//end of get request
}
user_online();//function call for user online






function insert_catagory(){
    
                    global $connection;                           
if(isset($_POST['submit'])){
    $cat_title=$_POST['cat_title'];
    if($cat_title==""||empty($cat_title)){
        echo "invalid field";
    }
    else{
        $query="insert into catagories(cat_title)";
        $query.="value('{$cat_title}')";
        $create_catagory_query=mysqli_query($connection,$query);
        if(!$create_catagory_query){
            die('query failed'.mysqli_error($connection));
        }
    }
                            }
}




function find_all_catagories(){
    global $connection;
    

                                    // find all catagory query
                                    $query="select  * from catagories  ";
                                    $select_catagories=mysqli_query($connection,$query);

                                    // display catagory query
                                    while($row=mysqli_fetch_assoc($select_catagories)){
                                    $cat_id=$row['cat_id']; 
                                    $cat_title= $row['cat_title'];
                                    echo "<tr>";
                                    echo "<td scope='row'> {$cat_id}</td>";
                                    echo "<td> {$cat_title}</td>";


                                    // delete query statement
                                    echo "<td><a href='catagories.php?delete={$cat_id}'class='btn btn-danger btn-sm'>Delete</a></td>"; 
                                    
                                    echo "<td><a href='catagories.php?edit={$cat_id}' class='btn btn-info btn-sm'>Edit</a></td>"; 
                                    
                                    echo "</tr>";

                                    }
}


function delete_catagory(){
global $connection;

    
if(isset($_GET['delete'])){
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM catagories WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection,$query);
    header("location:catagories.php");
    
    }
}


function recordcount($table){
global $connection;
    $query = "SELECT * FROM ".$table;
    $select_all_post = mysqli_query($connection,$query);
    $result= mysqli_num_rows($select_all_post);
    confirmQuery($result);
    return $result;
}


function checkstatus($table,$column,$status){

global $connection;
 $query = "SELECT * FROM $table WHERE $column = '$status' ";
 $result = mysqli_query($connection,$query);
 return mysqli_num_rows($result);
 
}



function username_exists($username){

    global $connection;

    $query = "SELECT user_username FROM users WHERE user_username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }





}



function email_exists($email){

    global $connection;


    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {
 
        return false;

    }



}

function register_user($username, $email, $password){

    global $connection;

        $username = escape($username);
        $email    = escape($email);
        $password = escape($password);

        $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));
            
        $query="INSERT into users (user_username,user_password,user_email,user_role,user_status) 
        values ('{$username}','{$password}','{$email}','subscriber','deactive')";
        $register_user_query = mysqli_query($connection, $query);

        confirmQuery($register_user_query);
        echo " <h4 style='color:green; text-align:center'> registration succesful please contact your admin to approve your account </h4>";

        



}









?>