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
<script src="setTimeArray.js"></script>
<script src="setTimeOut.js"></script>
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


                const tc = temCs.toString().split('.');
                $('#temC').html(tc[0]);
                const tm = temCMax.toString().split('.');
                $('#temMax').html(tm[0]);
                const tn = temCMin.toString().split('.');
                $('#temMin').html(tn[0]);
            }
        });
        //api line 2
        //10:00 =-1, 13:00=-2,17:00=-3,19:00=-4, 23:00=-5
        $.ajax({
            url: apiLine2 + "lat=" + lat + "&lon=" + lon + "&appid=" + appKey,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var obj = JSON.parse(JSON.stringify(data));
                var now = new Date();
                var strNow = pad2(now.getHours()) + "" + pad2(now.getMinutes());
                countTime = setTimes(parseInt(strNow));
                //7,15 ,23,31,39 (Time:00:00:00)
                var codeDay1 = obj.list[8 - countTime].weather[0].id;
                var codeDay2 = obj.list[16 - countTime].weather[0].id;
                var codeDay3 = obj.list[24 - countTime].weather[0].id;
                var codeDay4 = obj.list[32 - countTime].weather[0].id;
                var codeDay5 = obj.list[40 - countTime].weather[0].id;

                var datePredict1 = obj.list[8 - countTime].dt_txt;
                const dSplit1 = new Date(datePredict1);
                var txtDayThais1 = convertDay(dSplit1);

                var datePredict2 = obj.list[16 - countTime].dt_txt;
                const dSplit2 = new Date(datePredict2);
                var txtDayThais2 = convertDay(dSplit2);

                var datePredict3 = obj.list[24 - countTime].dt_txt;
                const dSplit3 = new Date(datePredict3);
                var txtDayThais3 = convertDay(dSplit3);

                var datePredict4 = obj.list[32 - countTime].dt_txt;
                const dSplit4 = new Date(datePredict4);
                var txtDayThais4 = convertDay(dSplit4);

                var datePredict5 = obj.list[40 - countTime].dt_txt;
                const dSplit5 = new Date(datePredict5);
                var txtDayThais5 = convertDay(dSplit5);
                $('#dayName-TH1').html(txtDayThais1);
                $('#dayName-TH2').html(txtDayThais2);
                $('#dayName-TH3').html(txtDayThais3);
                $('#dayName-TH4').html(txtDayThais4);
                $('#dayName-TH5').html(txtDayThais5);

                // alert(codeDay1+":"+codeDay2+":"+codeDay3+":"+codeDay4+":"+codeDay5);
                //day1 
                // 800 , 801, 803 , 300, 200, 000
                // codeDay1 = "803";
                if (codeDay1 == 800) {
                    $('#imageDay1').html('<img src="./img/sun.svg" >');
                    document.getElementById('imageDay1').className = 'IMG-DAY-ICON1';
                } else if (codeDay1 == 801 || codeDay1 == 802) {
                    $('#imageDay1').html('<img src="./img/sun-cloud.svg" >');
                    document.getElementById('imageDay1').className = 'IMG-DAY-ICON2';
                } else if (codeDay1 == 803 || codeDay1 == 804) {
                    $('#imageDay1').html('<img src="./img/cloud.svg" >');
                    document.getElementById('imageDay1').className = 'IMG-DAY-ICON3';
                } else if (
                    codeDay1 == 300 ||
                    codeDay1 == 301 ||
                    codeDay1 == 302 ||
                    codeDay1 == 310 ||
                    codeDay1 == 311 ||
                    codeDay1 == 312 ||
                    codeDay1 == 313 ||
                    codeDay1 == 314 ||
                    codeDay1 == 321 ||
                    codeDay1 == 500 ||
                    codeDay1 == 501 ||
                    codeDay1 == 502 ||
                    codeDay1 == 503 ||
                    codeDay1 == 504 ||
                    codeDay1 == 511 ||
                    codeDay1 == 520 ||
                    codeDay1 == 521 ||
                    codeDay1 == 522 ||
                    codeDay1 == 531) {
                    $('#imageDay1').html('<img src="./img/rain-cloud.svg" >');
                    document.getElementById('imageDay1').className = 'IMG-DAY-ICON4';
                    var rainMM1 = obj.list[8 - countTime].rain['3h'];
                    $('#rainValue-TH1').html(getRainConvert(rainMM1));
                } else if (
                    codeDay1 == 200 ||
                    codeDay1 == 201 ||
                    codeDay1 == 202 ||
                    codeDay1 == 210 ||
                    codeDay1 == 211 ||
                    codeDay1 == 212 ||
                    codeDay1 == 221 ||
                    codeDay1 == 230 ||
                    codeDay1 == 231 ||
                    codeDay1 == 232) {
                    $('#imageDay1').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay1').className = 'IMG-DAY-ICON5';
                    var rainMM1 = obj.list[8 - countTime].rain['3h'];
                    $('#rainValue-TH1').htmlgetRainConvert((rainMM1));

                } else {
                    $('#imageDay1').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay1').className = 'IMG-DAY-ICON5';
                }

                //day2
                // 800 , 801, 803 , 300, 200, 000
                //  codeDay2 = "200";
                if (codeDay2 == 800) {
                    $('#imageDay2').html('<img src="./img/sun.svg" >');
                    document.getElementById('imageDay2').className = 'IMG-DAY-ICON1';
                } else if (codeDay2 == 801 || codeDay2 == 802) {
                    $('#imageDay2').html('<img src="./img/sun-cloud.svg" >');
                    document.getElementById('imageDay2').className = 'IMG-DAY-ICON2';
                } else if (codeDay2 == 803 || codeDay2 == 804) {
                    $('#imageDay2').html('<img src="./img/cloud.svg" >');
                    document.getElementById('imageDay2').className = 'IMG-DAY-ICON3';
                } else if (
                    codeDay2 == 300 ||
                    codeDay2 == 301 ||
                    codeDay2 == 302 ||
                    codeDay2 == 310 ||
                    codeDay2 == 311 ||
                    codeDay2 == 312 ||
                    codeDay2 == 313 ||
                    codeDay2 == 314 ||
                    codeDay2 == 321 ||
                    codeDay2 == 500 ||
                    codeDay2 == 501 ||
                    codeDay2 == 502 ||
                    codeDay2 == 503 ||
                    codeDay2 == 504 ||
                    codeDay2 == 511 ||
                    codeDay2 == 520 ||
                    codeDay2 == 521 ||
                    codeDay2 == 522 ||
                    codeDay2 == 531) {
                    $('#imageDay2').html('<img src="./img/rain-cloud.svg" >');
                    document.getElementById('imageDay2').className = 'IMG-DAY-ICON4';
                    var rainMM2 = obj.list[16 - countTime].rain['3h'];
                    $('#rainValue-TH2').html(getRainConvert(rainMM2));
                } else if (
                    codeDay2 == 200 ||
                    codeDay2 == 201 ||
                    codeDay2 == 202 ||
                    codeDay2 == 210 ||
                    codeDay2 == 211 ||
                    codeDay2 == 212 ||
                    codeDay2 == 221 ||
                    codeDay2 == 230 ||
                    codeDay2 == 231 ||
                    codeDay2 == 232) {

                    $('#imageDay2').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay2').className = 'IMG-DAY-ICON5';
                    var rainMM2 = obj.list[16 - countTime].rain['3h'];
                    $('#rainValue-TH2').html(getRainConvert(rainMM2));
                } else {
                    $('#imageDay2').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay2').className = 'IMG-DAY-ICON5';
                }

                //day 3
                // 800 , 801, 803 , 300, 200, 000
                //  codeDay3 = "800";
                if (codeDay3 == 800) {
                    $('#imageDay3').html('<img src="./img/sun.svg" >');
                    document.getElementById('imageDay3').className = 'IMG-DAY-ICON1';
                } else if (codeDay3 == 801 || codeDay3 == 802) {
                    $('#imageDay3').html('<img src="./img/sun-cloud.svg" >');
                    document.getElementById('imageDay3').className = 'IMG-DAY-ICON2';
                } else if (codeDay3 == 803 || codeDay3 == 804) {
                    $('#imageDay3').html('<img src="./img/cloud.svg" >');
                    document.getElementById('imageDay3').className = 'IMG-DAY-ICON3';
                } else if (
                    codeDay3 == 300 ||
                    codeDay3 == 301 ||
                    codeDay3 == 302 ||
                    codeDay3 == 310 ||
                    codeDay3 == 311 ||
                    codeDay3 == 312 ||
                    codeDay3 == 313 ||
                    codeDay3 == 314 ||
                    codeDay3 == 321 ||
                    codeDay3 == 500 ||
                    codeDay3 == 501 ||
                    codeDay3 == 502 ||
                    codeDay3 == 503 ||
                    codeDay3 == 504 ||
                    codeDay3 == 511 ||
                    codeDay3 == 520 ||
                    codeDay3 == 521 ||
                    codeDay3 == 522 ||
                    codeDay3 == 531) {
                    $('#imageDay3').html('<img src="./img/rain-cloud.svg" >');
                    document.getElementById('imageDay3').className = 'IMG-DAY-ICON4';
                    var rainMM3 = obj.list[24 - countTime].rain['3h'];
                    $('#rainValue-TH3').html(getRainConvert(rainMM3));
                } else if (
                    codeDay3 == 200 ||
                    codeDay3 == 201 ||
                    codeDay3 == 202 ||
                    codeDay3 == 210 ||
                    codeDay3 == 211 ||
                    codeDay3 == 212 ||
                    codeDay3 == 221 ||
                    codeDay3 == 230 ||
                    codeDay3 == 231 ||
                    codeDay3 == 232) {
                    $('#imageDay3').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay3').className = 'IMG-DAY-ICON5';
                    var rainMM3 = obj.list[24 - countTime].rain['3h'];
                    $('#rainValue-TH3').html(getRainConvert(rainMM3));

                } else {
                    $('#imageDay3').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay3').className = 'IMG-DAY-ICON5';
                }

                //day 4
                // 800 , 801, 803 , 300, 200, 000
                //    codeDay4 = "200";
                if (codeDay4 == 800) {
                    $('#imageDay4').html('<img src="./img/sun.svg" >');
                    document.getElementById('imageDay4').className = 'IMG-DAY-ICON1';
                } else if (codeDay4 == 801 || codeDay4 == 802) {
                    $('#imageDay4').html('<img src="./img/sun-cloud.svg" >');
                    document.getElementById('imageDay4').className = 'IMG-DAY-ICON2';
                } else if (codeDay4 == 803 || codeDay4 == 804) {
                    $('#imageDay4').html('<img src="./img/cloud.svg" >');
                    document.getElementById('imageDay4').className = 'IMG-DAY-ICON3';
                } else if (
                    codeDay4 == 300 ||
                    codeDay4 == 301 ||
                    codeDay4 == 302 ||
                    codeDay4 == 310 ||
                    codeDay4 == 311 ||
                    codeDay4 == 312 ||
                    codeDay4 == 313 ||
                    codeDay4 == 314 ||
                    codeDay4 == 321 ||
                    codeDay4 == 500 ||
                    codeDay4 == 501 ||
                    codeDay4 == 502 ||
                    codeDay4 == 503 ||
                    codeDay4 == 504 ||
                    codeDay4 == 511 ||
                    codeDay4 == 520 ||
                    codeDay4 == 521 ||
                    codeDay4 == 522 ||
                    codeDay4 == 531) {
                    $('#imageDay4').html('<img src="./img/rain-cloud.svg" >');
                    document.getElementById('imageDay4').className = 'IMG-DAY-ICON4';
                    var rainMM4 = obj.list[32 - countTime].rain['3h'];
                    $('#rainValue-TH4').html(getRainConvert(rainMM4));
                } else if (
                    codeDay4 == 200 ||
                    codeDay4 == 201 ||
                    codeDay4 == 202 ||
                    codeDay4 == 210 ||
                    codeDay4 == 211 ||
                    codeDay4 == 212 ||
                    codeDay4 == 221 ||
                    codeDay4 == 230 ||
                    codeDay4 == 231 ||
                    codeDay4 == 232) {
                    $('#imageDay4').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay4').className = 'IMG-DAY-ICON5';
                    var rainMM4 = obj.list[32 - countTime].rain['3h'];
                    $('#rainValue-TH4').html(getRainConvert(rainMM4));
                } else {
                    $('#imageDay4').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay4').className = 'IMG-DAY-ICON5';
                }

                //day 5
                // 800 , 801, 803 , 300, 200, 000
                //  codeDay5 = codeDay4;
                if (codeDay5 == 800) {
                    $('#imageDay5').html('<img src="./img/sun.svg" >');
                    document.getElementById('imageDay5').className = 'IMG-DAY-ICON1';
                } else if (codeDay5 == 801 || codeDay5 == 802) {
                    $('#imageDay5').html('<img src="./img/sun-cloud.svg" >');
                    document.getElementById('imageDay5').className = 'IMG-DAY-ICON2';
                } else if (codeDay5 == 803 || codeDay5 == 804) {
                    $('#imageDay5').html('<img src="./img/cloud.svg" >');
                    document.getElementById('imageDay5').className = 'IMG-DAY-ICON3';
                } else if (
                    codeDay5 == 300 ||
                    codeDay5 == 301 ||
                    codeDay5 == 302 ||
                    codeDay5 == 310 ||
                    codeDay5 == 311 ||
                    codeDay5 == 312 ||
                    codeDay5 == 313 ||
                    codeDay5 == 314 ||
                    codeDay5 == 321 ||
                    codeDay5 == 500 ||
                    codeDay5 == 501 ||
                    codeDay5 == 502 ||
                    codeDay5 == 503 ||
                    codeDay5 == 504 ||
                    codeDay5 == 511 ||
                    codeDay5 == 520 ||
                    codeDay5 == 521 ||
                    codeDay5 == 522 ||
                    codeDay5 == 531) {
                    $('#imageDay5').html('<img src="./img/rain-cloud.svg" >');
                    document.getElementById('imageDay5').className = 'IMG-DAY-ICON4';
                    var rainMM5 = obj.list[40 - countTime].rain['3h'];
                    $('#rainValue-TH5').html(getRainConvert(rainMM5));
                } else if (
                    codeDay5 == 200 ||
                    codeDay5 == 201 ||
                    codeDay5 == 202 ||
                    codeDay5 == 210 ||
                    codeDay5 == 211 ||
                    codeDay5 == 212 ||
                    codeDay5 == 221 ||
                    codeDay5 == 230 ||
                    codeDay5 == 231 ||
                    codeDay5 == 232) {
                    $('#imageDay5').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay5').className = 'IMG-DAY-ICON5';
                    var rainMM5 = obj.list[40 - countTime].rain['3h'];
                    $('#rainValue-TH5').html(getRainConvert(rainMM5));

                } else {
                    $('#imageDay5').html('<img src="./img/rain-cloud-light.svg" >');
                    document.getElementById('imageDay5').className = 'IMG-DAY-ICON5';
                }


            }
        });

    }

    setTimeout(run_the_clock, setTimeOuts1(1));
    setTimeout(FETCH_DATA, setTimeOuts2(1));
    setInterval(run_the_clock, setTimeOuts3(1));
    setInterval(FETCH_DATA, setTimeOuts4(1));

    function convertDay(dayNames) {
        const dSplit = new Date(dayNames);

        var dateP = dSplit.toString().split(" ");
        var txtDayThai = "";
        if (dateP[0] == "Sun") {
            txtDayThai = "อา";
        } else if (dateP[0] == "Mon") {
            txtDayThai = "จ";
        } else if (dateP[0] == "Tue") {
            txtDayThai = "อ";
        } else if (dateP[0] == "Wed") {
            txtDayThai = "พ";
        } else if (dateP[0] == "Thu") {
            txtDayThai = "พฤ";
        } else if (dateP[0] == "Fri") {
            txtDayThai = "ศ";
        } else if (dateP[0] == "Sat") {
            txtDayThai = "ส";
        }

        return txtDayThai;

    }

    function getRainConvert(rainValue) {
        var rainPer = "";
        if (rainValue <= 10) {
            rainPer = "25%";
        } else if (10.1 >= rainValue <= 35) {
            rainPer = "50%";
        } else if (35.1 >= rainValue <= 90) {
            rainPer = "75%";
        } else if (90.1 >= rainValue) {
            rainPer = "100%";
        }

        return rainPer;

    }
</script>
<?php include('style-font_672X288.php'); ?>
<?php include('style-background.php'); ?>
<!-- Preloader -->

<body style="background-color:#FFFFFF; ">
    <!-- <div class="pre-loader" style="width:641px;height:528px;background-color: #DDE3EF;">
        <div class="pre-loader-box" style="margin-top: -50px;">
            <div class="loader-logo"><img src="img/weather/icon.png" alt=""></div>
            <div class='loader-progress' id="progress_div" style="margin-top: -20px;">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text" style="color: #FFFFFF;">

            </div>
        </div>
    </div> -->
    <div class="object-wrapper">
        <div style="width:672px;height:288px; background-color: #DDE3EF;" align="center">
            <?php include('txt-header.php'); ?>
            <div id="backgroundHeader" style="width:635px;height:110px; margin-left: 7px; margin-right:7px;margin-top:5px;border-radius: 20px;box-shadow:1px 6px 14px #959595;">
                <table width="100%" border="0" style="color:#FFFFFF; height:100%;">
                <tr height="65%">
                        <td width="33%">
                            <!-- <img src="" id="imageMain"  class="ICON-IMG-MAIN" style="position: absolute;"> -->
                            <div align="center" id="imageMain"></div>
                        </td>
                        <td width="1%" align="center" rowspan="2">     <div class="vl" style="align-items:center;"></div></td>
                        <td width="32%" align="center">
                     
                            <img src="./img/cycle.svg" class="cycles-main" style="position: absolute; ">
                            <div align="center" class="TEMP-MAIN" id="temC" ></div>
                       
                        </td>
                        <td width="1%" align="center" rowspan="2">     <div class="vl"></div></td>
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
                        <td width="1%" align="center">  </td>
                        <td width="32%">
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
                        <td width="1%" align="right">  </td>
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
            <div id="backgroundFooter" style="width:635px;height:110px; margin-left: 7px; margin-right:7px;margin-top:15px;border-radius: 20px;box-shadow:1px 6px 14px #959595;" align="right">
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
                            <div align="center" id="imageDay1"></div>
                        </td>
                        <td align="center">
                            <div align="center" id="imageDay2"></div>
                        </td>
                        <td align="center">
                            <div align="center" id="imageDay3"></div>
                        </td>
                        <td align="center">
                            <div align="center" id="imageDay4"></div>
                        </td>
                        <td align="center">
                            <div align="center" id="imageDay5"></div>
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
                <div style="width:477px;height:110px;background-color:#FFFFFF;margin-top:15px;border-radius: 20px;">

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