<?php session_start();

$server = 'localhost'; 
$username = 'hoh_scoreboard';
$pass = 'eagle17';
$db_name = 'hoh_scoreboard';

$problem = false;

                if(!($dbdoor = mysqli_connect($server, $username, $pass))){
                    print_r("connection failed"); //returns a result if not valid
                    }else{//connection is succesful
                        if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
                        print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
                    }
                }

function sum_up($sex){//creates function that sums up all the values
    global $server,
    $username,
    $pass,
    $db_name;
    //creates a connection and check if its valid
    if(!($dbdoor = mysqli_connect($server, $username, $pass))){
        print_r("connection failed"); //returns a result if not valid
    }else{//connection is succesful
        if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
            print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
        }else{//if we are here then we have connected and selected- here is where the magic happens
            $query = "SELECT * FROM $sex"; //creates query
            If(!($result = mysqli_query($dbdoor, $query))){ //runs the teh query to select everthing form the halls db and checks if it failed
                print_r('Query Failed<br>'. mysqli_error($dbdoor));//result to be printed if failed
            }else{//if the query successfully selected the data then:
                while($row = mysqli_fetch_array($result)){
                  $sum =  
                  $row['ring_road'] 
                  + $row['basketball'] 
                  + $row['cross_country'] 
                  + $row['hockey'] 
                  + $row['cricket'] 
                  + $row['volleyball'] 
                  + $row['table_tennis'] 
                  + $row['football'] 
                  + $row['netball'] 
                  + $row['badminton'] 
                  + $row['tennis'] 
                  + $row['sports_day'] ;

                  $this_hall = $row['halls']; //saves this hall into a variable
                  $query_sum = "UPDATE $sex SET total = '$sum' WHERE halls = '$this_hall'"; //creates query to change row's sum
                 if(!( mysqli_query($dbdoor, $query_sum) )){//runs query and checks if it failed
                     print_r("sum not addadded because:<br>" . mysqli_error($dbdoor));//error message
                     }  else {
                     }
                }
            }
            
        }//closes if(else) select db statement
    }//closes connection else statment
}//ends sum_up funcion


function Print_table_basic($table){//creates function that sums up all the values
    global $server,
    $username,
    $pass,
    $db_name;
    
    $is_chansea = false;
    //creates a connection and check if its valid
    if(!($dbdoor = mysqli_connect($server, $username, $pass))){
        print_r("connection failed"); //returns a result if not valid
    }else{//connection is succesful
        if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
            print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
        }else{//if we are here then we have connected and selected- here is where the magic happens
            switch($table){
                case "combined":
                    $query = "SELECT * FROM combined ORDER BY total DESC"; //creates query
                    break;
                
                case "females":
                    $query = "SELECT * FROM females ORDER BY total DESC"; //creates query
                    break;
                
                case "males":
                    $query = "SELECT * FROM males ORDER BY total DESC"; //creates query
                    break;
                default:
                    echo "guess you didn't want a table";
            }
          
            If(!($result = mysqli_query($dbdoor, $query))){ //runs the teh query to select everthing form the halls db and checks if it }failed
                print_r('Query Failed<br>'. mysqli_error($dbdoor));//result to be printed if failed
            }else{//if the query successfully selected the data then:
                print_r('<table class="table table-striped table-dark basic-table">
                <thead>
                  <tr>
                    <th scope="col">Pos</th>
                    <th scope="col">Hall</th>
                    <th scope="col">Points</th>
                  </tr>
                </thead>
                <tbody>');//prints table's head and opening body tag
                $pos = 0;//declare a position variable
                while($row = mysqli_fetch_array($result)){
                    $pos++;//increments positions
                    $this_class = "bg-rest";//instantiats a this class variable to manipulate background
                    switch($pos){
                        case 1: 
                        $this_class = "bg-first";
                        break;
                        case 2:
                        $this_class = "bg-second";
                        break;
                        case 3:
                        $this_class = "bg-third";
                        break;
                     }//sets color of bg dending on position
                    if( $row['halls'] == 'ChanSea' && $table == "combined"){
                        $url   = "img/logos/csh.png";
                    }else{
                        if( $row['srl'] == 'ch' && $table == 'females'){
                            $url = "img/logos/msh.png";
                        }else{
                            $url = "img/logos/" . $row['srl'] .  ".png";          
                        }
                    }
                    print_r('<tr class="'. $this_class .'">
                    <th scope="row" class="positions">'. $pos .'</th>
                    <td ><h5 class="hall-name"> <img src=" '.$url.' "/> '.$row['halls'].' </h5></td>
                    <td><h6 class="totals">'.$row['total'].'</h6></td>
                    
                  </tr>');
                    $is_chansea = false;

                }
                print_r('  </tbody>
                </table>');
            }
            
        }//closes if(else) select db statement 
    }//closes connection else statment
}//ends sum_up funcion

function update_result(){
    global $server,
    $username,
    $pass,
    $problem,
    $db_name;
    $issues;
    
    if(strip_tags($_POST['update_type']) == 'null'){
                    $problem = true;
                   $issues .= '<div class="alert bg-danger" role="alert">Please select <strong>Update type</strong></div>'; 
    }
    if(strip_tags($_POST['sex'] )== 'null'){
                    $problem = true;
                   $issues .= '<div class="alert bg-danger" role="alert">Please select <strong>Gender</strong></div>'; 
    }
    if(strip_tags($_POST['event']) == 'null'){
                    $problem = true;
                   $issues .= '<div class="alert bg-danger" role="alert">Please select <strong>event</strong></div>'; 
    }
    
       if(!$problem){  if(!($dbdoor = mysqli_connect($server, $username, $pass))){
                print_r("connection failed"); //returns a result if not valid
            }else{//connection is succesful
                if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
                    print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
                }else{//if we are here then we have connected and selected- here is where the magic happens
                    $stripped_sex = strip_tags($_POST['sex']);
                    $updated = "";
                    $sex = $stripped_sex; 
                    $query = "SELECT * 
                    FROM $sex 
                    ORDER BY total DESC"; //creates query to select all rows

                    If(!($result = mysqli_query($dbdoor, $query))){ //runs the teh query to select everthing form the halls db and checks if it failed
                        print_r('Query Failed<br>'. mysqli_error($dbdoor));//result to be printed if failed
                    }else{//if the query successfully selected the data then: 
                        while($row = mysqli_fetch_array($result)){ //iterates through table - this while will replicate the names of all the field and dynamically call its values
                            if(isset($_POST[$row['srl'].'_pos'])){
                            $this_name = $row['srl'] . '_pos'; //creates the name of the field dynamically
                            $this_value = $_POST[$this_name]; //fetches the value of the field using the name
                            $this_event = $_POST['event']; //gets event from the post field
                            $this_hall   = $row['id'];
                            if(isset($this_value)){ // checks if value was placed for the current iteration of halls
                                $update_query = "UPDATE $sex 
                                set $this_event = '$this_value'
                                WHERE id = $this_hall"; //creates a query that - updates the halls table - setting the event value taken from the post array of form
                                if(!(mysqli_query($dbdoor, $update_query))){
                                    print_r('problem inseerting score<br>
                                    '. mysqli_error($dbdoor) . '<br><br>');
                                }else{
                                    
                                };

                            }
                            }
                            
                            if($this_value != ""){
                                    $updated .= '<div class="update col-md-1"></strong><h5>'. $row['halls']. '</h5></storng> <br>Awarded:<br> <b>' . $this_value . ' points</b><br></div>';
                                    $this_value = "";
                            }
                        }
                            print_r('<div class="row updates">
                                <div class="col-sm-12">
                                <h3>Update Complete:</h3><h4>'. rtrim(ucfirst($_POST['sex']), 's'). ' ' . $this_event .' was updated</h4></div> ');
                            print_r($updated . "</div>");
                    }
                    
                }//closes if(else) select db statement
            }//closes connection else statment
            sum_up($_POST['sex']);

            $new_event = false;

            if($_POST['update_type'] == "new"){
                $new_event = true;
            }

            if($new_event){
                switch($sex){
                    case "males":
                    $table = "male_event_count";
                    break;
                    case "females":
                    $table = "female_event_count";
                    break;
                    default:
                    print_r("no gender selected");
                }
                noe_increment($table);
            }
                    combine();
                   }else{ 
                        print_r('<div class="alert bg-danger" role="alert"><h3>Error</h3></div>'. $issues); 
       }

}





//_____________________________________________________________________________________________________________________________________________________________________//


function noe($counter_sex){
    global $server,
$username,
$pass,
$db_name;
if(!($dbdoor = mysqli_connect($server, $username, $pass))){
print_r("connection failed"); //returns a result if not valid
}else{//connection is succesful
if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
    print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
}else{//if we are here then we have connected and selected- here is where the magic happens
    
    
    
    $query = "SELECT *
    FROM $counter_sex"; //creates query to select all rows

    If(!($result = mysqli_query($dbdoor, $query))){ //runs the teh query to select everthing form the halls db and checks if it failed
        print_r('Query Failed<br>'. mysqli_error($dbdoor));//result to be printed if failed
    }else{//if the query successfully selected the data then: 
        $row = mysqli_fetch_array($result);
        print_r('<h4 class="noe">After <span>'. $row['n'] .'</span> events . With <span>'. (12- $row['n']) .'</span> events to go</h4>');
        print_r('<h4 class="noe"></h4>');        
            }}
        }

    }

    function noe_increment($counter_sex){
        global $server,
        $username,
        $pass,
        $db_name;
        if(!($dbdoor = mysqli_connect($server, $username, $pass))){
        print_r("connection failed"); //returns a result if not valid
        }else{//connection is succesful
        if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
            print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
        }else{//if we are here then we have connected and selected- here is where the magic happens
            $query = "SELECT *
            FROM $counter_sex"; //creates query to select all rows
        
            If(!($result = mysqli_query($dbdoor, $query))){ //runs the teh query to select everthing form the halls db and checks if it failed
                print_r('Query Failed<br>'. mysqli_error($dbdoor));//result to be printed if failed
            }else{//if the query successfully selected the data then: 
                $row = mysqli_fetch_array($result);
                $current_noe = $row['n'];
                if($current_noe < 12){
                    $current_noe++;
                }

              
                $update_noe_query = "UPDATE $counter_sex 
                SET n = '$current_noe'
                WHERE id = 1";

                if(!(mysqli_query($dbdoor, $update_noe_query))){
                    print_r("Didn't increment: <br>" . mysqli_error($dbdoor));
                }


                     
                    }}
                }
    }

    


function combine(){
    
        global $server,
$username,
$pass,
$db_name;
    
    if(!($dbdoor = mysqli_connect($server, $username, $pass))){
                    print_r("connection failed"); //returns a result if not valid
                    }else{//connection is succesful
                        if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
                        print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
                    }else{
                            
                                $male_query = "SELECT * 
                                    FROM males 
                                    ORDER BY srl DESC";

                               $female_query = "SELECT * 
                                    FROM females 
                                    ORDER BY srl DESC";
                            
                            if(!($females = mysqli_query($dbdoor, $female_query))){
                                print_r("Didn't work out" . mysqli_error($dbdoor));
                                
                            }else{
                                if(!($males = mysqli_query($dbdoor, $male_query))){
                                        print('failed query: '. mysqli_error());
                                }
                            }
                                    while($fevent = mysqli_fetch_array($females)){
                                        $mevent = mysqli_fetch_array($males);
                                        $combined =  $fevent['total'] + $mevent['total'];
                                    
                                        $this_hall = $fevent['srl'];
                                            
                                        $combine_querry = "UPDATE combined
                                        SET total = $combined
                                        WHERE srl = '$this_hall'";
                                        
                                        if(!(mysqli_query($dbdoor, $combine_querry))){
                                            print_r('failed to add combined scores: <br>'. mysqli_error($dbdoor) );
                                        }
                                    }                            

                                }
                            }
}
sum_up("males");
?>