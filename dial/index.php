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

<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="dial.js"></script>

  <title>emoncms</title>

  </head>
  <body>


<canvas id="can" width="360px" height="400px" style="background-color:#ddd;"></canvas> 

<script type="application/javascript">
  var canvas = document.getElementById("can");
  var ctx = canvas.getContext("2d");
  ctx.clearRect(0,0,360,400);

  var position = 0;
  var an = 0;
  
  var value = 0;
  var value2 = 0;
  var max_value = 500;

  setInterval(update,20);
  setInterval(getvalue,5000);
  getvalue();

  function update()
  {
    an += 0.01;
    
    value2 = curveValue(value2,parseFloat(value),0.02);


    draw_gauge(360/2,200,120,value2,1000,"W");
  }

  function getvalue()
  {
    $.ajax({                                      
      url: 'http://server/emoncms2/api/getfeedvalue?apikey=xxxxxxxxxxxxxxxxxxx&feedid=1',                         
      dataType: 'json',                           
      success: function(data) 
      { 
      value = data;
      }
    }); 
  }

       function curveValue(start,end,rate)
       {
         return start + ((end-start)*rate);
       }
</script>

</body>
</html>
