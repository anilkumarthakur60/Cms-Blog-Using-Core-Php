<?php
include "include/header.php";
include "include/navigation.php";
?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-8 " style="margin-top: 25px;">                                    
                        <?php
                        if(isset($_GET['p_id'])){
                            $the_post_id= $_GET['p_id'];
                            $view_query="UPDATE posts SET post_view_count =post_view_count+1 where post_id='{$the_post_id}'";
                            $view_post_query=mysqli_query($connection,$view_query);

                            if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){

                                $query="select  * from posts where post_id={$the_post_id} ";
                            }else{
                                
                            $query="SELECT  * from posts where post_id={$the_post_id} AND post_status='published' ";
                            }



                            $select_all_post_querry=mysqli_query($connection,$query);
                            if(mysqli_num_rows($select_all_post_querry)<1){
                                echo " <h1 style='text-align:center;'>Post Not Available</h1>";
                            }
                            else{




                            
                            $query="select  * from posts where post_id={$the_post_id} ";
                            $select_all_post_querry=mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($select_all_post_querry)){
                                $post_id=$row['post_id'];
                                $post_title= $row['post_title'];
                                $post_auther= $row['post_auther'];
                                $post_date= $row['post_date'];
                                $post_image= $row['post_image'];
                                $post_content= $row['post_content'];
                                $post_comment_count=$row['post_comment_count'];
                                $post_view_count=$row['post_view_count'];
                               
                            ?>   
               
                            <!-- First Blog Post with php code -->
                        <!-- First Blog Post -->
                        <h2>
                                <a href=""><?php echo $post_title ?></a> <?php 

if(isset($_SESSION['user_role'])) {

    if(isset($_GET['p_id'])) {
        
      $the_post_id = $_GET['p_id'];
    
    echo "<a class='btn btn-sm btn-danger' href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a>";
    
    }



}

?>  
                        </h2>
                            <p class="lead">
                            Posted by <a href="auther_post.php?author=<?php echo $post_auther?>&p_id=<?php echo $post_id?>"><?php echo $post_auther ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date .",<i class='fa fa-fw  fa-eye'></i>".$post_view_count.",<i class='fa fa-fw fa-comments'></i> ".$post_comment_count  ?></p>
                            <hr>
                            <img class="img-responsive" src="image/<?php echo $post_image;?>" alt="">
                            <hr>
                            <p><?php echo $post_content ?></p>

                        
                            <hr>

                                <?php
                            }
                        
                        
                            ?>
                            
                            <!-- blog comment -->
                            <?php 
                        if(isset($_POST['create_comment'])){
                            
                            $the_post_id= escape($_GET['p_id']);
                            $comment_auther=escape($_POST['comment_auther']);
                            $comment_email=escape($_POST['comment_email']);
                            $comment_content=escape($_POST['comment_content']);
                            if((!empty($comment_auther)) && (!empty($comment_email)) && (!empty($comment_content))){
                            $query = "INSERT INTO comments(comment_post_id,
                                                        comment_auther,
                                                        comment_email,
                                                        comment_content,
                                                        comment_status,
                                                        comment_date) ";
                            
                            $query .= "VALUES( $the_post_id,    
                                            '{$comment_auther}',
                                            '{$comment_email}',
                                            '{$comment_content}',
                                            'unapproved'
                                            ,now()) "; 
                            $create_comment_query=mysqli_query($connection,$query);
                            confirmQuery($create_comment_query);
                            $querys="UPDATE posts set post_comment_count=post_comment_count+1 where post_id='{$the_post_id}' ";
                            $comment_count_query=mysqli_query($connection,$querys);
                            confirmQuery($comment_count_query);
                            }
                            else {  echo "<script >alert('some field are set empty please fill the!')</script>";
                            }
                        }

                            ?>

                            <!-- Comments Form -->
                                                <div class="well">
                                                                    <h4>Leave a Comment:</h4>
                                                                    <form action="" method="POST" role="form">
                                                                        <div class="form-group">
                                                                            <label for="Auther">Your Name</label>
                                                                            <input type="text" class="form-control"  name="comment_auther" id="">
                                                                        </div>
                                                                        
                                                                        <div class="form-group">                            
                                                                            <label for="comment_email">Email</label>
                                                                            <input type="email"  class="form-control" name="comment_email" id="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="comment_content">Your Comment</label>
                                                                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                                                                        </div>


                                                                        <button type="submit" name="create_comment" class="btn btn-primary ">Submit</button>
                                                                    </form>
                                                </div>

                                                       <hr>

                <!-- Posted Comments -->
            

                <?php 
                        //comment display in post.php 
                $query="SELECT * FROM comments WHERE comment_post_id={$the_post_id} AND comment_status='approve' order by comment_id desc ";
                $select_comment_query=mysqli_query($connection,$query);
                confirmQuery($select_comment_query);
                while($row=mysqli_fetch_array($select_comment_query)){
                    $comment_date=$row['comment_date'] ;
                    $comment_auther=$row['comment_auther'];
                    $comment_content=$row['comment_content'];
                ?>

            <div class="media">
                     
                     <a class="pull-left" href="#">
                         <img class="media-object" src="http://placehold.it/64x64" alt="">
                     </a>
                     <div class="media-body">
                         <h4 class="media-heading"><?php echo $comment_auther;   ?>
                             <small><?php echo $comment_date;   ?></small>
                         </h4>
                         
                         <?php echo $comment_content;   ?>
                         <hr>
  
                     </div>
                 </div>



                 

             <?php   
             } 





                }
}//end of isset section
else{
    header("location:index.php");
    }

             
             
             
             ?>
                
                    
              

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php

include "include/sidebar.php";
?>
       
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php
include "include/footer.php";
?>

