<header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
		  <? for($i = 0; $i < 3; $i++){ ?>
		   <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0 ? "active" : ""); ?>"></li>		 
		  <?php } ?>
        </ol>	
		
        <div class="carousel-inner" role="listbox">
          
          <? for($i = 0; $i < 3; $i++){ ?>
		  <div class="carousel-item <?php echo ($i == 0 ? "active" : ""); ?>" style="background-image: url('http://image.tmdb.org/t/p/original<?php echo $popular_movies->results[$i]->backdrop_path; ?>')">
            <div class="carousel-caption d-none d-md-block">
              <?= "<h3>".$popular_movies->results[$i]->title."</h3>"; ?>
              <?= "<p>".$popular_movies->results[$i]->overview."</p>"; ?>
			  <?= '<a class="btn btn-primary" movieid="'.$popular_movies->results[$i]->id.'" href="#movieInfoModal" data-toggle="modal" id="movieInfo"> More</a>'; ?>
            </div>
          </div>
		  <?php } ?>		  		  
		  
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</header>

    <!-- Page Content -->
    <section class="py-5" style="min-height:330px;">
      <div class="container">
	    
        <h1>Search movies</h1> 
		<br>
		<form id="searchMovieForm">
			<div class="form-group">
				<div class="input-group">							
					<input type="text" name="searchText" value="" placeholder="Enter keywords..." class="form-control" id="searchText">	<input type="submit" class="btn btn-default" value="Search" id="searchMovies">
				</div>
			</div>
		</form>
		
		<div class="results"></div>
		  
      </div>
    </section>

	<?php $this->load->view('modals/movie_more_info'); ?>