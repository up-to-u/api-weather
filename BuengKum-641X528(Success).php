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

        document.getElementById('hours').innerText = frst_h;
        document.getElementById('hours2').innerText = scnd_h;
        document.getElementById('colon').innerText = ":";
        document.getElementById('minutes').innerText = frst_m;
        document.getElementById('minutes2').innerText = scnd_m;

        var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];

        $('#dayNames').html(days[date.getDay()]);
        $('#dayNum').html(date.getDate());
        $('#monthName').html(months[date.getMonth()]);
        $('#yearNum').html(date.getFullYear());

    }

    var interval = setInterval(run_the_clock, 1000);
</script>
<script>
    document.addEventListener('contextmenu', event => event.preventDefault());

    function FETCH_DATA() {
        $.ajax({
            url: "https://api.openweathermap.org/data/2.5/find?lat=13.815769&lon=100.561135&cnt=1&appid=6ae62b536713a717371ecb69c08d7f65",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var obj = JSON.parse(JSON.stringify(data));
                var codes = obj.list[0].weather[0].id;
                var temK = obj.list[0].main.temp;
                var temCs = temK - 273.15;
                if (codes == 800) {
                    $('#logo').html(
                        '<img src="img/weather/1.svg" width="70" style="margin-top:-30px; margin-left:50px; margin-bottom:20px;">'
                    );
                } else if (codes == 801) {
                    $('#logo').html(
                        '<img src="img/weather/2.svg" style="margin-top:-40px; margin-left:28px;">');
                } else if (codes == 802 || codes == 803) {
                    $('#logo').html(
                        '<img src="img/weather/3.svg" style="margin-top:-40px; margin-left:28px;">');
                } else if (codes == 804) {
                    $('#logo').html(
                        '<img src="img/weather/4.svg" style="margin-top:-36px; margin-left:50px;margin-bottom:21px;" width="75" >'
                    );
                } else if (codes == 520 || codes == 521 || codes == 531) {
                    $('#logo').html(
                        '<img src="img/weather/5.svg" style="margin-top:-23px; margin-left:33px;"  width="83">'
                        );
                } else if (codes == 501) {
                    $('#logo').html(
                        '<img src="img/weather/6.svg" style="margin-top:-30px; margin-left:33px;margin-bottom:-10px;">'
                        );
                } else if (codes == 300 || codes == 310 || codes == 500) {
                    $('#logo').html(
                        '<img src="img/weather/7.svg" style="margin-top:-40px; margin-left:33px;">');
                } else if (codes == 302 || codes == 312 || codes == 502 || codes == 503 || codes == 504 ||
                    codes == 511 || codes == 522) {
                    $('#logo').html(
                        '<img src="img/weather/8.svg" style="margin-top:-25px; margin-left:45px;margin-bottom:12px;" width="73">'
                        );
                } else if (codes == 210) {
                    $('#logo').html(
                        '<img src="img/weather/9.svg" style="margin-top:-30px; margin-left:38px;margin-bottom:5px;" width="85">'
                        );
                } else if (codes == 221 || codes == 211 || codes == 201 || codes == 200 || codes == 230 ||
                    codes == 231 || codes == 232) {
                    $('#logo').html(
                        '<img src="img/weather/10.svg" style="margin-top:-30px; margin-left:40px;margin-bottom:12px;" width="78">'
                        );
                } else if (codes == 202 || codes == 212) {
                    $('#logo').html(
                        '<img src="img/weather/11.svg" style="margin-top:-30px; margin-left:50px;margin-bottom:12px;" width="78">'
                        );
                } else if (codes == 313 || codes == 321) {
                    $('#logo').html(
                        '<img src="img/weather/12.svg" style="margin-top:-30px; margin-left:50px;margin-bottom:12px;" width="78">'
                        );
                } else if (codes == 301 || codes == 311) {
                    $('#logo').html(
                        '<img src="img/weather/13.svg" style="margin-top:-30px; margin-left:50px;margin-bottom:12px;" width="78">'
                        );
                } else if (codes == 314) {
                    $('#logo').html(
                        '<img src="img/weather/14.svg" style="margin-top:-30px; margin-left:50px;margin-bottom:12px;" width="78">'
                        );
                } else {
                    $('#logo').html(
                        '<img src="img/weather/4.svg" style="margin-top:-36px; margin-left:50px;margin-bottom:21px;" width="75" >'
                    );
                }

                const tc = temCs.toString().split('.');
                $('#temC').html(tc[0]);
            }
        })
    }
    setInterval(FETCH_DATA, 1000);
</script>
<style>
    body {
        font-family: 'futuracondensed_extrabold';
    }

    .object-wrapper {
        display: flex;
        justify-content: left;
        align-items: left;
        min-height: 95vh;
    }
</style>

<!-- Preloader -->

<body style="background-color:#FFFFFF;">
    <div class="pre-loader" style="height:504px;width: 140px;">
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

        <div style="width: 140px; height:502px;background-color: #000000; color:#FFFFFF;">
            <table width="100%" style="color: #FFFFFF; width: 100%;
  border: 1px solid #FFFFFF; ">
                <tr style="height: 120px;">
                    <td style="padding-right:10px;" align="right">
                        <img src="img/weather/temp_c.svg" style="margin-top:25px; margin-right:51px;">
                        <div align="center" style="font-size: 30px; margin-left:-60px;margin-top:-24px;" id="temC">
                        </div>
                        <div align="center" id="logo"></div>
                    </td>
                </tr>
                <tr style="height: 100px;" align="center">
                    <td width="100%">
                        <div><img src="img/weather/ln2.svg" width="120" style="margin-top: -25px;"></div>
                        <table style="font-size: 40px;margin-top: -25px;">
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

                        <div style="font-size: 18px; margin-top:-15px; margin-left:70px; position: absolute;">
                            o'clock<br>
                        </div>
                        <div>
                            <img src="img/weather/ln1.svg" width="120">
                        </div>
                    </td>
                </tr>
                <tr style=" color:#FFFFFF;">
                    <td align="center">
                        <div align="center" style="font-size: 26px; margin-bottom:-5px;margin-top:-5px;" id="dayNames">
                        </div>
                        <div align="center" style="font-size: 40px; margin-bottom:-5px;margin-top:-5px;" id="dayNum">
                        </div>
                        <div align="center" style="font-size: 26px; margin-bottom:-5px;margin-top:-5px;" id="monthName">
                        </div>
                        <div align="center"
                            style="font-size: 40px; margin-bottom:-5px;margin-top:-5px; margin-bottom:2px;"
                            id="yearNum"></div>
                        <div style="border: 1px solid #FFFFFF;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="img/weather/logo.svg">
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
</body>

</html>