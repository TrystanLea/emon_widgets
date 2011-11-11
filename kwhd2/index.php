
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


<canvas id="can" width="360" height="575" style="background-color:#ddd;"></canvas> 

<script type="application/javascript">

  var canvas = document.getElementById("can");
  var ctx = canvas.getContext("2d");

  ctx.clearRect(0,0,360,450);

  var kwhd = 0;
  var power = 0;

  setInterval(update,10000);
  update();

  function update()
  {

    $.ajax({                                      
      url: 'http://server/emoncms2/api/getfeedvalue?apikey=xxxxxxxxxxxxxxxxxxxx&feedid=1',                         
      dataType: 'json',                           
      success: function(data) 
      { 
        kwhd = data*1;

    $.ajax({                                      
      url: 'http://server/emoncms2/api/getfeedvalue?apikey=xxxxxxxxxxxxxxxxxxxxx&feedid=2',                         
      dataType: 'json',                           
      success: function(data) 
      { 
        power = data*1;
        draw()
      }
    }); 


      }
    }); 


  }

  function draw()
  {

  ctx.clearRect(0,0,360,575);
    var ppk = 35;		// points per kwh
    var h = kwhd * ppk;
    var d = new Date();
    var hours = d.getHours();
    var projected = 24 * (kwhd / hours);

    ctx.fillStyle = "rgba(240,150,0,0.5)";

    var projected_at_power = kwhd + (power*(24-hours)*0.001);

    var ypos = 400;

   ctx.fillStyle = "#f8a01b";
    ctx.fillRect(40,ypos-h,60,h);
    ctx.fillStyle = "#378d42";
    ctx.fillRect(110,ypos-(projected_at_power*ppk),60,(projected_at_power*ppk));
    ctx.fillStyle = "#87c03f";
    ctx.fillRect(180,ypos-(projected*ppk),60,(projected*ppk));
 

    // TICKS
    ctx.lineWidth = 4;
    ctx.strokeStyle = "#888";
    ctx.beginPath();
    var y = ypos; for (var i=0; i<10; i++) { ctx.moveTo(260,y); ctx.lineTo(280,y); y-=ppk; }
    ctx.closePath();
    ctx.stroke();

    // KEY
    var key_x = 35;
    ctx.strokeStyle = "#fff";
    ctx.fillStyle = "#378d42";
    ctx.fillRect(key_x,ypos+100,25,25);
    ctx.strokeRect(key_x,ypos+100,25,25);
    ctx.fillStyle = "#87c03f";
    ctx.fillRect(key_x,ypos+135,25,25);
    ctx.strokeRect(key_x,ypos+135,25,25);

    ctx.fillStyle = "#f8a01b";
    ctx.fillRect(key_x,ypos+35,25,25);
    ctx.strokeRect(key_x,ypos+35,25,25);


    ctx.textAlign    = "left";
    ctx.font = "normal 16px arial";
    ctx.fillStyle = "#666";

    ctx.fillText("Actual energy used",key_x+35,ypos+35+18);
    ctx.font = "bold 16px arial";
    ctx.fillText("Estimated use based on:",key_x,ypos+70+16);
    ctx.font = "normal 16px arial";
    ctx.fillText("Current power use",key_x+35,ypos+100+18);
    ctx.fillText("Energy used so far",key_x+35,ypos+135+18);

    ctx.fillText(kwhd.toFixed(1)+" kWh",key_x+235,ypos+35+18);
    ctx.fillText(projected_at_power.toFixed(1)+" kWh",key_x+235,ypos+100+18);
    ctx.fillText(projected.toFixed(1)+" kWh",key_x+235,ypos+135+18);

    ctx.font = "bold 28px arial";
    ctx.fillStyle = "#666";
    ctx.textAlign    = "center";
    ctx.fillText("Energy use today",180,50);

  }

</script>


</body>
</html>
