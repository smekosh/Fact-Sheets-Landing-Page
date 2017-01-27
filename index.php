<?php

$csv = 'VOAFactSheets-Sheet1.csv';

$faq = array();
$row = 1;

if (($handle = fopen( $csv, "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		if ( $row > 1 ) {
			$faq[$data[0]][$data[1]] = array( 'division' => $data[0], 'service' => $data[1], 'est' => $data[2], 'url' => str_ireplace( '?nocache=1', '', $data[3] ) );
		}
		
		$row++;
	}
	
	fclose($handle);
}



?><!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="IE=edge" http-equiv="X-UA-Compatible" />
	
	<style type="text/css">
		
		body {
			color: #333;
			font-family: sans-serif;
			margin: 0; 
			padding: 0;
		}
		
		a {
			color: #333;
			text-decoration: none;
		}
		
		.division > header {
			font-family: "SkolarSans-BdCond_Cyr-Ltn",Arial,"Arial Unicode MS",Helvetica,sans-serif;
			font-size: 27px;
			border-bottom: 1px solid #ccc;
			padding-bottom: 4.5px;
			margin: 1em 0;
			margin-bottom: 0;
			color: #999;
			line-height: 1.2;
			text-align: left;
		}
		
		ul.services {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			margin: 0;
			padding: 1em 0 0 0;
			width: 100%;
		}
		
		.services li {
			list-style: none;
			margin: 0;
			padding: 0;
			width: 33.333333%;
		}
		
		.services li a {
			background-color: #fcfcfc;
			border-left: 4px solid #1330bf;
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1),0 1px 5px 0 rgba(0,0,0,.1);
			display: block;
			margin: 1em;
			padding: 1em;
		}
		
		.services li a:hover { background-color: #1330bf; }
		
		.service-name {
			color: #666;
			font-family: serif;
			font-size: 1.5em;
			font-weight: normal;
		}
		
		.services li a:hover .service-name { color: #fff; }
		
		.established {
			color: #999;
			display: block;
			font-size: .8em;
			padding-top: .25em;
			text-transform: uppercase;
		}
		
		.services li a:hover .established { color: #ddd; }
		
		footer {
			color: #666;
			font-family: sans-serif;
			font-size: .8em;
			padding-top: 3em;
		}
		
		
		
	</style>
</head>

<body>
	
	<?php foreach ( $faq as $division => $services ) { ?>
	<section class="division">
		<header><?php echo $division; ?></header>
		<ul class="services">
		
			<?php foreach ( $services as $service => $facts ) { ?>
			<li><a href="<?php echo $facts['url']; ?>">
				<span class="service-name"><?php echo $service; ?></span>
				<?php if ( trim($facts['est']) != '' ) { ?>
				<span class="established">Established <?php echo $facts['est']; ?></span>
				<?php } ?>
			</a></li>
			<?php } ?>
		
		</ul>
	</section>
	<?php } ?>
	
	<footer><strong>*</strong> Initial year service was established. Re-established in later years.</footer>
	
	<pre><?php //xprint_r($faq); ?></pre>
	
</body>
</html>
