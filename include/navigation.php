   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
           
           
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button style="float: none;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">HOME</a>
            </div>
            
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  
                  <?php 

    $query = "SELECT * FROM catagories";
    $select_all_catagories_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_catagories_query)) {
       $cat_title = $row['cat_title'];
       $cat_id = $row['cat_id'];

       //catagory active class
       $catagory_class='';
       $registration_class='';
       $contact_class='';
       $pagename=basename($_SERVER['PHP_SELF']);
       $registration='registration.php';
       $contact='contact.php';
       if(isset($_GET['catagory']) && $_GET['catagory']==$cat_id){           
       $catagory_class='active';
      
       }
       else if($pagename==$registration){           
       $registration_class='active';
       }
       elseif($pagename==$contact){
        $contact_class='active';

       }
       //end of logic active class  and place catagory class into li taq

       
       

        
        echo "<li style='text-transform: uppercase;' class='$catagory_class'><a class='$catagory_class'    href='catagory.php?catagory={$cat_id}'>{$cat_title}</a></li>";
    }
                    
    ?>
                   
                   <?php      if(isset($_SESSION['user_role']))   {   ?>
                    <li >
                        <a  href="admin">ADMIN</a>
                    </li>
                   <?php }?>



                                 
                     <li class='<?php echo $registration_class ?>'>
                        <a  href="registration.php">REGISTRATION</a>
                    </li>
                    
                    <li class='<?php echo $contact_class ?>'>
                        <a   href="contact.php">CONTACT</a>
                    </li>
                                
                    


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
