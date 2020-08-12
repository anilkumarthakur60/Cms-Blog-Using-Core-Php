

                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title"> Edit   Catagory </label>
                                   

                                        <?php
                                        if(isset($_GET['edit'])){
                                                    $cat_id=$_GET['edit'];
                                                    
                                                // find all catagory query
                                                $query="select  * from catagories where cat_id=$cat_id  ";
                                                $select_catagories_id=mysqli_query($connection,$query);

                                                // display catagory query
                                                while($row=mysqli_fetch_assoc($select_catagories_id)){
                                                    $cat_id=$row['cat_id']; 
                                                    $cat_title= $row['cat_title'];
                                                    ?>
                                                    
                                                                                
                                                    <input value="<?php if(isset($cat_title))
                                                                                            { 
                                                                                                echo $cat_title; 
                                                                                            
                                                                                            }?>" 
                                                                                            type="text"  class="form-control"  name="cat_title" >
                                                <?php }
                                         }?>






                                            <!-- update query -->
                                         <?php 
                                          if(isset($_POST['update_catagory'])){
                                            if(isset($_SESSION['user_role'])){
                                                if($_SESSION['user_role']=='admin'){
                                            $the_cat_title = $_POST['cat_title'];
                                            $query = "UPDATE catagories SET cat_title = '{$the_cat_title}' WHERE cat_id ={$cat_id} ";
                                            $update_query = mysqli_query($connection,$query);
                                           confirmQuery($update_query);
                                          }}}
                                         
                                         ?>


                                            
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_catagory" value="Update Catagory">
                                </div>
                            </form>