function hideemptyads ()
{
	
	var all_div =$(".advisionad");
	var pattern = "<a";
	for ( var i=0; i < all_div.length; i++ )
    {
        html = all_div[i].innerHTML;
        if ( !html.match( pattern ) )
        {
            all_div[i].style.display = 'none';
        }
    }
	
}