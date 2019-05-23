<?php session_start();
    $title = "Update scores";

    require('templates/dbbasics.php');
    require('templates/header.html');
?>
<?php

        if($_SERVER['REQUEST_METHOD']=='POST'){   
            update_result();
        }
?>
            <div class="row">
               <div class="col-lg-10 offset-lg-1 event-form">
                         
               <div class="row">
                   <div class="col-sm col-lg-6 offset-lg-3">
                        <h1 class="align-middle main-title">Hall Of Halls 2018-19</h1>
                              <h3>Add Event</h3>
                            
                    </div>
               </div>
                   <form  class="form-stacked" action="event.php" method="post">
                   
                      <div class="row event-select">
                      <div class="col-sm-6 offset-sm-3">
                          <select class="custom-select" name="update_type">
                                <option value="null"><b>update type</b></option>
                                <option value="existing">Existing</option>
                                <option value="new">New Event</option>
                            </select>
                          </div>
                      </div>
                       <div class="row event-select">
                      <div class="col-sm-6 offset-sm-3">
                          <select class="custom-select" name="sex">
                                <option value="null">Gender</option>
                                <option value="males">Male</option>
                                <option value="females">Female</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group row">


                          <div class="col-sm-6 offset-sm-3">
                          <select class="custom-select" name="event">
                                <option selected value="null">Event</option>
                                <option value="ring_road">Ring Road</option>
                                <option value="cross_country">Cross Country</option>
                                <option value="volleyball">Volley Ball</option>
                                <option value="table_tennis">Table Tennis</option>
                                <option value="football">Football</option>
                                <option value="tennis">Tennis</option>
                                <option value="badminton">Badminton</option>
                                <option value="basketball">Basketball</option>
                                <option value="hockey">Hokey</option>
                                <option value="netball">Netball</option>
                                <option value="sports_day">Sports Day</option>
                                <option value="cricket">Cricket</option>
                            </select>
                          </div>
                          <div class="col-md-12">
                
                          <div class=" row">
                                 
                            <?php
                                    
                              function checked(){
                                  if(isset($_POST[$row['srl'].'_pos']))
                                    {
                                        return "checked";
                                    }else{
                                      return 'the value is: ' . $row['srl'];
                                      
                                  }
                              }
                              
                                    if(!($dbdoor = mysqli_connect('localhost', $username, $pass))){
                                        print_r("connection failed"); //returns a result if not valid
                                    }else{//connection is succesful
                                        if(!(mysqli_select_db($dbdoor, $db_name))){//attemp to select db and say if it worked
                                            print_r('failed to select db<br>' . mysqli_error($dbdoor));//if db not selected return message and msqli erro
                                        }else{//if we are here then we have connected and selected- here is where the magic happens
                                            $query = "SELECT * FROM combined"; //creates query
                                            If(!($result = mysqli_query($dbdoor, $query))){ //runs the teh query to select everthing form the halls db and checks if it failed
                                                print_r('Query Failed<br>'. mysqli_error($dbdoor));//result to be printed if failed
                                            }else{//if the query successfully selected the data then:
                                                while($row = mysqli_fetch_array($result)){
                                                   
                                                   
                                                    print_r('
                                                    <div class="col-md-8 offset-md-2 form-check-inline checkline">
                                                        <div class=" row">
                                                            <div class="event-form-hall">
                                                            '. $row['halls'] .'
                                                            </div>
                                                            
                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos"  value="10" id="1st">
                                                                    <label class="form-check-label" for="1st">1st</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="8" id="2nd"> 
                                                                    <label class="form-check-label" for="2nd">2nd</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="7" id="3rd">
                                                                    <label class="form-check-label" for="3rd">3rd</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="6" id="4th">
                                                                    <label class="form-check-label" for="4th">4th</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="5" id="5th">
                                                                    <label class="form-check-label" for="5th">5th</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="4" id="6th">
                                                                    <label class="form-check-label" for="6th">6th</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="3" id="7th">
                                                                    <label class="form-check-label" for="7th">7th</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="2" id="8th">
                                                                    <label class="form-check-label" for="8th">8th</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="1" id="9th">
                                                                    <label class="form-check-label" for="9th">9th</label>
                                                                </div>
                                                                
                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="0.5" id="10th">
                                                                    <label class="form-check-label" for="10th">10th</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="0.0" id="Disqualified">
                                                                    <label class="form-check-label" for="Disqualified">DQ</label>
                                                                </div>

                                                                <div class="form-check ">
                                                                    <input type="radio" class="form-check-input" name="'.$row['srl'].'_pos" value="0" s="MIA">
                                                                    <label class="form-check-label" for="MIA">MIA</label>
                                                                </div>
                                                                
                                                        
                                                        </div>
                                                    </div>');

                                                
                                                
                                                }
                                            }
                                            
                                        }//closes if(else) select db statement
                                    }
                            ?>
                          </div>

                          
                         
                          </div>
    
                            
                      </div>
                      <input type="submit" class="btn btn-primary my-btn" value="update">
                   </form>
               </div>

           </div>           

       
<?php require('templates/footer.html') ?>