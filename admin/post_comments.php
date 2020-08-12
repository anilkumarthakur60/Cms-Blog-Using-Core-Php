
<?php
include"includes/admin_header.php";
?>
    <div id="wrapper">
        <!-- Navigation -->
    <?php
    include "includes/admin_navigation.php";
    ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome To Comment.
                        <small>
                        <?php
                        if(isset($_SESSION['username'])){
                         echo $_SESSION['username'];
                        }
                        ?>

                        </small>
                        </h1> 
                       
<table class="table  table-hover table-bordered"  style="background-color:white;">
                            <thead>
                                <tr>
                                    <th>Comment ID</th>
                                    <th>Comment auther</th>
                                    <th>Comments</th>                                  
                                    <th>Commenter Email </th>                                     
                                    <th>Comment Status</th>                                    
                                    <th>In Response To Post</th>                                      
                                    <th>Comment Date</th>
                                    <th>Comment Approve</th>                                    
                                    <th>Comment unapprove</th>
                                    <th>Comments Delete</th>   
                                    
                                </tr>
                            </thead>
                            <tbody>
  <?php  


$query="SELECT * FROM comments where comment_post_id =" .mysqli_real_escape_string($connection,$_GET['id'])." ";
$select_comments=mysqli_query($connection,$query);


// display catagory query
while($row=mysqli_fetch_assoc($select_comments)){
$comment_id=$row['comment_id']; 
$comment_post_id =$row['comment_post_id'];
$comment_auther= $row['comment_auther'];
$comment_email= $row['comment_email']; 
$comment_content =$row['comment_content'];
$comment_status =$row['comment_status'];
$comment_date =$row['comment_date'];


echo "<tr>"; 
echo "<td scope='row'> {$comment_id}</td>";
echo "<td> {$comment_auther}</td>";
echo "<td> {$comment_content}</td>";   
echo "<td> {$comment_email}</td>";
echo "<td> {$comment_status}</td>";

                                //displaying the commented post title in the admin section of view all commentes page
                                $query="select * from posts where post_id=$comment_post_id";
                                $select_post_id_query=mysqli_query($connection,$query);
                                while($row=mysqli_fetch_assoc($select_post_id_query)){
                                $post_id=$row['post_id'];
                                $post_title=$row['post_title'];
                                echo "<td> <a href='../post.php?p_id=$post_id'> $post_title</a></td>";


                                }
echo "<td> {$comment_date}</td>";


echo "<td> <a href='post_comments.php?approve=$comment_id &id=".$_GET['id']."' class='btn btn-success btn-sm'   > Approve</a>   </td>";//push id into search bar
echo "<td> <a href='post_comments.php?unaprove=$comment_id &id=".$_GET['id']."'   class='btn btn-info btn-sm'>unaprove </a>   </td>";//push id into search bar


echo "<td> <a href='post_comments.php?delete=$comment_id &id=".$_GET['id']."' class='btn btn-danger btn-sm'>Delete</a>   </td>";//push id into search bar

echo "</td>";
}
?>
                            </tbody>
                        </table>


<?php 
//unapprove comments
if(isset($_GET['unaprove'])){
    $the_comment_id = $_GET['unaprove'];
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id} ";
    $delete_query = mysqli_query($connection,$query);
    
    header("location:post_comments.php?id=" . $_GET['id']."");
    
    }

    //approve comments
if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = {$the_comment_id} ";
    $delete_query = mysqli_query($connection,$query);
    
    header("location:post_comments.php?id=".$_GET['id']."");
    
    }
//delete post query   after getting the delete parameter from the echo "<td> <a href='posts.php?delete={$post_id}'>Delete</a>   </td>"
if(isset($_GET['delete'])){
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_query = mysqli_query($connection,$query);
    
    header("location:post_comments.php?id=".$_GET['id']."");
    
    }





?>



</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php
include "includes/admin_footer.php";

?>
