<?php //navigation catagory page
include "includes/admin_header.php";
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
                            Welcome to <?php echo $_SESSION['user_role'];?>.
                            <small> <?php echo $_SESSION['username'];  ?></small>
                        </h1>
                        <div class="col-xs-6">
                         



                        <?php 
                        insert_catagory();

                        ?>

                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title"> Add Catagory</label>
                                    <input type="text"  class="form-control"  name="cat_title" value="">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Catagory">
                                </div>
                            </form>



                            <!-- update catagory -->
                            <?php
                            
                            if(isset($_GET['edit'])){
                                $cat_id=$_GET['edit'];
                                
                            include "includes/update_catagories.php" ;
                            }
                            
                            ?>





                        </div>


                        <div class="col-xs-6">




                          <table class="table table-hover table-bordered"  style="background-color:white;">
                             <thead>
                                <tr>
                                    <th>id</th>
                                    <th>catagory title </th>
                                    
                                    <th>Delete</th>
                                    <th>Update </th>
                                    
                                </tr>
                             </thead>



                             <tbody>

<!-- find all catagories  -->
                <?php
                find_all_catagories();
                ?>      
                                    
                                    



<!-- delete query -->
<?php 
delete_catagory();
?>                            
                               
                            </tbody>
                         </table>
                        </div>



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