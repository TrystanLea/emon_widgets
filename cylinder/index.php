 <!-----
   All emon_widgets code is released under the GNU General Public License v3.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org

    Author: Trystan Lea: trystan.lea@googlemail.com
    If you have any questions please get in touch, try the forums here:
    http://openenergymonitor.org/emon/forum
 ---->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width" />
    <link rel="stylesheet" type="text/css" href="../android.css" media="only screen and (max-width: 480px)" />

<script type="text/javascript" src="cylinder.js"></script>
<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>

  <title>emoncms</title>

  </head>
  <body>


<canvas id="can" width="360" height="550" style="background-color:#ddd;"></canvas> 

<script type="application/javascript">

  var canvas = document.getElementById("can");
  var ctx = canvas.getContext("2d");

  ctx.clearRect(0,0,360,450);
  setInterval(update,10000);
  update();

  function update()
  {

    var timeWindow = (3*60*1000);				//Initial time window
    var start = ((new Date()).getTime())-timeWindow;		//Get start time
    var end = (new Date()).getTime();				//Get end time
    var res = 5;

    $.ajax({                                      
      url: 'http://server/emoncms2/api/getfeed',
      data: "&apikey=XXXXXXXXXXXXXXXXXXXXXXX&feedid="+1+"&start="+start+"&end="+end+"&resolution="+res,                      
      dataType: 'json',                           
      success: function(data) 
      { 
        var cyl_bot = 1*data[0][1];
        var cyl_bot_old = 1*data[data.length-1][1];

    $.ajax({                                      
      url: 'http://server/emoncms2/api/getfeed',
      data: "&apikey=XXXXXXXXXXXXXXXXXXXXXXX&feedid="+2+"&start="+start+"&end="+end+"&resolution="+res,                     
      dataType: 'json',                           
      success: function(data) 
      { 
        var cyl_top = 1*data[0][1];
        var cyl_top_old = 1*data[data.length-1][1];

        ctx.clearRect(0,0,360,500);
        draw_cylinder(cyl_bot,cyl_top);

        mins = 1.9*(50.0 - cyl_top); 
        ctx.fillStyle = "#666";
        ctx.fillText("Ready in: "+mins.toFixed(0)+" mins",180,45);

        //-------------------------------------------------------
        // Calculate power flux 
        //-------------------------------------------------------
        var time_diff = (data[0][0] - data[data.length-1][0])/1000;

        var top_diff = cyl_top - cyl_top_old;
        var bot_diff = cyl_bot - cyl_bot_old;

        var top_litre = 88;
        var energy_diff_top = 4200 * top_litre * top_diff;
        var energy_diff_bot = 4200 * (168-top_litre) * bot_diff;

        var power_top = energy_diff_top/time_diff;
        var power_bot = energy_diff_bot/time_diff;
        var power = power_top + power_bot;
        console.log(power_top+" | "+power_bot );

        ctx.font = "bold 22px arial";
        ctx.fillText("Total flux: "+power.toFixed(0)+" W",180,485);

        ctx.font = "bold 18px arial";
        ctx.fillText(power_top.toFixed(0)+" W",310,150);
        ctx.fillText(power_bot.toFixed(0)+" W",310,318+9);

        //-------------------------------------------------------
        // Calculate energy stored in cylinder
        //-------------------------------------------------------
        var ambient = 11.9;
        var energy_top = (4200*top_litre*(cyl_top-ambient));
        var energy_bot = (4200*(168-top_litre)*(cyl_bot-ambient));
        var energy = (energy_top + energy_bot) / 3600000;

        ctx.font = "bold 25px arial";
        ctx.fillText("Stored: "+energy.toFixed(2)+" kWh",180,435);

      }});


      }
    }); 


  }

</script>


</body>
</html>
