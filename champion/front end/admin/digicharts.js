(function ( $ ) {
 
    $.fn.digicharts = function( options ) {
 
       // Default options
        var settings = $.extend({
			mode: "",
			value:  "",
			series: [],
			title: "",
			shadow:false,
			color: "",
			textColor: "#ffcc00",
			textSize: 28,
			legendColor: "#666",
			textFill: "#000000",
			seriesColors: "#19b59f, #ccc, #000",
			backgroundColor: "#fff",
			barPadding: 10,
			animation: true		
        }, options );
		
		//Target element id, dimension
		var dataSource = $(this).attr("id");
		var canvasWidth = $(this).width();
		var canvasHeight = $(this).height();
		
		//Canvas variables
		var canvas, ctx, cX, cY, radius;
		
		//Variable ini
		var mode = settings.mode;
		var percentage = settings.value;
		var series = settings.series;
		var title = settings.title;
		var shadow = settings.shadow;
		var textColor = settings.textColor;
		var textSize = settings.textSize;
		var textFill = settings.textFill; //open pie only
		var seriesColors = settings.seriesColors; //funnel only
		var bgColor = settings.backgroundColor;
		var barPadding = settings.barPadding; //open pie only
		var animation = settings.animation;	
		var legendColor = settings.legendColor;  //funnel only
		var color = settings.color; //open pie only
		
		var ie_fallback = false;
		
		var seriesColorsList = seriesColors.split(","); //lista boja
		/****** FUNNEL ******/
		//funnel data
		var seriesArray = {
			titles: [],
			values:[],
			percents:[],
			valuesSum: ""
		}
		var k = 0;
		//uzimam naslove, procente i racunam sumu
		for (var i=0;i<series.length;i++)
		{ 			
			seriesArray.titles.push(series[i][0]);
			seriesArray.percents.push(series[i][2]);
			k += series[i][1];
		}
		//suma
		seriesArray.valuesSum = k;
		//procenat svakog dela na canvasu
		var funnel_pct;
		//maximalni offset 
		var funnel_max = 0;
		
		for (var i=0;i<series.length;i++){ 
			funnel_pct = (series[i][1] * 100)/seriesArray.valuesSum;
				if(funnel_pct > funnel_max){
					funnel_max =funnel_pct;
				}
			seriesArray.values.push(funnel_pct);
		}
				
		
		
		/*****************************************/
		
		
		/**************OPEN PIE******************/
		//interval variable for pie animation
		var animate;
		//min-max circle widths	
		if (barPadding > 13){
			barPadding = 13;
		}	
		else if (barPadding < 9){
			barPadding = 9;
		}

		//steps, temps
		var w = percentage / 100 * 360 * Math.PI / 180;
		var step = w / 60;
		var temp = 0;
		
		var stepText = percentage / 60;
		var tempText = 0;
		
		
	
		
		/*****************************************/
		
		//Init functions
		initCanvas();
		init();
		
		//Canvas funnel
		function initCanvas(){		
			$("#"+dataSource).html("<div class=\"digi-chart\"><canvas id=\"chart-"+dataSource+"\"></canvas></div>");             
				// Try to access the canvas element   
				canvas = $("#chart-"+dataSource).get(0);  
			
				// Get canvas dimensions for later use
				canvas.width = canvasWidth;
				canvas.height = canvasHeight;
			
			if(typeof G_vmlCanvasManager  != 'undefined' ){
				canvas = G_vmlCanvasManager.initElement(canvas);
				animation = false;
				ie_fallback = true;
			}
				
			if (!canvas.getContext){ 
				return; 
			}  
       
			// Try to get a 2D context for the canvas; throw an error if unable to  
			ctx = canvas.getContext('2d');  
			if (!ctx){ 
				return; 
			}  		
		}
		
	function drawFunnel(){		
			cX = 0;
			cY = Math.floor(canvas.height / 2);
	
			if(animation){
				animator_div = "<div class=\"animator\" style='background:"+bgColor+"'></div>";
				$(animator_div).insertBefore( "#chart-"+dataSource);	
				$("#chart-"+dataSource).siblings().animate({left:"100%"}, 2000);
			}			
		
		ctx.fillStyle = bgColor;
		ctx.fillRect(0,0,canvas.width,canvas.height);		
		
		//koliko su udaljeni jedni od drugih
		var funnel_offset = 5;
		//offset u odnosu na visinu canvasa
		var canvas_offset = canvas.height / funnel_max * 0.32;
			//brojaci, helpers
			var start = 0;	
			var pomeraj = 0;
			var i = 0;
			var j = 0;
			var pomeraj_step = (canvas.width / (seriesArray.values.length));
			var sredina_texta_x_pom = pomeraj_step * 0.5;
		//iteracija blok po blok
		for (var i=0;i<seriesArray.values.length;i++){
			ctx.save();
			//boja svakog bloka, iz prosledjene liste boja
			ctx.fillStyle = seriesColorsList[j];			
			j++;
			if(j>=seriesColorsList.length){
				j = 0;
			}
		
			if(i>0){
				start += pomeraj_step;
			}
			
			pomeraj += pomeraj_step;
			
			var bLeft = cY + seriesArray.values[i]*canvas_offset;
		
			var bRight = cY + seriesArray.values[i+1]*canvas_offset;
							
			var tRight = cY - seriesArray.values[i+1]*canvas_offset;
			
			var sredina_texta_x = pomeraj - sredina_texta_x_pom;
				if (isNaN(seriesArray.values[i+1])){
					bRight = cY + seriesArray.values[i] * canvas_offset;
					tRight = cY - seriesArray.values[i] * canvas_offset;
					pomeraj -= funnel_offset;
				}
			
			var tLeft = cY - seriesArray.values[i]*canvas_offset;
			
			
			
			//crtanje
			ctx.beginPath();
			
			ctx.moveTo(start + funnel_offset, bLeft);		
			ctx.lineTo(pomeraj, bRight);
			ctx.lineTo(pomeraj, tRight);
			ctx.lineTo(start + funnel_offset, tLeft);
			
			//shadow samo na blokovima
			if (shadow){
				ctx.shadowColor = '#000';
				ctx.shadowBlur = 1;
				ctx.shadowOffsetX = 1;
				ctx.shadowOffsetY = 2;
			}
			
			ctx.closePath();
			
			ctx.fill();
		
				ctx.shadowBlur = 0;
				ctx.shadowOffsetX = 0;
				ctx.shadowOffsetY = 0;
			
			ctx.font = textSize+'px Arial';
			ctx.textAlign = 'center';
			ctx.fillStyle = textColor;
			
			//labela za procente
			ctx.fillText(seriesArray.percents[i].toFixed(1)+"%", sredina_texta_x, cY * 1.03);
			
			//labela za naslove (legend)
			ctx.fillStyle = legendColor;
			ctx.fillText(seriesArray.titles[i], sredina_texta_x, cY * 1.8);
			ctx.fillText("("+series[i][1]+")", sredina_texta_x, cY * 1.95);
			
			ctx.restore();
		}				
	}
	
	function drawChart(){	
		
		
		cX = Math.floor(canvas.width / 2);
		cY = Math.floor(canvas.height / 2);
		radius = Math.min(cX,cY) * 0.75;
		
		ctx.fillStyle = bgColor;
		
		ctx.fillRect(0,0,canvas.width,canvas.height);
		
		if(animation){
			temp += step;
			tempText += stepText;
				
			if(Math.round(tempText * 1000) / 1000 == Math.round(percentage * 1000) / 1000){
				tempText = percentage - stepText;		
			}
							
			if(Math.round(temp * 1000) / 1000 == Math.round(w * 1000) / 1000){			
				clearInterval(animate);				
			}	
		}
		else{
			temp = w;
			tempText = percentage - stepText;
		}
		// Calculate the size of donut in radians
			var fills = temp + step / 100 * 360 * Math.PI / 180-1.5707	 ;
		// Draw the donut
			if (shadow){
				ctx.shadowColor = '#000';
				ctx.shadowBlur = 4;
				ctx.shadowOffsetX = 1;
				ctx.shadowOffsetY = 2;
			}
			ctx.beginPath();
			ctx.moveTo(cX, cY);
			ctx.arc(cX, cY, radius * barPadding * 0.1, -1.5707, fills, false);
			ctx.closePath();
			ctx.fillStyle = color;
			
			ctx.fill();
			ctx.restore();
			
				ctx.shadowBlur = 0;
				ctx.shadowOffsetX = 0;
				ctx.shadowOffsetY = 0;
				
			
			if(!ie_fallback){
			//fill for text
			ctx.beginPath();
			ctx.moveTo(cX,cY); 
			ctx.fillStyle = textFill;
			ctx.arc(cX, cY, radius*.80, -1.5707, 2 * Math.PI, false);
			ctx.fill(); 
		}
				
		
			// Add text in the middle
			ctx.font = ' '+textSize+'px Arial';
			ctx.textAlign = 'center';
			ctx.fillStyle = textColor;
		
			ctx.fillText((tempText+stepText).toFixed(1)+"%", cX * 1.01, cY * 1.05);
	}
	
	function error(){
		var err = "<h2>Greska!</h2>";
		$(err).insertBefore( "#chart-"+dataSource);
		
	}
	
	function init(){	
		if((!(percentage.length > 0)) && (!(series.length > 0))){
			error();
			return false;
		}
	
		switch(mode){
			case "pie": if(animation){
							animate = setInterval(drawChart, 40);
						}
						else {
						drawChart();
						}
						
						break;
						
			case "funnel": drawFunnel();
						break;
						
			default: error();
						break;
		}
	}
	
		//Title
		if(title.length > 0){
			var title_div = "<div class=\"chart-title\"><h2>"+title+"</h2></div>";
			$(title_div).insertBefore( "#chart-"+dataSource);
		} 
	
	return this;	
}; 
}( jQuery ));