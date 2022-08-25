<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Weather</title>

    <title></title>
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <link rel="stylesheet" href="style.css">
</head>
<script>
    function run_the_clock() {
        var date = new Date();
        hr = date.getHours();
        min = date.getMinutes();
        sec = date.getSeconds();

        h = (hr % 24);
        console.log(hr % 24);

        h_str = h.toString();
        console.log("toString" + h_str);

        var frst_h = h_str.substring(0, 1);
        var scnd_h = h_str.substring(1);
        console.log("h substring : " + frst_h);
        console.log("h substring2 : " + scnd_h);

        tmp_min = (min < 10 ? '0' + min : min);
        m_str = tmp_min.toString();
        var frst_m = m_str.substring(0, 1);
        var scnd_m = m_str.substring(1);
        var frst_hr = "";
        if (frst_h.toString().length + scnd_h.toString().length >= 2) {
            frst_hr = frst_h;
        } else {
            frst_hr = pad2(frst_h);
        }
        document.getElementById('hours').innerText = frst_hr;
        document.getElementById('hours2').innerText = scnd_h;
        document.getElementById('colon').innerText = ":";
        document.getElementById('minutes').innerText = frst_m;
        document.getElementById('minutes2').innerText = scnd_m;

        var days = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"];
        // var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
        //     "November", "December"
        // ];

        $('#dayNames').html(days[date.getDay()]);
        $('#dayNum').html(date.getDate());
        // $('#monthName').html(months[date.getMonth()]);
        $('#yearNum').html(date.getFullYear());

    }

    var interval = setInterval(run_the_clock, 1000);
</script>
<script>
    function pad2(number) {

        return (number < 10 ? '0' : '') + number

    }
</script>
<script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    // alert(location.pathname+location.search);
    let params = new URLSearchParams(location.search);
    var apiLine1 = params.get('api-line1');
    var apiLine2 = params.get('api-line2');
    var lat = params.get('lat');
    var lon = params.get('lon');
    var appKey = params.get('app-key');

    function FETCH_DATA() {
//api line 1
        $.ajax({
            url: apiLine1 + "lat=" + lat + "&lon=" + lon + "&cnt=1&appid=" + appKey,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var obj = JSON.parse(JSON.stringify(data));
                var codes = obj.list[0].weather[0].id;
                var temK = obj.list[0].main.temp;
                var temCs = temK - 273.15;
                var temKMax = obj.list[0].main.temp_max;
                var temCMax = temKMax - 273.15;
                var temKMin = obj.list[0].main.temp_min;
                var temCMin = temKMin - 273.15;
                // 800 , 801, 803 , 300, 200, 000
                // codes = "200";
                if (codes == 800) {
                    $('#imageMain').html('<img class="ICON-IMG-MAIN1" src="./img/sun.svg" >');
                    document.getElementById('backgroundHeader').className = 'bg-1';
                    document.getElementById('backgroundFooter').className = 'bg-1';
                    $('#textWether').html("แจ่มใส");

                } else if (codes == 801 || codes == 802) {
                    $('#imageMain').html('<img class="ICON-IMG-MAIN2" src="./img/sun-cloud.svg" >');
                    document.getElementById('backgroundHeader').className = 'bg-2';
                    document.getElementById('backgroundFooter').className = 'bg-2';
                    $('#textWether').html("เมฆบางส่วน");

                } else if (codes == 803 || codes == 804) {
                    $('#imageMain').html('<img class="ICON-IMG-MAIN3" src="./img/cloud.svg" >');
                    document.getElementById('backgroundHeader').className = 'bg-3';
                    document.getElementById('backgroundFooter').className = 'bg-3';
                    $('#textWether').html("เมฆมาก");

                } else if (
                    codes == 300 ||
                    codes == 301 ||
                    codes == 302 ||
                    codes == 310 ||
                    codes == 311 ||
                    codes == 312 ||
                    codes == 313 ||
                    codes == 314 ||
                    codes == 321 ||
                    codes == 500 ||
                    codes == 501 ||
                    codes == 502 ||
                    codes == 503 ||
                    codes == 504 ||
                    codes == 511 ||
                    codes == 520 ||
                    codes == 521 ||
                    codes == 522 ||
                    codes == 531) {
                    $('#imageMain').html('<img class="ICON-IMG-MAIN4" src="./img/rain-cloud.svg" >');
                    document.getElementById('backgroundHeader').className = 'bg-4';
                    document.getElementById('backgroundFooter').className = 'bg-4';
                    $('#textWether').html("ฝนตก");

                } else if (
                    codes == 200 ||
                    codes == 201 ||
                    codes == 202 ||
                    codes == 210 ||
                    codes == 211 ||
                    codes == 212 ||
                    codes == 221 ||
                    codes == 230 ||
                    codes == 231 ||
                    codes == 232) {
                    $('#imageMain').html('<img class="ICON-IMG-MAIN5" src="./img/rain-cloud-light.svg" >');
                    document.getElementById('backgroundHeader').className = 'bg-5';
                    document.getElementById('backgroundFooter').className = 'bg-5';
                    $('#textWether').html("ฝนฟ้าคะนอง");

                } else {
                    $('#imageMain').html('<img class="ICON-IMG-MAIN5" src="./img/rain-cloud-light.svg" >');
                    document.getElementById('backgroundHeader').className = 'bg-5';
                    document.getElementById('backgroundFooter').className = 'bg-5';
                    $('#textWether').html("ฝนฟ้าคะนอง");
                }

                document.getElementById("imageDay1").src = "./img/cloud.svg";
                document.getElementById("imageDay2").src = "./img/cloud.svg";
                document.getElementById("imageDay3").src = "./img/cloud.svg";
                document.getElementById("imageDay4").src = "./img/cloud.svg";
                document.getElementById("imageDay5").src = "./img/cloud.svg";

                const tc = temCs.toString().split('.');
                $('#temC').html(tc[0]);
                const tm = temCMax.toString().split('.');
                $('#temMax').html(tm[0]);
                const tn = temCMin.toString().split('.');
                $('#temMin').html(tn[0]);


                $('#dayName-TH1').html("จ");
                $('#dayName-TH2').html("อ");
                $('#dayName-TH3').html("พ");
                $('#dayName-TH4').html("พฤ");
                $('#dayName-TH5').html("อ");
                $('#rainValue-TH1').html("");
                $('#rainValue-TH2').html("");
                $('#rainValue-TH3').html("");
                $('#rainValue-TH4').html("25%");
                $('#rainValue-TH5').html("50%");

            }
        });
        //api line 2
        $.ajax({
            url: apiLine2 + "lat=" + lat + "&lon=" + lon + "&cnt=1&appid=" + appKey,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var obj = JSON.parse(JSON.stringify(data));
                var codes = obj.list[0].weather[0].id;
              

            }
        });
    }
    setInterval(FETCH_DATA, 1000);
</script>
<?php include('style-font_641X528.php'); ?>
<?php include('style-background.php'); ?>
<!-- Preloader -->

<body style="background-color:#FFFFFF; ">
    <div class="pre-loader" style="width:641px;height:528px;background-color: #DDE3EF;">
        <div class="pre-loader-box" style="margin-top: -50px;">
            <div class="loader-logo"><img src="img/weather/icon.png" alt=""></div>
            <div class='loader-progress' id="progress_div" style="margin-top: -20px;">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text" style="color: #FFFFFF;">

            </div>
        </div>
    </div>
    <div class="object-wrapper">
        <div style="width:641px;height:528px; background-color: #DDE3EF;" align="center">
            <?php include('txt-header.php'); ?>
            <div id="backgroundHeader" style="width:590px;height:200px; margin-left: 7px; margin-right:7px;margin-top:20px;border-radius: 20px;box-shadow:1px 6px 14px #959595;">
                <table width="100%" border="0" style="color:#FFFFFF; height:100%;">
                    <tr height="65%">
                        <td width="33%">
                            <!-- <img src="" id="imageMain"  class="ICON-IMG-MAIN" style="position: absolute;"> -->
                            <div align="center" id="imageMain"></div>
                        </td>
                        <td width="34%" align="center">
                            <img src="./img/cycle.svg" class="cycles-main" style="position: absolute; ">
                            <div align="center" class="TEMP-MAIN" id="temC">
                            </div>
                        </td>
                        <td width="33%">
                            <div align="center" class="TXT_F1" id="dayNames">
                            </div>

                        </td>
                    </tr>
                    <tr height="35%">
                        <td width="33%" align="center">
                            <div align="center" class="TXT_F2" style="margin-bottom:-5px;margin-top:-5px;" id="textWether">
                            </div>

                        </td>
                        <td width="34%">
                            <table width="100%">
                                <tr>
                                    <td align="center" width="50%">
                                        <img src="./img/cycle.svg" class="cycles" style="position: absolute; ">
                                        <div align="center" class="TXT_F3MAX" id="temMax">

                                        </div>

                                    </td>
                                    <td align="center" width="50%">
                                        <img src="./img/cycle.svg" class="cycles" style="position: absolute; ">
                                        <div align="center" class="TXT_F3MIN" id="temMin">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="33%" align="center">
                            <table class="TXT_F4">
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="hours"></div>
                                    </td>
                                    <td>
                                        <div id="hours2"></div>
                                    </td>
                                    <td>
                                        <div id="colon"></div>
                                    </td>
                                    <td>
                                        <div id="minutes"></div>
                                    </td>
                                    <td>
                                        <div id="minutes2"></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="backgroundFooter" style="width:590px;height:200px; margin-left: 7px; margin-right:7px;margin-top:15px;border-radius: 20px;box-shadow:1px 6px 14px #959595;" align="right">
                <table style="position: absolute;" width="590" border="0">
                    <tr>
                        <td width="20%">
                            <div align="center" class="TXT_DAYS-FIRST" id="dayName-TH1">
                            </div>
                        </td>
                        <td width="20%">
                            <div align="center" class="TXT_DAYS" id="dayName-TH2">
                            </div>
                        </td>
                        <td width="20%">
                            <div align="center" class="TXT_DAYS" id="dayName-TH3">
                            </div>
                        </td>
                        <td width="20%">
                            <div align="center" class="TXT_DAYS" id="dayName-TH4">
                            </div>
                        </td>
                        <td width="20%">
                            <div align="center" class="TXT_DAYS" id="dayName-TH5">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <img src="" id="imageDay1" class="IMG-DAY-ICON">
                        </td>
                        <td align="center">
                            <img src="" id="imageDay2" class="IMG-DAY-ICON">
                        </td>
                        <td align="center">
                            <img src="" id="imageDay3" class="IMG-DAY-ICON">
                        </td>
                        <td align="center">
                            <img src="" id="imageDay4" class="IMG-DAY-ICON">
                        </td>
                        <td align="center">
                            <img src="" id="imageDay5" class="IMG-DAY-ICON">
                        </td>
                    </tr>
                    <tr>
                        <td align="center">

                            <div align="center" class="TXT_RAIN_VALUE_FIRST" id="rainValue-TH1"></div>
                        </td>
                        <td align="center">
                            <div align="center" class="TXT_RAIN_VALUE" id="rainValue-TH2"></div>
                        </td>
                        <td align="center">
                            <div align="center" class="TXT_RAIN_VALUE" id="rainValue-TH3"></div>
                        </td>
                        <td align="center">
                            <div align="center" class="TXT_RAIN_VALUE" id="rainValue-TH4"></div>
                        </td>
                        <td align="center">
                            <div align="center" class="TXT_RAIN_VALUE" id="rainValue-TH5"></div>
                        </td>
                    </tr>
                </table>
                <div style="width:477px;height:200px;background-color:#FFFFFF;margin-top:15px;border-radius: 20px;">

                </div>
            </div>
        </div>

    </div>
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
</body>

</html>