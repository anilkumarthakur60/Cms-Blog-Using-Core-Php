<?php
include "include/header.php";

include "include/navigation.php";
?>


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










 if(isset($_GET['catagory'])){
     $the_post_catagory=$_GET['catagory'];
     if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){

        $query="SELECT  * from posts where post_catagory_id=$the_post_catagory   " ;
    }else{
        
 $query="SELECT  * from posts where post_catagory_id=$the_post_catagory AND post_status='published'  " ;
    }

 $select_all_post_querry=mysqli_query($connection,$query);
 if(mysqli_num_rows($select_all_post_querry)<1){
     echo " <h1 style='text-align:center;'>Post Not Available</h1>";
 }
 else{

 
 while($row=mysqli_fetch_assoc($select_all_post_querry)){
     
    $post_id= $row['post_id'];
     $post_title= $row['post_title'];
     $post_auther= $row['post_auther'];
     $post_date= $row['post_date'];
     $post_image= $row['post_image'];
     $post_content= substr($row['post_content'],0,200);
     $post_comment_count=$row['post_comment_count'];
     $post_view_count=$row['post_view_count'];
    
?>   
               
                <!-- First Blog Post with php code -->
            <!-- First Blog Post -->
            <h2>
                     <!-- p_id is send to post.php -->
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
            </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_auther ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date.",<i class='fa fa-fw  fa-eye'></i>".$post_view_count.",<i class='fa fa-fw fa-comments'></i> ".$post_comment_count  ?></p>
                <hr> <a href="post.php?p_id=<?php echo $post_id ?> ">
                <img class="img-responsive" src="image/<?php echo $post_image;?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>

                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

     <?php
 }}}
 
 else{
     header("location:index.php");
 }
 ?>





            






                <!-- Pager -->
                <ul class="pager">
                </ul>

            </div>
                    <!-- Blog Sidebar Widgets Column -->
<?php

include "include/sidebar.php";
?>
     
            
        </div>

      

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

        <!-- Footer -->
<?php
include "include/footer.php";
?>