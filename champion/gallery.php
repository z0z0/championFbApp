<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>		
		<script type="text/javascript" src="js/jPages.min.js"></script>		
		<script type="text/javascript" src="js/fb.js"></script>		
		<script type="text/javascript" src="js/lazyload.min.js"></script>		
		<script type="text/javascript" src="js/validate.js"></script>		
		<script type="text/javascript" src="js/gallery.js"></script>	
		
	</head>	
<body>
	<div id="container" class="gallery">
		<div id="overlay">			
		</div>
		<div id="overlay-cont">
			<img class="img-first" src=''/>
			<img class="img-second" src=''/>
			<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
			<div id="like" data-id="1234" >Like</div>
		</div>
		<div id="controls">
			<div id="sort-by">
				<a href="#" onclick="loadGallery(0)">Po broju lajkova</a>
				|
				<a href="#" onclick="loadGallery(1)">Po imenu (A-Z)</a>
				|
				<a href="#" onclick="loadGallery(2)">Po datumu</a>
			</div>
			<div id="search-div">
				<input type="text" id="search" onkeyup='filters(this.value)' class="search" placeholder="Pretraga..."/>
			</div>			
		</div>
		
		<div id="gallery-cont">
				
					<div class="customBtns">
						<span class="arrowPrev"></span>
						<span class="arrowNext"></span>
					</div>

				
					<ul id="itemContainer">
						<li class="item" data-sort="feature">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
									  
						
						
						
					</ul>
					<div class="holder">
					</div>
			</div>
			<div class="btns signup-g"><a href="#" id="prijava" onclick="verifyContest()">Prijavi se</a></div>
	</div>
	<div id="fb-root"></div>
</body>
</html>