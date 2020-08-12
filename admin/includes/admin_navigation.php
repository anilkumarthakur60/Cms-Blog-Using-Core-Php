
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"  style="float: none;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                
                <li>
                <a href="#">online: <span class="useronline"></span>    </a>
                </li>


                <li>
                    <a href="../index.php" > <i class="fa fa-fw fa-home"></i>  Go To Site</a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-fw fa-user"></i> <?php 
                                echo $_SESSION['firstname']." ".$_SESSION['lastname'];                               
                                ?>
                 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                      
                        <li>
                            <a href="../include/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>


            <!-- left Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="./posts.php">View all posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add New Posts</a>
                            </li>
                        </ul>
                    </li>
<?php if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){
            ?>
                    <li>
                        <a href="catagories.php"><i class="fa fa-fw fa-wrench"></i> Catagories</a>
                    </li>
        <?php }}?>
                    <li >
                        <a href="comments.php"><i class="fa fa-fw fa-comment"></i> Comments</a>
                    </li>
<?php 
                    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#user_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="user_dropdown" class="collapse">
                            <li>
                                <a href="./users.php">View all users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add New user</a>
                            </li>
                        </ul>
                    </li>
        <?php }
      
        
    } 
     ?>


                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#user_dropdowns"><i class="fa fa-fw fa-user"></i> Profile <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="user_dropdowns" class="collapse">
                            <li>
                                <a href="./profile.php">View Profile</a>
                            </li>
                            <li>
                                <a href="profile.php?source=update_profile">Update Profile</a>
                            </li>
                        </ul>
                    </li>
                    
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
