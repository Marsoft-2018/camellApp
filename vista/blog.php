<!----start-blog---->
<div id="blog" class="blog">
	<div class="container">
		<h3>Opiniones<label> </label></h3>
		
				<!----start-artical-info---->
				<?php 
					$objVotacion = new Votar();
					$sqlOpinion = $objVotacion->verOpiniones($tUsuario,$usuario,$tipoVoto);
					$numOp = mysql_num_rows($sqlOpinion);
					if($numOp>0){
						while($op = mysql_fetch_array($sqlOpinion)){
							echo '<div class="blog-grids" style="">
									<div class="col-md-11 blog-grid-row frist-row" style="margin:10px;background-color:#fff;color:#000;text-align:left;border:2px solid rgba(56,19,142,0.6);">
							<div class="artical-info">
								<div class="post-head">
									<div class="post-head-left">
										<h4>'.$op[0].'</h4>
									</div>
									<div class="clearfix"> </div>
								</div>
								<p class="post-text">
									'.$op[2].'
								</p>
								<div class="post-bottom">
									<div class="post-bottom-left">
										';
										if($op[1] == "Bueno"){
											echo "<span><i class='fa fa-thumbs-o-up'> </i></span>";
										}elseif($op[1] == "Bueno"){
											echo "<span><i class='fa fa-thumbs-o-up'> </i></span>";
										}else{
											echo "<span><i class='fa fa-thumbs-o-down'> </i></span>";
										}
							echo 		'
									</div>
									<div class="post-bottom-right">
										<p style="font-size:11px;">'.$op[3].'</p>
									</div>
									<div class="clearfix"> </div>
								</div>
							</div></div>
		</div>';
						}			
					}else{
						echo "no hay opiniones para mostrar";
					}
				 ?>				
				<!----//End-artical-info---->
			
	</div>
</div>
<!----//End-blog---->