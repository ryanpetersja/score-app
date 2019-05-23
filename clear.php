<?php 
    session_start();
    $title = "Clear Table";
    require('templates/dbbasics.php');
    require('templates/header.html');
    
        print_r('
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form method="post" action="clear.php">
 
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Which Table should be cleared?</label>
                          </div>
                          <select class="custom-select" id="inputGroupSelect01" name="gender">
                            <option selected>Choose...</option>
                            <option value="males">Males</option>
                            <option value="females">Females</option>
                          </select>
                        </div>
                       
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
                          </div>
                          <input type="password" name="password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        
                         <div class="input-group">
                            <p><input type="submit" value="clear Table" class="btn btn-danger"></p>
                        </div>
                     </form>
                     
                </div>
             </div>
        ');


    require('templates/footer.html'); 


function clear_result($table){
    global $server,
    $username,
    $pass,
    $problem,
    $db_name;
    $issues;

     
    if($_POST["password"] != $_SESSION['password']){
        print_r('<div class="alert alert-danger" role="alert">Incorrect password</div>');
    }
    else{
        if(!($dbdoor = mysqli_connect($server, $username, $pass))){
                        print_r("connection failed"); //returns a result if not valid
                    }else{//connection is succesful
                        if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
                            print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
                        }else{//if we are here then we have connected and selected- here is where the magic happens

                            $query = "UPDATE $table 
                            SET ring_road = 0, 
                            basketball = 0, 
                            cross_country =0, 
                            hockey = 0, 
                            cricket = 0, 
                            volleyball = 0, 
                            table_tennis = 0, 
                            football = 0, 
                            sports_day = 0, 
                            netball = 0, 
                            badminton = 0,
                            tennis = 0"; //creates query to select all rows  

                            if(!(mysqli_query($dbdoor, $query))){
                                print_r("clearing Failed");
                            }else{
                                 print_r('<div class="alert alert-dark" role="alert">'.$table.' Scoreboard Cleared</div>');
                                if($table == 'males'){

                                    $query2 = "UPDATE male_event_count SET n=0";
                                    if(!mysqli_query($dbdoor, $query2)){
                                        print_r('<div class="alert alert-light" role="alert">Male event <b>NOT</b> counter cleared</div>');
                                    }else{
                                        print_r('<div class="alert alert-light" role="alert">Male event counter cleared</div>');
                                    }   
                            }


                                 if($table == 'females'){
                                    $query2 = "UPDATE female_event_count SET n=0";
                                    if(!mysqli_query($dbdoor, $query2)){
                                        print_r('<div class="alert alert-light" role="alert">Female event counter cleared</div>');
                                    }else{
                                        print_r('<div class="alert alert-light" role="alert">Female event counter <b>NOT</b> cleared</div>');
                                    }
                                }
                            }
                        }//closes if(else) select db statement
                    }//closes connection else statment
                    sum_up($table);

                    combine();}
        }

if($_SERVER['REQUEST_METHOD'] =='POST'){
   if(isset($_POST['gender'])){
       clear_result($_POST['gender']);
   }
}

?>