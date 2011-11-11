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
      data: "&apikey=xxxxxxxxxxxxxxxxxxxxxxx&feedid="+1+"&start="+start+"&end="+end+"&resolution="+res,                      
      dataType: 'json',                           
      success: function(data) 
      { 
        var cyl_bot = 1*data[0][1];
        var cyl_bot_old = 1*data[data.length-1][1];

    $.ajax({                                      
      url: 'http://31.222.163.58/emoncms2/api/getfeed',
      data: "&apikey=d3e486d404139267c875c232d3f60e44&feedid="+171+"&start="+start+"&end="+end+"&resolution="+res,                     
      dataType: 'json',                           
      success: function(data) 
      { 
        var cyl_top = 1*data[0][1];
        var cyl_top_old = 1*data[data.length-1][1];

        ctx.clearRect(0,0,360,530);
        draw_cylinder(cyl_bot,cyl_top);

  ctx.fillStyle = "#666";
  ctx.textAlign    = "center";
  ctx.font = "bold 12px arial";
        ctx.fillText("This is a copy of the nest thermostat design",180,500);
        ctx.fillText("To get the real thing visit: store.nest.com",180,520);
      }});


      }
    }); 


  }

</script>


</body>
</html>
