<?php
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
                <div class="row" >
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to <?php echo $_SESSION['user_role'];?>.
                            <small> <?php echo $_SESSION['username'];  ?></small>
                        </h1>
                       

<?php 
//search.....?source=file name
if(isset($_GET['source'])){
    $source=$_GET['source'];
}
else{
    $source='';
}

switch ($source) {
    //add post switch statement
    case 'add_post':
       include "includes/add_post.php";
        break;
 

    case 'edit_post':
        //edit post switch statement
       include "includes/edit_post.php";
        break;

    default:
        # code...
        include "includes/view_all_post.php";
        break;
}



 ?>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php
include "includes/admin_footer.php";

?>