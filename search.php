
 <?php  include "include/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
               
               <?php
 
             

            if(isset($_POST['submit'])){
                
            $search = $_POST['search'];
            if($search==''){
                header("location:index.php");
            }
            else{

            if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){

                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'  "; 
            }else{
                
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'  AND post_status='published' "; 
            }
                
            $search_query = mysqli_query($connection, $query);
                
            if(!$search_query) {
            
                die("QUERY FAILED" . mysqli_error($connection));
            
            }
                
            $count = mysqli_num_rows($search_query);
                
            if($count == 0) {
            
                echo "<h1> NO RESULT</h1>";
             
            } else {





    while($row = mysqli_fetch_assoc($search_query)) {
        $post_title = $row['post_title'];
        $post_author = $row['post_auther'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_comment_count=$row['post_comment_count'];
        $post_view_count=$row['post_view_count'];
       
        
        ?>
        
          <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date.",<i class='fa fa-fw  fa-eye'></i>".$post_view_count.",<i class='fa fa-fw fa-comments'></i> ".$post_comment_count  ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                

   <?php } 
            
            
            }
                
            
        }
            }

?>

    

                
                
                
                
                

              
    

            </div>
            
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php include "include/sidebar.php";?>
             

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
        
        </ul>
   

<?php include "include/footer.php";?>
