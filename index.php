<?php include("connect.php"); ?>
<?php 
if($_POST['submitConfirm'] == "ConfirmUpdate"){
    mysqli_query($conn,"UPDATE api_location SET s_key='".$_POST['dataAppKeys']."', latitude='".$_POST['dataLats']."', longitude='".$_POST['dataLons']."' WHERE id='".$_POST['dataIDs']."'");
}else{

}
?>
<?php
$sql = "SELECT api_line_control FROM api_line WHERE id = 1";
$result = $dh->query($sql);
foreach ($result as $row) {
 $result_api_1 = $row['api_line_control'];
}

 $sql = "SELECT api_line_control FROM api_line WHERE id = 2";
$result = $dh->query($sql);
foreach ($result as $row) {
 $result_api_2 = $row['api_line_control'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>API-Weather</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="libraries\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="libraries\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&display=swap" rel="stylesheet">
     <!-- ion icon css -->
     <link rel="stylesheet" type="text/css" href="libraries\assets\icon\weather-icons\css\weather-icons.min.css">
	<link rel="stylesheet" type="text/css" href="libraries\assets\icon\weather-icons\css\weather-icons-wind.min.css">
     <link rel="stylesheet" type="text/css" href="libraries\assets\icon\ion-icon\css\ionicons.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="libraries\assets\icon\themify-icons\themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="libraries\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="libraries\assets\icon\feather\css\feather.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="libraries\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="libraries\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="libraries\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="libraries\assets\pages\data-table\extensions\responsive\css\responsive.dataTables.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="libraries\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="libraries\assets\css\jquery.mCustomScrollbar.css">

<style>
body { margin: 20; padding: 20; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<!-- Menu horizontal fixed layout -->

<body style="font-family: 'Noto Sans Thai', sans-serif;">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <div id="pcoded" class="pcoded">

        <div class="pcoded-container">
            <!-- Menu header start -->
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                    <i class="wi wi-day-fog" style="margin-left:30px;" ></i>&nbsp;
                       API Weather Plan B 
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                    
                          
                        </ul>
                        <ul class="nav-right">
                        <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Menu header end -->
            <div class="pcoded-main-container">
               
               
                <!-- Sidebar inner chat end-->
                <div class="pcoded-wrapper">
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                 
                                    <!-- Page body start -->
                                  
                                    <!-- Config. table start -->
                                    <div class="card" style="margin-top: -75px;">
                                     
                                            <div class="card-block">
                                                <div class="table-responsive">
                                                    <div class="dt-responsive table-responsive">
                                                        <table id="res-config" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>Location name</th>
                                                                    <!-- <th>Email</th> -->
                                                                    <th>[Time Prediction] ,&emsp;&emsp;&emsp; [ Latitude, Longitude, AppKey ]</th>
                                                              
                                                                    <th>Size</th>
                                                                    <th align="center">API Line 1 (.json)</th>
                                                                    <th align="center">API Line 2 (.json)</th>
 
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php

$sql = "SELECT * FROM api_location";
$result = $dh->query($sql);
  foreach ($result as $row) {
?>
     <tr>
                                                                    <td><?=$row['location_name_en']; ?> (<?=$row['location_name_th']; ?>)</td>
                                                                    <!-- <td><?=$row['email']; ?> </td> -->
                                                                 
                                                                    <td>
                                                                    <a href="check-time.php?api-line1=<?=$result_api_1;?>&api-line2=<?=$result_api_2;?>&lat=<?=$row['latitude']; ?>&lon=<?=$row['longitude']; ?>&app-key=<?=$row['s_key']; ?>" target="_blank"  style="color: #404E67;">
                                                                   <i class="icofont icofont-time"></i> : Time Prediction
</a>
                                                                    
                                                                        &emsp;&emsp;<a href="#" class="editData"  data-id="<?= $row['id']; ?>" data-lat="<?= $row['latitude']; ?>" data-lon="<?= $row['longitude']; ?>" data-appKey="<?= $row['s_key']; ?>" data-toggle="modal" data-target="#myModal"><i class="icofont icofont-ui-edit"></i> : [ <?=$row['latitude']; ?>, <?=$row['longitude']; ?>, AppKey ] </a></td>
                                                                    
                                                                    <td>
                                                                    <?php
$id = $row['id']; 
$sql = "SELECT * FROM size_location  WHERE api_location_fk = '".$id."'";
$result = $dh->query($sql);
  foreach ($result as $rowSub) {
?>  
<?php if($rowSub['display_status'] == "Y"){     ?>
    <a href="<?=$row['location_link_file']; ?>-<?=$rowSub['width']; ?>X<?=$rowSub['height']; ?>.php?api-line1=<?=$result_api_1;?>&api-line2=<?=$result_api_2;?>&lat=<?=$row['latitude']; ?>&lon=<?=$row['longitude']; ?>&app-key=<?=$row['s_key']; ?>" target="_blank"  style="color: #404E67;">
<Span><i class="ion-monitor"></i> [ </Span><?=$rowSub['width'];?>X<?=$rowSub['height'];?> <Span>] </Span> &emsp;&emsp;
</a>
<?php }else{ ?>

    <a href="#" style="cursor: default;color: #C95555;">
<Span><i class="ion-alert-circled" style="color: #F8C42C;" ></i> [ </Span><?=$rowSub['width'];?>X<?=$rowSub['height'];?> <Span>] </Span> &emsp;&emsp;
</a>
<?php } ?>





<?php  }  ?>

                                                                </td>
                                                                    <td>
                                                                    <a href="<?=$result_api_1;?>lat=<?=$row['latitude'];?>&lon=<?=$row['longitude'];?>&cnt=1&appid=<?=$row['s_key'];?>" target="_blank">
                                                                    Forecast Current 
  </a>
</td>
<td>
                                                                    <a href="<?=$result_api_2;?>lat=<?=$row['latitude'];?>&lon=<?=$row['longitude'];?>&appid=<?=$row['s_key'];?>" target="_blank">
                                                                    Forecast 5 days
  </a>
</td>
                                                                   
                                                                </tr>
<?php  }  ?>
                                                               
                                                   
                                                            </tbody>
                                                        </table>

                                                     
                                     
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                               
                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
              <!--start model-->

                                                   <!-- Button to Open the Modal -->
                                              

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><i class="icofont icofont-ui-settings"></i> Setting</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <!-- start contain -->
 
                                                
                                                <div class="card-block">
                                                   
                                                    <form action="index.php" method="POST">
                                                        
                                                
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Latitude</label>
                                                            <div class="col-sm-10">
                                                            <input type="hidden" class="form-control" id="dataIDs" name="dataIDs">
                                                                <input type="text" class="form-control" id="dataLats" name="dataLats">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Longitude</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" id="dataLons"  name="dataLons">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">AppKey</label>
                                                            <div class="col-sm-10">
                                                                <textarea rows="5" cols="5" class="form-control" id="dataAppKeys"  name="dataAppKeys"></textarea>
                                                            </div>
                                                        </div>
                                                     
                                                  
                                                   
                                                </div>
                                          
   <!-- end contain -->
                                                    
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" name="submitConfirm" value="ConfirmUpdate" class="btn btn-success" >Confirm Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
                                                   <!--end model-->
       <!-- Required Jquery -->
  
    <script type="text/javascript" src="libraries\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="libraries\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="libraries\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="libraries\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="libraries\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="libraries\bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="libraries\bower_components\modernizr\js\css-scrollbars.js"></script>

    <!-- data-table js -->
    <script src="libraries\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="libraries\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="libraries\assets\pages\data-table\js\jszip.min.js"></script>
    <script src="libraries\assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="libraries\assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="libraries\assets\pages\data-table\extensions\responsive\js\dataTables.responsive.min.js"></script>
    <script src="libraries\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
    <script src="libraries\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>
    <script src="libraries\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="libraries\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="libraries\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="libraries\bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="libraries\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="libraries\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="libraries\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
    <!-- Custom js -->
    <script src="libraries\assets\js\pcoded.min.js"></script>
    <script src="libraries\assets\js\menu\menu-hori-fixed.js"></script>
    <script src="libraries\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="libraries\assets\js\script.js"></script>
    <script>
 $(".editData").on("click", function() {
var dataID = $(this).attr('data-id');
var dataLat = $(this).attr('data-lat');
var dataLon = $(this).attr('data-lon');
var dataAppKey = $(this).attr('data-appKey');

$('#dataIDs').val(dataID);
$('#dataLats').val(dataLat);
$('#dataLons').val(dataLon);
$('#dataAppKeys').val(dataAppKey);

});
    </script>
</body>

</html>
