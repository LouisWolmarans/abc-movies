<?php $this->load->view('modals/movie_more_info'); ?>
<br><br>
<div class="container">
	<section class="py-5" style="min-height:330px;">    	    
		<div class="result"></div>
	</section>
</div>

<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url(); ?>theme/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>theme/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
	$(document).ready(function(){
		$('.result').html('<i class="fa fa-refresh fa-spin"></i>');
		$.ajax({
			url: " https://api.themoviedb.org/3/movie/"+<?= $movie_id; ?>+"?api_key=531eaffcac14a8c431f91d7a77a345e8" ,
			dataType: "JSON"
		}).done(function(result){
			var text = '<div class="container"><div class="row">';			
				  //if no poster - display some default image instead
				  var poster = "http://image.tmdb.org/t/p/w185"+result["poster_path"];
				  if(result["poster_path"] == null){
					  poster = "https://i0.wp.com/ultravires.ca/wp/wp-content/uploads/2018/03/Then-and-Now_-no-image-found.jpg?w=275";
				  }
				  
				  text += '<div class="card col-md-4" style="text-align:center;">';
					text +=	'<div class="card-body">';
							text += '<h5 class="card-title mb-2" style="font-size:15px;">'+result["title"]+'</h5>';			
							text += '<img src="'+poster+'" /><br><br>';					
							text += '<a class="btn btn-primary" movieid="'+result["id"]+'" href="#movieInfoModal" data-toggle="modal" id="movieInfo"> More</a>';
					text +=	'</div>';						
					text +=	'</div>';				  				
				text += '</div></div>';
				$(".result").html(text);
		});
	});
</script>	