function getXMLHttp()
{
  var xmlHttp
  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}
function MakeLikeRequest(linkid)
{
  var xmlHttp = getXMLHttp();
  //alert(linkid);
  xmlHttp.onreadystatechange = function()
  {
	  document.getElementById('likeDivReturn' + linkid).innerHTML = xmlHttp.responseText;
  }
  xmlHttp.open("GET", current_site_url_fav + "FavUnFav.php?flag_id=2&stream_id=" + linkid, true); 
  xmlHttp.send(null);
}
function MakeFlagRequest(linkid)
{
  var xmlHttp = getXMLHttp();
  //alert(linkid);
  xmlHttp.onreadystatechange = function()
  {
	  document.getElementById('FlagDivReturn' + linkid).innerHTML = xmlHttp.responseText;
  }
  xmlHttp.open("GET", current_site_url_fav + "FavUnFav.php?flag_id=3&stream_id=" + linkid, true); 
  xmlHttp.send(null);
}
function MakeBlockRequest(linkid)
{
  var xmlHttp = getXMLHttp();
  //alert(linkid);
  xmlHttp.onreadystatechange = function()
  {
	  document.getElementById('BlockDivReturn' + linkid).innerHTML = xmlHttp.responseText;
   		//alert(linkid);
  }
  xmlHttp.open("GET", current_site_url_fav + "BlockUser.php?stream_id=" + linkid, true); 
  xmlHttp.send(null);
}
function PickBoxFE(PBD_id)
{
  var xmlHttp = getXMLHttp();
  //alert(PBD_id);
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
	  document.getElementById('PBDDivReturn').innerHTML = xmlHttp.responseText;
    }
  }
  xmlHttp.open("GET", current_site_url_fav + "PickBox.php?PBD_id=" + PBD_id, true); 
  xmlHttp.send(null);
}