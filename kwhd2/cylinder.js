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

  ctx.fillStyle = get_color(step_temp);
  ctx.beginPath();
  ctx.arc(180,150,80,Math.PI,0,false);
  ctx.closePath();
  ctx.fill();

  var y = 150, bh=28;
  ctx.fillStyle = get_color(step_temp); step_temp += step_diff;
  ctx.fillRect(100,y,160,bh); y+=bh;
  ctx.fillStyle = get_color(step_temp); step_temp += step_diff;
  ctx.fillRect(100,y,160,bh); y+=bh;
  ctx.fillStyle = get_color(step_temp); step_temp += step_diff;
  ctx.fillRect(100,y,160,bh); y+=bh;
  ctx.fillStyle = get_color(step_temp); step_temp += step_diff;
  ctx.fillRect(100,y,160,bh); y+=bh;
  ctx.fillStyle = get_color(step_temp); step_temp += step_diff;
  ctx.fillRect(100,y,160,bh); y+=bh;
  ctx.fillStyle = get_color(step_temp);
  ctx.fillRect(100,y,160,bh); y+=bh;

  ctx.fillStyle = get_color(step_temp);
  ctx.beginPath();
  ctx.arc(180,318,80,0,Math.PI,false);
  ctx.closePath();
  ctx.fill();

  ctx.beginPath();
  ctx.arc(180,150,80,Math.PI,0,false);
  ctx.arc(180,318,80,0,Math.PI,false);

  ctx.closePath();
  ctx.stroke();

  ctx.fillStyle = "#fff";
  ctx.textAlign    = "center";
  ctx.font = "bold 30px arial";
  ctx.fillText(cyl_top.toFixed(1)+"C",180,150);
  ctx.fillText(cyl_bot.toFixed(1)+"C",180,318+15);
  }

  function get_color(temperature)
  {
    var red = (32+(temperature*3.95)).toFixed(0);
    var green = 40;
    var blue = (191-(temperature*3.65)).toFixed(0);
    return "rgb("+red+","+green+","+blue+")";
  }

