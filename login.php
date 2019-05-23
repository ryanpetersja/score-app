<?php 
session_start();
$title = "Login";
        

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            if( $_POST['user'] == "" ){
                print_r('<div class="col-md-6 offset-md-3">
                                            <div class="alert alert-warning" role="alert">
                                                ENTER USERNAME AND PASSWORD!
                                            </div>
                                       </div>');
            }else{
            $usr = strip_tags($_POST['user']);
            $password = strip_tags($_POST['password']);
            
            if($usr != ""){ 
            }else{
                $problem = true;
            }
            if(isset($password)){ 
            }else{
                $problem = true;
            }
            
            $problem = false;
            $issues = "";
            $server = 'localhost';
            $username = 'hoh_scoreboard';
            $pass = 'eagle17';
            $db_name = 'hoh_scoreboard';
            
            if(!($conn = mysqli_connect($server, $username, $pass )) ){
                echo "error connectting to database for login";
            }else{
                if(!(mysqli_select_db($conn, 'hoh_scoreboard'))){
                    echo "failed to select users for login    <br>" . mysqli_error($conn);
                } 
                else{
                 
                    
                    if(!$problem){
                        $get_email = "SELECT user
                        FROM users
                        WHERE user = '$usr'";
                        
                        $get_password = "SELECT password
                        FROM users
                        WHERE user = '$usr'";
                        
                        if(!($this_user = mysqli_query($conn, $get_email))){
                            $issues .= "no such users present"; 
                            print_r("failed to select db: " . mysqli_error($conn));
                        }else{ 
                            if(!($this_pass = mysqli_query($conn, $get_password))){
                                $issues .= "incorrect password"; 
                                print_r($issue);
                            }else{
                                $this_user = mysqli_fetch_array($this_user);
                                $this_pass = mysqli_fetch_array($this_pass);
                                
                                if( $usr == $this_user[0] && $password == $this_pass[0]){
                                    $_SESSION['logged-in'] = true;
                                    $_SESSION['just-log'] = true;
                                    $_SESSION['user'] = ucfirst($usr);
                                    $_SESSION['password'] = $password;
                                   if($_SESSION['logged-in'] == true){
                                            header("location: event.php"); 
                                        }
                                   }else{
                                    
                                       print_r('<div class="col-md-6 offset-md-3">
                                            <div class="alert alert-warning" role="alert">
                                                Incorrect Credentials!
                                            </div>
                                       </div>');
                                }
                               
                            }
                        }

                    }else{
                        print_r('there was a problem<Br>' . $issues);
                    }
                }
            }
        }
    }




if($_SESSION['logged-in'] == true){
     
        header("location: event.php");
        }
session_start();

    require('templates/dbbasics.php');
    require('templates/header.html');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['logged'] == 'out'){
        $_SESSION['logged-in'] = false;
     print_r('<div class="col-sm-6 offset-sm-3 logged-in">
                        <h3>Now Logged out</h3>
                        <a class="btn btn-secondary" href="index.php">view Table</a><br>
                    </div>');
    }

    if($_SESSION['logged-in'] == false){
        print_r('<div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4 login-form">
            <form action="login.php" method="POST">
                <form class="form-inline">
                  <div class="form-group mx-sm-3">
                    <label class="sr-only">Email</label>
                    <input type="email" name="user" class="form-control" id="user" placeholder="Username">
                  </div> 
                  <div class="form-group mx-sm-3">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input type="password" class="form-control" name="password" id="inputPassword2" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-primary">Confirm identity</button>
                </form>
            </form>
        </div>
    </div>');
    }else{
        print_r( '<div class="col-sm-6 offset-sm-3 logged-in">
                        <h3>You are already logged in</h3>
                        <a class="btn btn-primary" href="event.php">Update scores</a>
                        <a class="btn btn-secondary" href="index.php">view Table</a><br>
                        <form class="logout-form" method="post" action="login.php">
                        <input type="hidden" name="logged" value="out">
                        <br><br><input class="btn btn-light" type="submit" value="Logout">
                        </form>
                    </div>' );
        
    }




    



    require('templates/footer.html');
?>