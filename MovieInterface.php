<?php 

namespace Moviesuggest;

interface MovieInterface{
	public function random();
	public function filter($user_choise);
	public function get();
}





 ?>