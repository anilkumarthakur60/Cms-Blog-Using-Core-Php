
 <?php  include "include/header.php"; ?>    
<?php  include "include/navigation.php"; ?>
<?php 
if(isset($_POST['submit'])) {

    

$to         = "anilkumarthakur60@gmail.com";
$subject    =escape( $_POST['subject']);
$body       =wordwrap($_POST['body'],70);
$header=   "From:".$_POST['email'];


mail($to,$subject,$body,$header);



}
?>
 
 
    
    
    
 
    <!-- Page Content -->
<div class="container">
    
  <section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h2>If you have any question please feel to mail us</h2>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                       
    
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your Subject">
                        </div>
                         <div class="form-group">
                           
                           <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


<hr>



<?php include "include/footer.php";?>
