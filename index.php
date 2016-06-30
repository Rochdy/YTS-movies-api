<?php 

require 'MovieInterface.php';
require 'Movie.php';

$movie = new Moviesuggest\Movie;
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Suggest A movie</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<style>	
			html { 
			  background-color: #83D6DE;
			}
			body{
				background-color: rgba(0,0,0,0);
				color: white;
			}
		button{
			height:40px;
			margin:0px auto;
			border:none;
			background-color: #C82647;
			cursor: pointer;
			display: block;
		}
		#movie{
			color:#000;

		}
		.img-thumbnail{
			width:100%;
		}
		.cover { 
			  background: url() no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			  background-color: #83D6DE;
			}
		</style>
	</head>
	<body>
			<div class="modal fade" tabindex="-1" role="dialog" id="movie">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="movie-title"></h4>
			        <h5 class="rate"></h5>
			      </div>
			      <div class="modal-body">
			        <div class="row">
			        	<div class="col-md-4">
			        		<img src="" alt="" class="img-thumbnail">
			        	</div>
			        	<div class="col-md-8">
			        		<p class="movie-desc"></p>
			        	</div>
			        	
			        </div>
			      </div>
			      <div class="modal-footer">
			        <a class="imdb" href=""><button style="color:white;"type="button" class="btn btn-warning" target="_blank">IMDB</button></a>
			        	<a class="download" href=""><button style="color:white;" type="button" class="btn btn-primary" target="_blank">Download it</button></a>
			      </div>
			    </div>
			  </div>
			</div>

		<div class="container-fluid" style="margin-top:250px;">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="load col-md-4 col-md-offset-4" style="display:none; z-index:99999; position:absoulute; ">
						<img class="img-responsive" src="http://www.lostcactus.com/assets/lost-cactus-newsreel/images/reel.gif" alt="">
					</div>
					<form action="" method="post">
						<div class="row">
							<div class="col-md-12">
								<label for="genre" class="">Genre: </label>
								<select name="genre_selectbox" class="form-control">
								  <option class="choise" value="Any">Any</option>
								  <option class="choise" value="Crime">Crime</option>
								  <option class="choise" value="Animation">Animation</option>
								  <option class="choise" value="Comedy">Comedy</option>
								  <option class="choise" value="Family">Family</option>
								  <option class="choise" value="Horror">Horror</option>
								  <option class="choise" value="Musical">Musical</option>
								  <option class="choise" value="Romance">Romance</option>
								  <option class="choise" value="Adventure">Adventure</option>
								  <option class="choise" value="Fantasy">Fantasy</option>
								  <option class="choise" value="Sci-Fi">Sci-Fi</option>
								  <option class="choise" value="History">History</option>
								  <option class="choise" value="Thriller">Thriller</option>
								</select>
							</div>
						</div>
						<div class="row">
								<button style="margin-top:30px;" class="col-md-8 col-md-offset-2 suggest_btn" type="submit">Suggest!</button>
						</div>
					</form>
				</div>	
				<div class="col-md-4 col-md-offset-4 text-center" style="margin-top:50px;">A simple project made with <i class="glyphicon glyphicon-heart" style="color:#D33257;"></i> by Rochdy</div>
			</div>
		</div>
			
			<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<script>
			function getMovie(){
				$.ajax({
	                url: 'get.php',
	                type: 'POST',
	                data: {'genre': $('select[name=genre_selectbox]').val()},
	                dataType: "json",
	                beforeSend: function(){
				     $('.load').show();
				   },
				   complete: function(){
				     $('.load').hide();
				   },
	                success: function(data){
	                	var title = data.title;
	                	var cover = data.large_cover_image;
	                	var bg = data.background_image;
	                	var rating = data.rating;
	                	var description = data.summary;
	                	var imdb = 'http://www.imdb.com/title/'+data.imdb_code;
	                	var download = data.torrents[0].url;
	                	$('.movie-title').html(title);
	                	$('.rate').html(rating);
	                	$('.movie-desc').html(description);
	                	$(".imdb").attr("href", imdb);
	                	$(".download").attr("href", download);
	                	$(".img-thumbnail").attr("src", cover);
	                	$('#movie').modal();
	                }
	            });
			}	
				$('.suggest_btn').click(function(event){
					event.preventDefault();
					$('.movie-title').html('');
                	$('.movie-desc').html('');
                	$(".imdb").attr("href", '');
                	$(".download").attr("href", '');
                	$(".img-thumbnail").attr("src", '');
					getMovie();
				})
			</script>
		</div>
	</body>
	</html>
