<?php
    
    
   
   if (isset($_POST['city'])){
        $cityname = $_POST['city'];
   }
   else{
        $cityname= 'Dhaka';
   }
        $locationUrl = "http://api.openweathermap.org/geo/1.0/direct?q={$cityname}&limit=1&appid=4acc52d9b30bcfba2e82c8918a9f5863";

        $locations = json_decode(file_get_contents($locationUrl));
        $latitude = $locations[0]->lat;
        $long = $locations[0]->lon;
        
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat={$latitude}&lon={$long}&exclude=hourly,alerts,minutes&units=metric&appid=4acc52d9b30bcfba2e82c8918a9f5863";
        $url2 ="https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$long}&units=metric&appid=4acc52d9b30bcfba2e82c8918a9f5863";
        

        $contents = file_get_contents($url);
        $contents2 = file_get_contents($url2);
        $clima = json_decode($contents);
        $clima2 = json_decode($contents2);
        
        


        $hum =  $clima2->main->humidity;
        $speed = $clima2->wind->speed;
        $descrip = $clima2->weather[0]->description;
        $w = $clima2->weather[0]->main;
        $feel =  $clima2->main->feels_like;
        $vib = $clima2->visibility;
        

   
   
  
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="style.css">
     
    <title>Weather Forecast Report</title>
</head>
<body style="background-image: url(img/background.jpg); background-size:cover; background-repeat:no-repeat;">
    <div class="container-fluid p-5">
        <div class="container center mt-3 " style="background-color: rgba(0,0,0,.5);">
            <div class="row ">
                <div class="col-md-6 p-3" style="background-color:rgba(0, 0, 0, 0.30)">
                    <h1 class="text-center text-white mt-5 pt-5">Welcome To <BR> Weather Forecast</h1>
                    <form class=" mb-3 p-5" method="POST" action="weather.php">
                        
    
                            <input class="form-control rounded-pill" name="city" placeholder="Enter the city name" required>
                            <div class="text-center m-3">
                            <button type="submit" value="Submit" class="btn btn-primary rounded-pill" > Submit </button>
                            </div>
                       
                    </form>
                </div>
                <div class="col-md-6" style="background-image: url(img/<?php if ($clima2->weather[0]->main == "Clear"){
                                    echo "sunny.jpg";
                                    }
                                    elseif($clima2->weather[0]->main == "Clouds"){
                                        echo "cloudy.jpg";
                                    }
                                    elseif ($clima2->weather[0]->main == "Thunderstorm"){
                                        echo "thunderstorm.jpg";
                                    }
                                    elseif ($clima2->weather[0]->main == "Snow"){
                                        echo "snow.jpg";
                                    }
                                    elseif ($clima2->weather[0]->main == "Mist"){
                                        echo "mist.jpg";
                                    }
                                    elseif ($clima2->weather[0]->main == "Haze"){
                                        echo "mist.jpg";
                                    }
                                    elseif ($clima2->weather[0]->main == "Dust"){
                                        echo "dust.jpg";
                                    }

                                    else{
                                        echo "rain.jpg";
                                    }
                                    ?>
                                ); background-repeat:no-repeat; background-size:cover;">
                        <div class=" d-flex justify-content-center p-5">
                            <div class="card mt-5 pt-4" style="width: 25rem;border-radius:10px">
                                <div class="card-body">
                                    <div class="card-body">
                                    <h4 class="card-title" style="text-align:center" >Today's Weather Report</h4>
                                    <div class="text-center">
                                        <div class="badge text-wrap py-2" style="width: 6rem; background-color:beige;color:black"><?php echo $cityname?></div>
                                    </div>
                                    <p class="card-text">
                                        <div class="row">
                                            <div class="col-md-6 pt-2">
                                                <h4><?php echo date("F j, Y") ?></h4> 
                                                <p style="font-size: 25px; color:#DEB887">
                                                    <b><?php echo round($clima2->main->temp) ."&deg;C" ?></b>
                                                    <br>
                                                    <span style="color:black;font-size:13px;text-transform: capitalize;">
                                                        <?php echo $clima2->weather[0]->description ?>
                                                        <img src="http://openweathermap.org/img/wn/<?php echo $clima2->weather[0]->icon?>.png" ?>
                                                    </span>
                                                    
                                                </p>
                                            </div>
                                            
                                            <div class="col-md-6 d-flex" >
                                                <hr style="width:3px;height:100px">
                                                <ul class="pt-2" style="list-style: none">
                                                    <li class="py-1">Humidity: <?php echo $hum ."%"?></li>
                                                    <li class="py-1">Wind: <?php echo $speed ?> km/h</li>
                                                    <li class="py-1">Feels: <?php echo round($feel)."&deg;C" ?> </li>
                                                    <li class="py-1">Visibility: <?php echo $vib." m"; ?></li>     
                                                </ul>
                                            </div>
                                    
                                        </div>
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
        </div>
    </div>
    <div class="container mt-4 mb-5" style="background-image: url('img/background2.jpg'); background-repeat:no-repeat;background-size:cover;">
        <div class="text-center">
            <div class="badge text-wrap mt-5 py-4 " style="width: 20rem; background-color:white;color:black;font-size:25px;border-radius:10px">WEATHER FORECAST</div>
        </div>
       
        
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner p-5">
              <div class="carousel-item active" data-bs-interval="10000">
                  <div class=" d-flex justify-content-center">
                        
                        <div class="card m-3 " style="width: 15rem;">
                        
                            <div class="card-body text-center" >
                                
                                <h5 class="card-title"><?php echo date('F j, Y', $clima->daily[0]->dt) ?></h5>

                                <p class="card-text">
                                        
                                    <p style="font-size: 35px; color:#DEB887">

                                        <b><?php echo round( $clima->daily[0]->temp->day)."&deg;C" ?> </b>
                                        <br>
                                        <span style="color:black;font-size:13px;text-transform: capitalize;">
                                            <?php echo $clima->daily[0]->weather[0]->description ?>
                                            <img src="http://openweathermap.org/img/wn/<?php echo $clima->daily[0]->weather[0]->icon?>.png" ?>
                                        </span>
                                        
                                    
                                </p>
                                
                                
                            </div>
                        </div>
                        <div class="card m-3" style="width: 15rem;">
                            <div class="card-body text-center">
                               
                                <h5 class="card-title"><?php echo date('F j, Y', $clima->daily[1]->dt) ?></h5>
                                <p class="card-text">
                                    <p style="font-size: 35px; color:#DEB887">

                                    <b><?php echo round( $clima->daily[1]->temp->day)."&deg;C" ?> </b>
                                    <br>
                                    <span style="color:black;font-size:13px;text-transform: capitalize;">
                                        <?php echo $clima->daily[0]->weather[0]->description ?>
                                        <img src="http://openweathermap.org/img/wn/<?php echo $clima->daily[1]->weather[0]->icon?>.png" ?>
                                    </span>
                        
                                </p>
                               
                            </div>
                        </div>
                        <div class="card m-3" style="width: 15rem;">
                            <div class="card-body text-center">
                                
                                <h5 class="card-title"><?php echo date('F j, Y', $clima->daily[2]->dt) ?></h5>
                                <p class="card-text">
                                <p style="font-size: 35px; color:#DEB887">

                                        <b><?php echo round( $clima->daily[2]->temp->day)."&deg;C" ?> </b>
                                        <br>
                                        <span style="color:black;font-size:13px;text-transform: capitalize;">
                                            <?php echo $clima->daily[0]->weather[0]->description ?>
                                            <img src="http://openweathermap.org/img/wn/<?php echo $clima->daily[2]->weather[0]->icon?>.png" ?>
                                        </span>
                                
                                </p>
                                </div>
                           
                        </div>
                        
                  </div>
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <div class=" d-flex justify-content-center">
                    <div class="card m-3 " style="width: 15rem;">
                    
                        <div class="card-body text-center">
                            
                            <h5 class="card-title"><?php echo date('F j, Y', $clima->daily[3]->dt) ?></h5>
                            <p class="card-text">
                                <p style="font-size: 35px; color:#DEB887">

                                <b><?php echo round( $clima->daily[3]->temp->day)."&deg;C" ?> </b>
                                <br>
                                <span style="color:black;font-size:13px;text-transform: capitalize;">
                                    <?php echo $clima->daily[3]->weather[0]->description ?>
                                    <img src="http://openweathermap.org/img/wn/<?php echo $clima->daily[3]->weather[0]->icon?>.png" ?>
                                </span>


                                </p>
                            </p>
                           
                        </div>
                    </div>
                    <div class="card m-3" style="width: 15rem;">
                        <div class="card-body text-center">
                            
                            <h5 class="card-title"><?php echo date('F j, Y', $clima->daily[4]->dt) ?></h5>
                            <p class="card-text">
                                <p style="font-size: 35px; color:#DEB887">

                                    <b><?php echo round( $clima->daily[4]->temp->day)."&deg;C" ?> </b>
                                    <br>
                                    <span style="color:black;font-size:13px;text-transform: capitalize;">
                                        <?php echo $clima->daily[4]->weather[0]->description ?>
                                        <img src="http://openweathermap.org/img/wn/<?php echo $clima->daily[4]->weather[0]->icon?>.png" ?>
                                    </span>


                                </p>
                            </p>
                            
                        </div>
                    </div>
                    <div class="card m-3" style="width: 15rem;">
                        <div class="card-body text-center">
                            
                            <h5 class="card-title"><?php echo date('F j, Y', $clima->daily[5]->dt) ?></h5>
                            <p class="card-text">
                                <p style="font-size: 35px; color:#DEB887">

                                    <b><?php echo round( $clima->daily[5]->temp->day)."&deg;C" ?> </b>
                                    <br>
                                    <span style="color:black;font-size:13px;text-transform: capitalize;">
                                        <?php echo $clima->daily[5]->weather[0]->description ?>
                                        <img src="http://openweathermap.org/img/wn/<?php echo $clima->daily[5]->weather[0]->icon?>.png" ?>
                                    </span>


                                </p>
                            </p>
                           
                        </div>
                    </div>
                    
              </div>
              </div>
              
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
    
</body>
</html>

