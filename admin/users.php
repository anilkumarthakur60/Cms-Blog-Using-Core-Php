
<?php  
include "includes/admin_header.php";


?>
    <div id="wrapper">
        <!-- Navigation -->
    <?php
    include "includes/admin_navigation.php";
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']=='admin'){
    
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

switch ($source) {
    //add post switch statement
    case 'add_user':
       include "includes/add_user.php";
        break;

    case 'edit_user':
        //edit post switch statement
       include "includes/edit_user.php";
        break;

    default:
        # code...
        include "includes/view_all_user.php";
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

   
<?php   }  else{
            header("location:index.php");
        }
    }

include "includes/admin_footer.php";
        
?>