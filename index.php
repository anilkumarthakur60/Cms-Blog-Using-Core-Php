
 <?php  include "include/header.php"; ?>


<!-- Navigation -->

<?php  include "include/navigation.php"; ?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        
        <div class="col-md-8">
            
                                <?php   
                                $per_page=5;
                                //counting total post query
                                if(isset($_GET['page'])){
                                   
                                    $page=$_GET['page'];
                                }
                                else{
                                    $page="";
                                }
                                
                                if($page=="" || $page==0  ){
                                    $page_1=0;
                                }else{
                                    $page_1=($page*$per_page)-$per_page;
                                }



                                if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){

                                    $select_post_count="SELECT * from posts ";
                                }else{
                                    
                                $select_post_count="SELECT * from posts where post_status='published'";
                                }


                                $count_query=mysqli_query($connection,$select_post_count);
                                $count=mysqli_num_rows($count_query);
                                $count=ceil( $count/$per_page);
                                if($count<1){
                                    echo "<h1 style='text-align:center;'>Post Not Available </h1>";


                                }
                                else{
                                $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT  $page_1, $per_page  ";
                                $select_all_posts_query = mysqli_query($connection,$query);

                                while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_auther'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = substr($row['post_content'],0,150);
                                $post_status = $row['post_status'];
                                $post_comment_count=$row['post_comment_count'];
                                $post_view_count=$row['post_view_count'];
                                
                                
                                ?>



            <!-- First Blog Post -->

          
                            <h2>
                                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                 by <a href="auther_post.php?author=<?php echo $post_author?>&p_id=<?php echo $post_id?>"><?php echo $post_author ?></a>
                            </p>
                            <p>
                                <span class="glyphicon glyphicon-time"></span> <?php echo $post_date.",<i class='fa fa-fw  fa-eye'></i>".$post_view_count.",<i class='fa fa-fw fa-comments'></i> ".$post_comment_count ?>
                                                                         
                                                                                 
                            
                            </p>
                            


                            <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" height="50%" width="50%" src="image/<?php echo $post_image;?>" alt="">
                            </a>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>


                            <?php }}
                            
                           
                            ?>


        </div>
        
          

        <!-- Blog Sidebar Widgets Column -->
        
        
        <?php include "include/sidebar.php";?>
         

    </div>
    <!-- /.row -->

    <hr>
    <ul class="pager">
        <?php 
        for ($i=1; $i <=$count ;$i++ ) {
            if($i==$page){

                echo  "<li><a  style='background: #000;'  style href='index.php?page={$i}'>{$i}</a></li>";

            }
            else{
                
            echo  "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        
        
        ?>

        

    </ul>



<?php include "include/footer.php";?>



