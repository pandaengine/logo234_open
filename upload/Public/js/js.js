function startTime()
{
var today1=new Date()
var h=today1.getHours()
var m=today1.getMinutes()
var s=today1.getSeconds()
m=checkTime(m)
s=checkTime(s)
document.getElementById("time").innerHTML=h+":"+m+":"+s;
t=setTimeout('startTime()',500)
}

function checkTime(i)
{
if (i<10) 
  {i="0" + i}
  return i
}


var xmlhttp = false;
try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	
if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	
function showmail(event,cate) {
		    var objID = "maillist";
		    var serverPage =WWW_ROOT+"/data/tpl_ajax/"+cate+".html";
			var obj = document.getElementById(objID);
			xmlhttp.open("GET", serverPage);
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					obj.style.display="block";
            	var posx = event.clientX + document.body.scrollLeft;
		        var posy = event.clientY + document.body.scrollTop;
		            obj.style.left = posx + "px";
		            obj.style.top = posy + "px";
					obj.innerHTML = xmlhttp.responseText;
				}else{
					obj.style.display="block";
            	var posx = event.clientX + document.body.scrollLeft;
		        var posy = event.clientY + document.body.scrollTop;
		            obj.style.left = posx + "px";
		            obj.style.top = posy + "px";
			        obj.innerHTML = "Loading....";
		}
			}
			xmlhttp.send(null);
		} 
		
		function hiddenmail(){
			var obj = document.getElementById("maillist");
				obj.style.display="none";
		
		}
	