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
                <div class="row">
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
//these cases bring dropdown items
switch ($source) {
    
    case 'update_profile':
        //edit post switch statement
       include "includes/update_profile.php";
        break;
    
    default:
        # code...
        include "includes/view_profile.php";
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


<?php
include "includes/admin_footer.php";


?>