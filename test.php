<?php 
include('simple_html_dom.php');
$html = file_get_html('https://www.formula1.com/');
$data = ''; 
foreach($html->find('.race-list .race') as $element) {
	// $img_country =$element->find("div.country div.flag img", 0)->src; 
	// echo $img_country	. '<br>';
	$data =   $element->outertext;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<style type="text/css">
	.clock {
		border-radius: 50%;
		background: #fff url('https://cssanimation.rocks/images/posts/clocks/ios_clock.svg') no-repeat center;
		background-size: 88%;
		height: 20em;
		/*padding-bottom: 31%;*/
		position: relative;
		width: 20em;
	}

	.clock.simple:after {
		background: #000;
		border-radius: 50%;
		content: "";
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		width: 5%;
		height: 5%;
		z-index: 10;
	}
	.minutes-container, .hours-container, .seconds-container {
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
	}
	.hours {
		background: #000;
		height: 20%;
		left: 48.75%;
		position: absolute;
		top: 30%;
		transform-origin: 50% 100%;
		width: 2.5%;
	}
	.minutes {
		background: #000;
		height: 40%;
		left: 49%;
		position: absolute;
		top: 10%;
		transform-origin: 50% 100%;
		width: 2%;
	}
	.seconds {
		background: #000;
		height: 45%;
		left: 49.5%;
		position: absolute;
		top: 14%;
		transform-origin: 50% 80%;
		width: 1%;
		z-index: 8;
	}
	.hours-container {
		animation: rotate 43200s infinite linear;
	}
	.minutes-container {
		animation: rotate 3600s infinite steps(60);
	}
	.seconds-container {
		animation: rotate 60s infinite steps(60);
	}
	@keyframes rotate {
		100% {
			transform: rotateZ(360deg);
		}
	}
</style>
</head>
<body>
<div class="container">
	
</div>
<article class="clock">
	<div class="hours-container">
		<div class="hours"></div>
	</div>
	<div class="minutes-container">
		<div class="minutes"></div>
	</div>
	<div class="seconds-container">
		<div class="seconds"></div>
	</div>
</article>

<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript">
	var data = '<?php echo $data ;?>';
	$('.container').html(data);
	setTimeout(function(){ 
		var src = $('.flag img').attr('src');
		$('.flag img').attr('src','https://www.formula1.com'+src);
	}, 1000);
	this.initLocalClocks();
	function initLocalClocks() {	
		var date = new Date;
		var seconds = date.getSeconds();
		var minutes = date.getMinutes();
		var hours = date.getHours();
		console.log(hours)
		var hands = [
		{
			hand: 'hours',
			angle: (hours * 30) + (minutes / 2)
		},
		{
			hand: 'minutes',
			angle: (minutes * 6)
		},
		{
			hand: 'seconds',
			angle: (seconds * 6)
		}
		];
		for (var j = 0; j < hands.length; j++) {
			var elements = document.querySelectorAll('.' + hands[j].hand);
			for (var k = 0; k < elements.length; k++) {
				elements[k].style.webkitTransform = 'rotateZ('+ hands[j].angle +'deg)';
				elements[k].style.transform = 'rotateZ('+ hands[j].angle +'deg)';
				if (hands[j].hand === 'minutes') {
					elements[k].parentNode.setAttribute('data-second-angle', hands[j + 1].angle);
				}
			}
		}
	}
</script>
</body>
</html>