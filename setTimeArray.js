function setTimes($times){

    var countTime = "";
    if ($times < 100) {
        return countTime = 1;
     
    } else if ($times >= 100 && $times < 1000) {
        return countTime = 1;
     
    } else if ($times >= 1000 && $times < 1300) {
        return countTime = 2;
     
    } else if ($times >= 1300 && $times < 1700) {
        return countTime = 3;
     
    } else if ($times >= 1700 && $times < 2300) {
        return countTime = 4;
     
    } else if ($times >= 2300) {
        return countTime = 6;
     
    } else {
        return countTime = 0;
    }
}
