$(document).ready(function(){
	  $('#watchList').DataTable();
	  $("#searchMovieForm").submit(function(event){
		event.preventDefault();
		$(".results").html('<i style="font-size:35px;margin-left:50%;margin-top:50px;text-align:center;" class="fa fa-spinner fa-spin"></i>');
		$.ajax({
			url:'/index/searchMovies',
			type: 'post',
			data: $("#searchMovieForm").serialize(),
			success:function(result){
											
				var json_obj = JSON.parse(result);
				
				var text = '<div class="container"><div class="row">';
				if(json_obj.results.length <= 0){
					text += 'No results found.';
				}
				var i;
				for (i = 0; i < json_obj.results.length; i++) {
				  //if no poster - display some default image instead
				  var poster = "http://image.tmdb.org/t/p/w185"+json_obj.results[i]["poster_path"];
				  if(json_obj.results[i]["poster_path"] == null){
					  poster = "https://i0.wp.com/ultravires.ca/wp/wp-content/uploads/2018/03/Then-and-Now_-no-image-found.jpg?w=275";
				  }
				  
				  text += '<div class="card col-md-4" style="text-align:center;">';
					text +=	'<div class="card-body">';
							text += '<h5 class="card-title mb-2" style="font-size:15px;">'+json_obj.results[i]["title"]+'</h5>';			
							text += '<img src="'+poster+'" /><br><br>';					
							text += '<a class="btn btn-primary" movieid="'+json_obj.results[i]["id"]+'" href="#movieInfoModal" data-toggle="modal" id="movieInfo"> More</a>';
					text +=	'</div>';						
					text +=	'</div>';				  
				}
				text += '</div></div>';
				$(".results").html(text);
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				$(".results").html('<p style="color:red;">Error: '+errorThrown+"</p>");
			}  
		});
	  });
	  
	  //Registration
	  $("#registrationForm").submit(function(event){
		event.preventDefault();				
		$('#Register').val('...');			
		$.ajax({
			url:'/register/register_user',
			type: 'post',
			data: $("#registrationForm").serialize(),
			success:function(result){
				var json_obj = JSON.parse(result);
				var message = '<div class="alert" style="padding: 20px;background-color: grey;color: white;margin-bottom: 15px;">'+json_obj.Message+'</div>';
				
				$('.registration-result').html(message);
				$('#Register').val('Register');
				$('#user_password').val('');
				$('#full_name').val('');
				$('#user_email').val('');
			}  
		});		
	  });
	  
	  //Login
	  $("#loginForm").submit(function(event){
		event.preventDefault();				
		var movie_redirect = $('#movie_id').val();
		$('#Login').val('...');		
		$.ajax({
			url:'/login/do_login',
			type: 'post',
			data: $("#loginForm").serialize(),
			success:function(result){
				var json_obj = JSON.parse(result);
				if(json_obj.Message == "Error"){
					var message = '<div class="alert" style="padding: 20px;background-color: grey;color: white;margin-bottom: 15px;">Invalid login. Please try again.</div>';				
					$('.login-result').html(message);
					$('#Login').val('Login');
					$('#user_password').val('');
				}else{
					sessionStorage.setItem("logged_in", "true");
					if(movie_redirect == ""){
						window.location.href = "/";
					}else{
						window.location.href = "/movie?movie_id="+movie_redirect;
					}
				}
			}  
		});		
	  });
	  
	  //Logout	  
	  $("#logout").click(function(){	
		$.ajax({
			url:'/login/do_logout',
			type: 'post',			
			success:function(result){
				var json_obj = JSON.parse(result);
				if(json_obj.Message == "Success"){
					sessionStorage.clear();
					window.location.href = "/";
				}
			}  
		});		
	  });
	  
	  $(document).on('show.bs.modal','#movieInfoModal', function (event) {
		    var button = $(event.relatedTarget);
			var movieid = button.attr("movieid");
			
		  if(isUserLoggedIn()){								    
		    $('#movieInfoModal .modal-title').html('<i class="fa fa-refresh fa-spin"></i>');
			$('#movieInfoModal .modal-body').html('<i class="fa fa-refresh fa-spin"></i>');

			$.ajax({
				url: " https://api.themoviedb.org/3/movie/"+movieid+"?api_key=531eaffcac14a8c431f91d7a77a345e8" ,
				dataType: "JSON"
			}).done(function(result){				
				$('#movieInfoModal .modal-title').html(result.title);
				$('#movieInfoModal .modal-body').html(result.overview);
				watchlist_button(movieid);
			});
		  }else{
			  render_login_form(movieid);
		  }
	  });
	  
	  function isUserLoggedIn(){
		var loggedIn = false;		
		if(sessionStorage.getItem("logged_in") == "true"){
			loggedIn = true;
		}else{
			loggedIn = false;
		}					  
		return loggedIn;
	  }
	  
	  function render_login_form(movieid){
		  $('#movieInfoModal .modal-title').html("Login");		  
		  var login_form = '<p>You need to log in for more options. <a href="login?movie_id='+movieid+'">Proceed to login</a></p>';		  
		  $('#movieInfoModal .modal-body').html(login_form);
	  }
	  
	  function watchlist_button(movieid){
		  $.ajax({
			url:'/watchlist/is_on_watchlist',
			type: 'post',
			data: {movieid:movieid},
			success:function(result){				
				var json_obj = JSON.parse(result);
				var btn = "";
				if(json_obj.Message == "true"){
					btn += '<br><br><a class="btn btn-danger" style="color:#fff" id="remove_from_watchlist" movieid="'+movieid+'"> Remove From Watchlist</a>';					
				}else{
					btn += '<br><br><a class="btn btn-primary" style="color:#fff" id="add_to_watchlist" movieid="'+movieid+'"> Add to Watchlist</a>';			
				}
				$('#movieInfoModal .modal-body').append(btn);
			}
		  });
	  }
	  	  
	  $('#movieInfoModal').on('click', '#add_to_watchlist', function(event) {		  
		  var button = $(event.relatedTarget);
		  var movieid = $(this).attr("movieid");
		  $(this).html('<i class="fa fa-refresh fa-spin"></i>');
		  
		  $.ajax({
				url: " https://api.themoviedb.org/3/movie/"+movieid+"?api_key=531eaffcac14a8c431f91d7a77a345e8" ,
				dataType: "JSON"
			}).done(function(result){				
				$('#movieInfoModal .modal-title').html(result.title);
				$('#movieInfoModal .modal-body').html(result.overview);
				
				$.ajax({
					url:'/watchlist/addToWatchList',
					type: 'post',
					data: {movieid:movieid, movie_title:result.title, movie_overview: result.overview, poster_path:result.poster_path},
					success:function(result){				
						$('#movieInfoModal .modal-body').append('<br><br><p class="btn btn-primary" style="color:#fff"> Done!</p>');
					}
				 });				
			});		  		  
	   });
	   
	   $('#movieInfoModal').on('click', '#remove_from_watchlist', function(event) {	  
		  var button = $(event.relatedTarget);
		  var movieid = $(this).attr("movieid");
		  $(this).html('<i class="fa fa-refresh fa-spin"></i>');
					
	      $.ajax({
				url:'/watchlist/deleteFromWatchList',
				type: 'post',
				data: {movieid:movieid},
				success:function(result){
					$("#remove_from_watchlist").hide();
					$('#movieInfoModal .modal-body').append('<p class="btn btn-primary" style="color:#fff"> Done!</p>');
				}
		  });				
				  		  
	   });
	   
	   $('#watchList').on('click', '#remove_from_watchlist', function(event) {	  
		  var button = $(event.relatedTarget);
		  var movieid = $(this).attr("movieid");
		  $(this).html('<i class="fa fa-refresh fa-spin"></i>');
		  var r = confirm("Are you sure?");
		  if (r == true) {
		    $.ajax({
				url:'/watchlist/deleteFromWatchList',
				type: 'post',
				data: {movieid:movieid},
				success:function(result){
					 location.reload();
				}
		    });
		  }	      								  		  
	   });
	  
	});
