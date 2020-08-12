            <!-- Blog Sidebar Widgets Column -->
 <div class="col-md-4"> 
 

                <div class="well">
                    <h4>Search Here</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!--search form-->
                    <!-- /.input-group -->
                </div>
                
                 
                
                <!--Login -->
                    <div class="well">
                    <?php      if(isset($_SESSION['user_role']))   {   ?>
                        <h4>logged as <?php echo $_SESSION['username']; ?></h4>
                        <a href="include/logout.php" class="btn btn-sm btn-primary">Logout</a>
                    <?php }
                       else{
                       
                       ?>

                                <form action="include/login.php" method="post">
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                                    
                                </div>

                                <div class="form-group">
                                    <input name="password" type="password" class="form-control" placeholder="Enter Password">                                   
                                    <button class="btn btn-primary btn-sm" name="login" type="submit">login
                                    </button>
                                   
                                    <a href="registration.php" class=" btn btn-sm btn-info" style="float:right">Sign Up</a>
                                    
                                    
                                </div>
                                </form><!--search form-->
                       <?php }  ?>
                    </div>
                                
                                
                
                
                
                
                
                
        
            
                <!-- Blog Categories Well -->
                <div class="well">
                        <?php 
                        $query = "SELECT * FROM catagories";
                        $select_catagories_sidebar = mysqli_query($connection,$query);         
                        ?>
                        <h4>Blog Categories</h4>
                        <div class="row">
                        <div class="col-lg-12">
                        <ul class="list-unstyled">

                        <?php 

                        while($row = mysqli_fetch_assoc($select_catagories_sidebar )) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li><a href='catagory.php?catagory=$cat_id'>{$cat_title}</a></li>";


                        }

                        ?>
                              
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>



                 <!-- Blog Categories Well -->
                 <div class="well">
                        <?php 
                        $query = "SELECT * FROM posts order by post_view_count DESC limit 10";
                        $select_tag = mysqli_query($connection,$query);         
                        ?>
                        <h4>Blog Tags</h4>
                        <div class="row">
                        <div class="col-lg-12">
                        <ul class="list-unstyled">

                        <?php 

                                while($row = mysqli_fetch_assoc($select_tag )) {
                            $tag=$row['post_tags'];
                            $post_id=$row['post_id'];
                                echo "<li><a href='post.php?p_id=$post_id'>{$tag}</a></li>";
                                }

                        ?>
                              
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>
                  <!-- Blog Categories Well -->
                  <div class="well">
                        <?php 
                        $query = "SELECT * FROM comments order by comment_date DESC limit 10";
                        $select_comment= mysqli_query($connection,$query);         
                        ?>
                        <h4>Comments</h4>
                        <div class="row">
                        <div class="col-lg-12">
                        <ul class="list-unstyled">

                        <?php 
                                while($row = mysqli_fetch_assoc($select_comment )) {
                            
                            $comment_auther=$row['comment_auther'];
                            $comment_post_id=$row['comment_post_id'];
                            $comment_content=$row['comment_content'];
                            
                                echo "<li><a href='post.php?p_id=$comment_post_id'><strong>{$comment_auther}</strong></a>....$comment_content</li>";
                                }

                        ?>
                              
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>















                

</div>
            