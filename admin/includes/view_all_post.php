

<?php 
if(isset($_POST['checkBoxArray'])){
  
    
    foreach($_POST['checkBoxArray'] as $postValueId ){
        
        $bulk_options = $_POST['bulk_options'];
              




    switch($bulk_options) {

              case 'published':              
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";              
                    $update_to_published_status = mysqli_query($connection,$query);       
                    confirmQuery($update_to_published_status); 
               break;

               case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";              
                    $update_to_published_status = mysqli_query($connection,$query);       
                    confirmQuery($update_to_published_status); 
                  
                   break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = '{$postValueId}' ";
                    $delete_query = mysqli_query($connection,$query);     
                    confirmQuery($delete_query); 

                    break;
                    case 'clone':
                                                                
                                        $query="SELECT * from posts where post_id='{$postValueId}'  ";
                                        $select_post=mysqli_query($connection,$query);
                                        confirmQuery($select_post);

                                        // display catagory query
                                        while($row=mysqli_fetch_assoc($select_post)){
                                       
                                        $post_auther =$row['post_auther'];
                                        $post_title= $row['post_title'];
                                        $post_catagory_id= $row['post_catagory_id']; 
                                        $post_status =$row['post_status'];
                                        $post_image =$row['post_image'];
                                        $post_tags =$row['post_tags'];
                                        $post_comment_count =$row['post_comment_count'];
                                        $post_date =$row['post_date']; 
                                        $post_content=$row['post_content'];
                                       
                                        }
                                        
$query = "INSERT INTO posts(post_catagory_id, post_title,post_auther, post_date,post_image,post_content,post_tags,post_status) 
            VALUES ({$post_catagory_id},'{$post_title}','{$post_auther}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}')  ";
             
$create_post_query = mysqli_query($connection, $query);  
confirmQuery($create_post_query);
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
                            <option value="published">Publish</option>
                            <option value="draft">Draft</option>
                            <option value="delete">Delete</option>
                             <option value="clone">Clone</option>
                    </select>

                    </div> 

                        
                    <div class="col-xs-4">

                    <input     type="submit" name="submit" class="btn btn-success   " onclick="return confirm('Are you sure!?')" value="Apply"      >
                    <a class="btn btn-primary" href="posts.php?source=add_post">Add New post</a> <br><br>

                    </div>
 


        <thead>
            <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>ID</th>
                                    <th>Post By</th>
                                    <th>Title</th>
                                    <th>Category </th>                                    
                                    <th>Images</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Delete/Edit</th> 
                                    <th>Status</th>
                                    <th>Publish/Draft</th>
                                    <th>views</th>
                                    
                                    

                                </tr>
                            </thead>
                            <tbody>
  <?php 

// $query="SELECT * from posts  ORDER BY post_id DESC ";

$query="SELECT * from posts  ORDER BY post_id DESC ";
$select_post=mysqli_query($connection,$query);


// display catagory query
while($row=mysqli_fetch_assoc($select_post)){
$post_id=$row['post_id']; 
$post_auther =$row['post_auther'];
$post_title= $row['post_title'];
$post_catagory_id= $row['post_catagory_id']; 
$post_status =$row['post_status'];
$post_image =$row['post_image'];
$post_tags =$row['post_tags'];
$post_comment_count =$row['post_comment_count'];
$post_date =$row['post_date']; 
$post_view_count=$row['post_view_count'];


echo "<tr>";  ?>

<td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
<?php
echo "<td scope='row'> {$post_id}</td>";
echo "<td> {$post_auther}</td>";
//on click title display that post
echo "<td> <a href='../post.php?p_id=$post_id'> $post_title</a></td>";
            //problem stuck here for the display of catagory in the view all post table    problem solved if post_catagory_id and cat_id matches
            $query="select *  from catagories where cat_id={$post_catagory_id}";
            $select_catagory_id=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($select_catagory_id)){
                
                $cat_title=$row['cat_title'];
                echo "<td> $cat_title </td>";
            } 
echo "<td><img width='100' height='40' src='../image/$post_image' alt='image'></td>";  
echo "<td> {$post_tags}</td>"; 

$query="SELECT * from comments where comment_post_id=$post_id";
$send_comment_query=mysqli_query($connection,$query);
$row=mysqli_fetch_array($send_comment_query);
$comment_id=$row['comment_id'];
$count_comment=mysqli_num_rows($send_comment_query);

echo "<td><a href='post_comments.php?id=$post_id'>   {$post_comment_count}</a></td>";
echo "<td> {$post_date}</td>";
echo "<td> <a   onClick=\"javascript:return confirm('are you sure you want to delete');\"    href='posts.php?delete={$post_id}' class=' btn btn-sm btn-danger '   >Delete
            </a> <a  onClick=\"javascript:return confirm('are you sure you want to edit');\"  href='posts.php?source=edit_post&p_id={$post_id}'   class=' btn btn-sm btn-info ' >Edit</a>  
             </td>";
echo "<td> {$post_status}</td>";
echo "<td> <a onClick=\"javascript:return confirm('are you sure you want to publish');\" href='posts.php?published=$post_id'  class=' btn btn-sm btn-success ' > Publish</a>  
             <a onClick=\"javascript:return confirm('are you sure you want to draft');\" href='posts.php?draft=$post_id' class=' btn btn-sm btn-danger '  >Draft </a>
              </td>";//push id into search bar
echo "<td>$post_view_count</td>";
echo "</td>";
}






?>
                            </tbody>
                        </table>
 </form>

<?php 

//delete post query   after getting the delete parameter from the echo "<td> <a href='posts.php?delete={$post_id}'>Delete</a>   </td>"
if(isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection,$query);
    
    header("location:posts.php");
    
    }




    
if(isset($_GET['published'])){
    $the_post_id = $_GET['published'];
    $query = "UPDATE posts SET post_status = 'published' WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection,$query);
    
    header("location:posts.php");
    
    }

    //approve comments
if(isset($_GET['draft'])){
    $the_post_id = $_GET['draft'];
    $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection,$query);
    
    header("location:posts.php");
    
    }






    //edit post query

?>
