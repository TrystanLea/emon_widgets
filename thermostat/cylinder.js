/*
   All emon_widgets code is released under the GNU General Public License v3.
   See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org

    Author: Trystan Lea: trystan.lea@googlemail.com
    If you have any questions please get in touch, try the forums here:
    http://openenergymonitor.org/emon/forum
 */

  function draw_cylinder(cyl_bot,cyl_top)
  {
  ctx.strokeStyle = "#fff";
  ctx.lineWidth = 8;

  var diff = cyl_top - cyl_bot;
  var step_diff = -diff / 5;
  var step_temp = cyl_top;


  ctx.fillStyle = "#606463";
  ctx.beginPath();
  ctx.arc(180,250,220,Math.PI*2,0,false);
  ctx.closePath();
  ctx.fill();

  ctx.fillStyle = "#080d0b";
  ctx.beginPath();
  ctx.arc(180,250,200,Math.PI*2,0,false);
  ctx.closePath();
  ctx.fill();

  ctx.fillStyle = get_color(step_temp);
  ctx.beginPath();
  ctx.arc(180,250,120,Math.PI*2,0,false);
  ctx.closePath();
  ctx.fill();
/*
  ctx.beginPath();
  ctx.arc(180,250,120,-Math.PI,Math.PI,false);
  ctx.closePath();
  ctx.stroke();*/

 ctx.strokeStyle = "rgba(255,255,255,0.6)";
  ctx.lineWidth = 1;
  var xo, yo, a = 0;
  ctx.beginPath();
    for (a=0.6; a<(2*Math.PI-0.6); a+=0.05)
    {
      xo = Math.sin(a);
      yo = Math.cos(a);
      ctx.moveTo(180+xo*90,250+yo*90); ctx.lineTo(180+xo*110,250+yo*110);
    }
  ctx.closePath();
  ctx.stroke();

 var start = 2.6;
 var end = 3.5;

 ctx.strokeStyle = "rgba(255,255,255,0.8)";
  ctx.lineWidth = 2;
  var xo, yo, a = 0;
  ctx.beginPath();
    for (a=start; a<end; a+=0.05)
    {
      xo = Math.sin(a);
      yo = Math.cos(a);
      ctx.moveTo(180+xo*90,250+yo*90); ctx.lineTo(180+xo*110,250+yo*110);
    }
  ctx.closePath();
  ctx.stroke();
  ctx.lineWidth = 4;
  ctx.beginPath();
      xo = Math.sin(start);
      yo = Math.cos(start);
      ctx.moveTo(180+xo*85,250+yo*85); ctx.lineTo(180+xo*110,250+yo*110);
      xo = Math.sin(end);
      yo = Math.cos(end);
      ctx.moveTo(180+xo*90,250+yo*90); ctx.lineTo(180+xo*110,250+yo*110);
  ctx.closePath();
  ctx.stroke();


      xo = Math.sin(end+0.2);
      yo = Math.cos(end+0.2);
  ctx.fillStyle = "#fff";
  ctx.textAlign    = "center";
  ctx.font = "bold 14px arial";
  ctx.fillText(cyl_top.toFixed(0),180+xo*95,250+yo*95);


  ctx.lineWidth = 8;
  ctx.fillStyle = "#fff";
  ctx.textAlign    = "center";
  ctx.font = "bold 100px arial";
  ctx.fillText("50",180,260+35);

  ctx.font = "normal 20px arial";
 ctx.fillStyle = "#ffe2d7";
   
  mins = 1.9*(50.0 - cyl_top); 
  ctx.fillText("IN "+mins.toFixed(0)+" MIN",180,215);

  ctx.font = "normal 20px arial";
  ctx.fillStyle = "#ddd";
  ctx.fillText("OEM",180,105);

  }

  function get_color(temperature)
  {
    var red = (32+(temperature*3.95)).toFixed(0);
    var green = 40;
    var blue = (191-(temperature*3.65)).toFixed(0);
    return "#e94402";
    //return "rgb("+red+","+green+","+blue+")";
  }

