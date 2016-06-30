<?php 

namespace Moviesuggest;

class Movie implements MovieInterface{

	public $apiUrl = 'https://yts.ag/api/v2/';
	public $limit;
	public $page;
	public $genre;
	public $moviesList;
	public $finalUrl;

	public function random(){
		$this->limit = rand(1,25);
		$this->page = rand(1,10);
	}

	public function filter($user_choise){
		global $moviesList, $apiUrl;
		$genre = ['Crime', 'Animation', 'Comedy', 'Family','Horror','Musical','Romance','Sport','War', 'Adventure', 'Biography', 'Drama', 'Fantasy','History','Sci-Fi','Mystery', 'Thriller'];
		$this->genre = $user_choise == "Any" ? $genre[rand(0,16)] : $user_choise;
		$sort_by = ['title', 'year', 'rating', 'peers', 'seeds', 'download_count', 'like_count', 'date_added'];
		$this->moviesList = 'list_movies.json?minimum_rating=6&sort_by='.$sort_by[rand(0,7)].'&genre='. $this->genre .'&limit=' . $this->limit . '&page='.$this->page;
		$this->finalUrl = $this->apiUrl . $this->moviesList;
		//var_dump($this->finalUrl);
	}

	public function get(){
		
		$url = $this->finalUrl;
		$str = file_get_contents($url);
		$json = json_decode($str, true);
		$rand = rand(1, ($this->limit-1));
		return $selected = $json['data']['movies'][$rand];
		//return $selected = $json['data'];

		//return $json['data']['movies'][$selected];
		//return json_encode($selected);
	}


}
 ?>