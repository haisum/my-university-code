function refresh_graph() 
{
	var divname = "#graph_wrapper";
  $(divname).html('<p align=center><img src="images/ajax-loader.gif"/><br><font size=1></p>');
  $(divname).load("refresh_graph.php");

}