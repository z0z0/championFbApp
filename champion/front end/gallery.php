<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>		
		<script type="text/javascript" src="js/jPages.min.js"></script>		
		<script>
			  $(function() {
				$("div.holder").jPages({
					containerID : "itemContainer",
					perPage     : 9,
					first       : false,
					previous    : "span.arrowPrev",
					next        : "span.arrowNext",
					last        : false
				});
				
				$('.item').click(function(){
					$('#overlay, #overlay-cont').fadeIn(500);
					var target = $('#overlay-cont');
					var src1 = $(".img-first", this).attr('src');
					var src2 = $(".img-second", this).attr('src');
					var name = $(".name", this).text();
					var likes = $(".likes", this).text();
					
					$('#overlay-cont .img-first').attr('src', src1);
					$('#overlay-cont .img-second').attr('src', src2);
					$('#overlay-cont .name').text(name);
					$('#overlay-cont .likes').text(likes);
				});
				
				$('#overlay').click(function(){
					$('#overlay, #overlay-cont').fadeOut(500);
				})
			});
		</script>
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
				<a href="#" id="likes">Po broju lajkova</a>
				|
				<a href="#" id="likes">Po imenu (A-Z)</a>
				|
				<a href="#" id="likes">Po datumu</a>
			</div>
			<div id="search-div">
				<input type="text" id="search" placeholder="Pretraga..."/>
			</div>			
		</div>
		
		<div id="gallery-cont">
				
					<div class="customBtns">
						<span class="arrowPrev"></span>
						<span class="arrowNext"></span>
					</div>

				
					<ul id="itemContainer">
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Lemi Markovic</span><span class="likes">43</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='gallery/t1.jpg' alt='gallery-block'/><img class="img-second" src='gallery/t2.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Milojica</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Bora Dugic</span><span class="likes">9999</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>
						<li class="item">						
								<img class="img-first" src='files/gallery.jpg' alt='gallery-block'/><img class="img-second" src='files/gallery.jpg' alt='gallery-block'/>
								<div class="item-info"><span class="name">Marko Markovic</span><span class="likes">45</span></div>
						
						</li>	
						
						
					</ul>
					<div class="holder">
					</div>
			</div>
	</div>
</body>
</html>