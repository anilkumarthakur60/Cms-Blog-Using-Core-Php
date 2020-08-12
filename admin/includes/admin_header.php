<?php ob_start(); ?>
<?php include "../include/db.php"; ?>
<?php include "functions.php"; ?>



<?php session_start(); ?>


<?php 

if(!(isset($_SESSION['user_role']))) {
//if user role is not equal to admin redirect to cms index page 
    header("Location:../index.php");
} 
else{
    
}
?>









<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
 
    <title>Admin Pannel </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
    


 
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 

<script src="js/jquery.js"></script>





<script>


//to check all and uncheck all$(document).ready(function() {
    $(document).ready(function() {

$('#selectAllBoxes').click(function(event) {

    if (this.checked) {

        $('.checkBoxes').each(function() {

            this.checked = true;

        });

    } else {


        $('.checkBoxes').each(function() {

            this.checked = false;

        });


    }

});



});





//end of check and uncheck script


</script>
<!-- 

<script src="https://cdn.tiny.cloud/1/7egc5owc4k5372c26oymudwpw1xqt43ftphfo4nd5tfhrwo7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>

  -->

<script>
       
function loadUsersOnline() {
$.get("functions.php?onlineuser=result", function(data){

    $(".useronline").text(data);


});
}
setInterval(function(){

    loadUsersOnline();
},500);



    </script>

 


</head>

<body>







