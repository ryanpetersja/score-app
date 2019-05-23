<?php session_start();
    $title = "Scoreboard";
    require('templates/dbbasics.php');
    require('templates/header.html');
?>

            <div class="row">

             
              <div class="col-lg-6 offset-lg-3 score-tabs">
                    <ul class="nav nav-pills nav-fill">
                      <li id="all" class="nav-item selected">
                        <a class="nav-link " href="#all" onclick="switchTable('combined')">Combined</a>
                      </li>
                      <li id="boys" class="nav-item">
                        <a class="nav-link" href="#all" onclick="switchTable('males')">Males</a>
                      </li>
                      <li  id="girls"class="nav-item">
                        <a class="nav-link" href="#all" onclick="switchTable('females')">Females</a>
                      </li>
                    </ul>
              </div>
              
               <div class="offset-lg-3 col-lg-6" id="combined">
                  
                   <h2  class="table-sub">Combined Score</h2>
                   <h1 class="align-middle main-title">Hall Of Halls 2018-19</h1>
                   <?php
                       Print_table_basic('combined'); 
                   ?>
               </div>
                       
                <div class="offset-lg-3 col-lg-6" id="males">
                  <h2  class="table-sub bg-info">Males</h2>
                   <h1 class="align-middle main-title">Hall Of Halls 2018-19</h1>
                    

                   <?php
                       noe("male_event_count");
                       Print_table_basic('males'); 
                   ?>
               </div>
               
                <div class="offset-lg-3 col-lg-6" id="females">
                    <h2  class="table-sub bg-danger">Female</h2> 
                   <h1 class="align-middle main-title">Hall Of Halls 2018-19</h1>
                   <?php
                        noe('female_event_count');
                       Print_table_basic("females"); 
                   ?>
               </div>
           </div>   
               <script src="js/jq.js"></script>
                   <script>
                                        $("#males").slideUp(100);
                                        $("#females").slideUp(100);
                     
                         function switchTable(table){
                                        
                               switch(table){
                                   
                                   case 'combined':
                                        $("#all").addClass("selected");
                                        $("#boys").removeClass("selected");
                                        $("#girls").removeClass("selected");

                                        $("#females").slideUp(1200);
                                        $("#males").slideUp(1200);
                                        $("#combined").slideDown(1200).delay(200).fadeIn( 400 );

                                       break;
                                    
                                       
                                 case 'females':
                                        $("#girls").addClass("selected");
                                        $("#boys").removeClass("selected");
                                        $("#all").removeClass("selected");                                      
                                        $("#females").slideDown(1200).delay(200).fadeIn( 400 );
                                        $("#combined").slideUp(1200);
                                        $("#males").slideUp(1200);
                                       break;   
                                       
                                   case 'males':
                                        $("#boys").addClass("selected");
                                        $("#girls").removeClass("selected");
                                        $("#all").removeClass("selected");
                                        $("#males").slideDown(1200).delay(200).fadeIn( 400 );
                                        $("#combined").slideUp(1200);
                                        $("#females").slideUp(100);
                                       break;
                                       
                                  
                                       
                                   default:
                                       consol.log("nothing shown");
                                           }
                       }

</script>        
     
<?php require('templates/footer.html') ?>