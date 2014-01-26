<?php
// Simple pagination snippet

	$perpage = 5;                               // This is 5 X per page (Posts, News, etc)
	$page    = intval(@$_GET['page']);          // Get $page and make sure it's integer..
	if($page > 0) $page--;                      // We start counting at 1 but machines start counting at 0
	
	$limit   = ($page*$perpage).','.($perpage); // First one is the page number times the number of items
	// Second is number of items it should get.
	
	// MySQL creds
	mysql_connect("localhost","root","");
	mysql_select_db("blog");
	
	// Get a query with all items in the table first.
	$tquery  = mysql_query("SELECT * FROM `ebws`");              // Edit this to match your needs
	$query   = mysql_query("SELECT * FROM `news` LIMIT $limit"); // Edit this to match your needs
	
	$numrows = mysql_num_rows($tquery);          // How many items are there?
	$pagecount = ceil($numrows/$perpage);        // Total page count
	
	# CSS Stuff
	print '<style>';
	print '#pagination ul{
		list-style-type: none;
		padding: 0px;
		margin: 0px;
	}
	#pagination li{
		float: left;
		margin-right: 5px;
		padding: 3px;
		border:1px solid #666;
		-webkit-border-radius: 5px; 
		-moz-border-radius: 5px; 
		border-radius: 5px; 
	}
	#pagination a{
		text-decoration:none;
	}
	#pagination .active{
		background: #ccc;
	}';
	print '</style>';
	print '<div id="pagination">';
	print '<ul>';
	
	# "Previous" link
	print '<a href="';
	if($page < 1){
		print '#';              // If it's 0 or less, then don't go lower
	}else{
		print '?page='.($page); // Else print the link
	}
	print '"><li>&lt;</li></a>';
	
	for($i=0;$i<$pagecount;$i++){
		print '<a href="?page='.($i+1).'"><li';
		if($page === $i){
			print ' class="active"'; // If we are at that page then mark it.
		}
		print '>'.($i+1).'</li></a>';
	}
		
	# "Next" link
	print '<a href="';
	if(($page+1) == $pagecount){
		print '#';                 // If it's equal to the page count (AKA last page) don't link it
	}else{
		print '?page='.($page+2);  // Else print the link
	}
	print '"><li>&gt;</li></a>';
	
	print '</ul>
	<br style="clear:both" />
	<p>Pages '.($page+1).' of '.$pagecount.'</p>';
	print '</div>';
?>
