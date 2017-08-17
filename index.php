<?php

$csv = 'https://docs.google.com/spreadsheets/d/1RdTM5JXiaar2yesItAfWsa3hga5m5q9ykXdkJDaDpTI/pub?gid=0&single=true&output=csv';

$embed = $_GET['embed'];

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

ksort($faq);


if ( !$embed ) {

?><!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="IE=edge" http-equiv="X-UA-Compatible" />

<?php } ?>
	
	<style type="text/css">

<?php if ( !$embed ) { ?>	
		
		body { margin: 0; padding: 0; }
		
<?php } ?>
		
		.voafactsheet-wrapper {
			color: #333;
			font-family: sans-serif;
			margin: 0; 
			padding: 0;
		}
		
		a.voafactsheet-a {
			color: #333;
			text-decoration: none;
		}
		
		.voafactsheet-division > header.voafactsheet-header {
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
		
		ul.voafactsheet-services {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			margin: 0;
			padding: 1em 0 0 0;
			width: 100%;
		}
		
		.voafactsheet-services li.voafactsheet-li {
			list-style: none;
			margin: 0;
			padding: 0;
			width: 100%;
		}
		
		.voafactsheet-services li.voafactsheet-li a.voafactsheet-a {
			background-color: #fcfcfc;
			border-left: 4px solid #1330bf;
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1),0 1px 5px 0 rgba(0,0,0,.1);
			display: block;
			margin: 1em;
			padding: 1em;
		}
		
		.voafactsheet-services li.voafactsheet-li a.voafactsheet-a:hover { background-color: #1330bf; }
		
		.voafactsheet-service-name {
			color: #666;
			font-family: serif;
			font-size: 1.5em;
			font-weight: normal;
		}
		
		.voafactsheet-services li.voafactsheet-li a.voafactsheet-a:hover .voafactsheet-service-name { color: #fff; }
		
		.voafactsheet-established {
			color: #999;
			display: block;
			font-size: .8em;
			padding-top: .25em;
			text-transform: uppercase;
		}
		
		.voafactsheet-services li.voafactsheet-li a.voafactsheet-a:hover .voafactsheet-established { color: #ddd; }
		
		footer.voafactsheet-footer {
			color: #666;
			font-family: sans-serif;
			font-size: .8em;
			padding-top: 3em;
			padding-bottom: 2em;
		}
		
		
		
		@media (min-width: 500px) {
			
			.voafactsheet-services li.voafactsheet-li { width: 50%; }
			
		}
		
		
		
		@media (min-width: 750px) {
			
			.voafactsheet-services li.voafactsheet-li { width: 33.333333%; }
			
		}
		
		
	</style>
<?php if ( !$embed ) { ?>	
</head>

<body>
	
<?php } ?>
	
	<div class="voafactsheet-wrapper">
		
		<h1 class="voafactsheet-h1">VOA Language Service Fact Sheets</h1>
		
		<?php foreach ( $faq as $division => $services ) { ?>
		<section class="voafactsheet-division">
			<header class="voafactsheet-header"><?php echo $division; ?></header>
			<ul class="voafactsheet-services">
			
				<?php ksort($services); ?>
				<?php foreach ( $services as $service => $facts ) { ?>
				<li class="voafactsheet-li"><a class="voafactsheet-a" href="<?php echo $facts['url']; ?>">
					<span class="voafactsheet-service-name"><?php echo $service; ?></span>
					<?php if ( trim($facts['est']) != '' ) { ?>
					<span class="voafactsheet-established">Established <?php echo $facts['est']; ?></span>
					<?php } ?>
				</a></li>
				<?php } ?>
			
			</ul>
		</section>
		<?php } ?>
		
		<footer class="voafactsheet-footer"><strong>*</strong> Initial year service was established. Re-established in later years.</footer>
		
	</div>

<?php if ( !$embed ) { ?>

</body>
</html>

<?php } ?>
