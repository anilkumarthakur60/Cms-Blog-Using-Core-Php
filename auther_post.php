<?php
include "include/header.php";

?>

 
    <!-- Navigation -->
    <?php
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




                            if(isset($_GET['p_id'] )){
                            $the_post_id= $_GET['p_id'];
                            $the_post_author=$_GET['author'];
                            
                            $query="SELECT  * from posts where post_auther='{$the_post_author}' AND  post_status='published' ";
                            $select_all_post_querry=mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($select_all_post_querry)){
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
                                <a href="post.php?p_id=<?php echo $the_post_id ?>"><?php echo $post_title ?></a>
                        </h2>
                            <p class="lead">
                            All Posted by:  <?php echo $post_auther ?>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date.",<i class='fa fa-fw  fa-eye'></i>".$post_view_count.",<i class='fa fa-fw fa-comments'></i> ".$post_comment_count  ?></p>
                            <hr>
                            <img class="img-responsive" src="image/<?php echo $post_image;?>" alt="">
                            <hr>
                            <p><?php echo $post_content ?></p>

                        
                            <hr>

                                <?php
                            }}
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

        <!-- Footer -->
<?php
include "include/footer.php";
?>

