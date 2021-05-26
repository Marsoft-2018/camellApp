
<div id="port" class="portfolio portfolio-box">
<div class="container">
	<h3>Portfolio<label> </label></h3>

<div id="port" class="container portfolio-main">
	
		<script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
		<script type="text/javascript">
			$(function () {
				var filterList = {
					init: function () {
					
						// MixItUp plugin
						// http://mixitup.io
						$('#portfoliolist').mixitup({
							targetSelector: '.portfolio',
							filterSelector: '.filter',
							effects: ['fade'],
							easing: 'snap',
							// call the hover effect
							onMixEnd: filterList.hoverEffect()
						});				
					
					},
					hoverEffect: function () {
						// Simple parallax effect
						$('#portfoliolist .portfolio').hover(
							function () {
								$(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
								$(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');				
							},
							function () {
								$(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
								$(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');								
							}		
						);				
					
					}
		
				};
				// Run the show!
				filterList.init();
			});	
		</script>
		
		<ul id="filters" class="clearfix">
			<li><span class="filter active" data-filter="app card icon logo web">All</span> /</li>
			<li><span class="filter" data-filter="app">DESIGN</span> /</li>
			<li><span class="filter" data-filter="card">PHOTOGRAPHY</span> /</li>
			<li><span class="filter" data-filter="icon">VIDEO</span> /</li>
			<li><span class="filter" data-filter="app">PRINT</span></li>
		</ul>
		<div id="portfoliolist">
		<div class="portfolio logo1 mix_all" data-cat="logo" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p1.jpg" /><div class="b-wrapper"><h2 class="b-animate b-from-left    b-delay03 "><img src="images/link-ico.png" alt=""/></h2>
			  	</div></a>
            </div>
            <div class="port-info">
            	<h4><a href="#"> Flat Pixel</a></h4>
            	<span>Website</span>
            </div>
		</div>				
		<div class="portfolio app mix_all" data-cat="app" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p2.jpg" /><div class="b-wrapper"><h2 class="b-animate b-from-left    b-delay03 "><img src="images/link-ico.png" alt=""/></h2>
			  	</div></a>
            </div>
             <div class="port-info">
            	<h4><a href="#">radoslav holan</a></h4>
            	<span>Website</span>
            </div>
		</div>		
		<div class="portfolio web mix_all" data-cat="web" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p3.jpg" /><div class="b-wrapper"><h2 class="b-animate b-from-left    b-delay03 "><img src="images/link-ico.png" alt=""/></h2>
			  	</div></a>
            </div>
            <div class="port-info">
            	<h4><a href="#">Apemanboards</a></h4>
            	<span>Website</span>
            </div>
		</div>				
		<div class="portfolio icon mix_all" data-cat="icon" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p4.jpg" />
			     	<div class="b-wrapper">
				     	<h2 class="b-animate b-from-left    b-delay03 ">
				     		<img src="images/link-ico.png" alt=""/>
				     	</h2>
			  		</div>
			  	</a>
            </div>
             <div class="port-info">
            	<h4><a href="#"> Flat Pixel</a></h4>
            	<span>Website</span>
            </div>
		</div>	
		<div class="portfolio app mix_all" data-cat="app" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p5.jpg" /><div class="b-wrapper"><h2 class="b-animate b-from-left    b-delay03 "><img src="images/link-ico.png" alt=""/></h2>
			  	</div></a>
            </div>
             <div class="port-info">
            	<h4><a href="#"> radoslav holan</a></h4>
            	<span>Website</span>
            </div>
		</div>			
		<div class="portfolio card mix_all" data-cat="card" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p6.jpg" /><div class="b-wrapper"><h2 class="b-animate b-from-left    b-delay03 "><img src="images/link-ico.png" alt=""/></h2>
			  	</div></a>
            </div>
             <div class="port-info">
            	<h4><a href="#">Apemanboards</a></h4>
            	<span>Website</span>
            </div>
		</div>	
		<div class="portfolio icon mix_all" data-cat="icon" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p7.jpg" /><div class="b-wrapper"><h2 class="b-animate b-from-left    b-delay03 "><img src="images/link-ico.png" alt=""/></h2>
			  	</div></a>
            </div>
             <div class="port-info">
            	<h4><a href="#"> Flat Pixel</a></h4>
            	<span>Website</span>
            </div>
		</div>	
		<div class="portfolio app mix_all" data-cat="app" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p8.jpg" /><div class="b-wrapper"><h2 class="b-animate b-from-left    b-delay03 "><img src="images/link-ico.png" alt=""/></h2>
			  	</div></a>
            </div>
             <div class="port-info">
            	<h4><a href="#">radoslav holan</a></h4>
            	<span>Website</span>
            </div>
		</div>			
		<div class="portfolio card mix_all" data-cat="card" style="display: inline-block; opacity: 1;">
			<div class="portfolio-wrapper">		
				<a data-toggle="modal" data-target=".bs-example-modal-md" href="#" class="b-link-stripe b-animate-go  thickbox">
			     <img class="p-img" src="images/p2.jpg" /><div class="b-wrapper"><h2 class="b-animate b-from-left    b-delay03 "><img src="images/link-ico.png" alt=""/></h2>
			  	</div></a>
            </div>
             <div class="port-info">
            	<h4><a href="#"> Apemanboards</a></h4>
            	<span>Website</span>
            </div>
		</div>
		<div class="clearfix"> </div>	
		<a class="more-ports text-center" href="#"><span> </span></a>																																				
	</div>
</div>
</div>
<div class="clearfix"> </div>
</div>
         