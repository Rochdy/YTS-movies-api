<?php 

require 'MovieInterface.php';
require 'Movie.php';

$movie = new Moviesuggest\Movie;

$movie->random();
$movie->filter($_POST['genre']);

$selected = $movie->get();
while (empty($selected)){
	$movie->random();
	$movie->filter();
	$selected = $movie->get();
}
echo json_encode($selected);

?>