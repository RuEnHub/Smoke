timeend = new Date(2022, 0, 1, 0, 0, 0, 0);
function time() {
    today = new Date();
    today = Math.floor((timeend-today)/1000);
    tsec=today%60; today=Math.floor(today/60); if(tsec<10)tsec='0'+tsec;
    tmin=today%60; today=Math.floor(today/60); if(tmin<10)tmin='0'+tmin;
    thour=today%24; today=Math.floor(today/24);

    //-------ДНИ
    if((today%100>=11)&&(today%100<=14)) dayname=" дней "
    else {
        switch (today%10)
        {
            case (1): dayname = " день "; break;
            case (2):
            case (3):
            case (4): dayname=" дня "; break;
            default: dayname=" дней "
        }
    }
    //-------ЧАСЫ
    if((thour%100>=11)&&(thour%100<=14)) thourname=" часов "
    else {
        switch (thour%10)
        {
            case (1): thourname = " час "; break;
            case (2):
            case (3):
            case (4): thourname=" часа "; break;
            default: thourname=" часов "
        }
    }
    //-------МИНУТЫ
    if((tmin%100>=11)&&(tmin%100<=14)) tminname=" минут "
    else {
        switch (tmin%10)
        {
            case (1): tminname = " минута "; break;
            case (2):
            case (3):
            case (4): tminname=" минуты "; break;
            default: tminname=" минут "
        }
    }
    //-------СЕКУНДЫ
    if((tsec%100>=11)&&(tsec%100<=14)) tsecname=" секунд "
    else {
        switch (tsec%10)
        {
            case (1): tsecname = " секунда "; break;
            case (2):
            case (3):
            case (4): tsecname=" секунды "; break;
            default: tsecname=" секунд "
        }
    }

    timestr=today+dayname+ thour+thourname+"<br>"+tmin+tminname+tsec+tsecname;
    if (document.getElementById('time')) {
        document.getElementById('time').innerHTML=timestr;
        document.getElementById('time1').innerHTML=timestr;
        window.setTimeout("time()",1000);
    }  

}


