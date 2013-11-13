$(document).ready(function(){
			$.expr[":"].contains = $.expr.createPseudo(function(arg) {
				return function( elem ) {
				return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
				};
			});
		
			loadGallery(0);		
		
			$('#overlay').click(function(){
				$('#overlay, #overlay-cont').hide();
			});
			
			$('#like').click(function(){
				var target = $(this).attr('data-id');
			
				console.log(" id: "+target + " "+uid);
				$.post( "scripts/vote.php", { fid: uid, id: target }, function( data ) {
					
					FB.ui(
					   {
						 method: 'feed',
						 name: 'Champion Photo Contest',
						 link: 'http://www.facebook.com/pages/Testgallery-Community/222089757967711?id=222089757967711&sk=app_430747907025436',
						 picture: 'http://nekretnineapartman.rs/fbz/img/pre_posle.jpg',
						 caption: 'Photo contest',
						 description: 'Blablabla tralalalabla bla',
						 message: 'Objavite na wall-u'
					   },
					   function(response) {
						 if (response && response.post_id) {
						   alert('Post was published.');
						 } else {
						   alert('Post was not published.');
						 }
					   }
					 );
    
				
				
					console.log(data);
					window.location.href = 'thank_you.php';
				});
			});			
		});		
		
		function initializeGallery() {
			  $("ul li img").lazyload({
				event : "turnPage",
				effect : "fadeIn"
			});
		
			$("div.holder").jPages({
				containerID : "itemContainer",
				perPage     : 9,
				first       : false,
				previous    : "span.arrowPrev",
				next        : "span.arrowNext",
				last        : false,
				callback    : function( pages, items ){
					items.showing.find("img").trigger("turnPage");
					items.oncoming.find("img").trigger("turnPage");
				}
			});
		};
					
		function filters(val) {		
			$("div.holder").jPages( 1 );
			var filter = val;
				if (filter) {
				console.log('trazim jel ima '+filter);
				$('#itemContainer').find(".name:not(:contains(" + filter + "))").parent().parent().addClass('no-filter');
				$('#itemContainer').find(".name:contains(" + filter + ")").parent().parent().addClass('filter');
			} else {
			$('#itemContainer').find("li").removeClass('filter no-filter');
			}
		};

		function showLike(id){
				$('#overlay-cont>#like').removeClass('liked');
				id = $(id);
				var target = $('#overlay-cont');
				var src1 = $(".img-first", id).attr('src');
				var src2 = $(".img-second", id).attr('src');
				var name = $(".name", id).text();
				var likes = $(".likes", id).text();
				var upl_id = $(id).attr('data-id');
				
				$.post( "scripts/voted.php", {fid: uid, id: upl_id }, function( data ) {
				var liked;
					if (data != 0 || data != '0'){
						console.log('tu smo'+data)
						liked = 'liked';
					}	
					else {
						console.log('tamo smo'+data)
						liked = '';
					}
						$('#overlay, #overlay-cont').show();
						$('#overlay-cont .img-first').attr('src', src1);
						$('#overlay-cont .img-second').attr('src', src2);
						$('#overlay-cont .name').text(name);
						$('#overlay-cont .likes').text(likes);
						$('#overlay-cont>#like').attr('data-id', upl_id).addClass(liked);						
								
				});		
				
				
		};
	
		
		function loadGallery(type){
			$.post( "scripts/galerija.php", { order: type }, function( data ) {
				$("#itemContainer").html(data);
				initializeGallery();					
			});				
		}				