<?php
include_once('nc_google_search.class.php');

$search_results = '';
if(isset($_POST['search_box']) && $_POST['search_box'] != ''){

	$mySearch = new \nc\GoogleSiteSearch($_POST['search_box'], 20, 0, '005200784774386614563:ymm8zrvnepk');
	$search_results = $mySearch->get_results();
	
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<title>Google Site Search Demo</title>
  	</head>
  	<body>
		<h1>Custome Site Search</h1>
	  	<form method="POST">
			<label for="search_box">Search</label>
			<input type="text" id="search_box" name="search_box">
			<button type="submit">Search</button>
		</form>
		<?php if ($search_results != '') { ?>
		<div>
			<h2>Search Results</h2>
			<?php echo $search_results; ?>
		</div>
		<?php } ?>
  	</body>
</html>