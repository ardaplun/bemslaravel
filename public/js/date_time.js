function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        months_collapse = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        //result = ''+days[day]+' '+d+' '+months[month]+' '+year+ '  ' +' '+h+':'+m+':'+s;
        //document.getElementById(id).innerHTML = result;
        //$( "#date_time" ).html(result);
        $(".show-time").html(h+':'+m);
        // $(".show-time").html({{date("H:i")}});
        //$(".show-sec").html(': '+s);
        $(".show-date").html(d+' '+months_collapse[month]+' '+year);
        // $(".show-date").html({{date("d M Y")}});
        $(".show-weekday").html(days[day]);
        // $(".show-weekday").html({{date("l")}});
        $(".show-hour").html(h);
        // $(".show-hour").html({{date("H")}});
        //$(".show-month").html(months[month]);
        //$(".show-year").html(year);
        console.log("hello, lol");
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
