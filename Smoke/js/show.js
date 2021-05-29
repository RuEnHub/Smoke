 /*ВСПЛЫВАЮЩЕЕ ОКНО*/
 function edit(state)
{
	if (document.getElementById("edit"))
    	document.getElementById('edit').style.display = state;    
    document.getElementById('gray').style.display = state;      
}
function add(state)
{
	if (document.getElementById("add"))
    	document.getElementById('add').style.display = state;    
    document.getElementById('gray').style.display = state;      
}
function time_info(state)
{
    document.getElementById('time_info').style.display = state;    
    document.getElementById('gray').style.display = state;      
}