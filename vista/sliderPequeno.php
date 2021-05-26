<!-- start-brand-carsuals-->
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
<div class="brand-carsuals">
	<ul id="flexiselDemo3">
	    <li><img src="images/b-logo.png" /></li>
	    <li><img src="images/b-logo.png" /></li>
	    <li><img src="images/b-logo.png" /></li>
	    <li><img src="images/b-logo.png" /></li>                                                 
	</ul>   
	<script type="text/javascript">
		$(window).load(function() {
		    $("#flexiselDemo3").flexisel({
		        visibleItems: 5,
		        animationSpeed: 1000,
		        autoPlay: true,
		        autoPlaySpeed: 3000,            
		        pauseOnHover: true,
		        enableResponsiveBreakpoints: true,
		        responsiveBreakpoints: { 
		            portrait: { 
		                changePoint:480,
		                visibleItems: 1
		            }, 
		            landscape: { 
		                changePoint:640,
		                visibleItems: 2
		            },
		            tablet: { 
		                changePoint:768,
		                visibleItems: 3
		            }
		        }
		    });
		    
		});
	</script>
</div>
<!-- //End-brand-carsuals-->