<?php
//chdir('..');
include_once './src/Epi.php';
Epi::setPath('base', './src');
Epi::init('api');

/* 라 우 팅 */
getRoute()->get('/', 'showEndpoints');
getRoute()->get('/version', 'showVersion');


getRoute()->run();


/*
 * ******************************************************************************************
 * Define functions and classes which are executed by EpiCode based on the $_['routes'] array
 * ******************************************************************************************
 */

function showEndpoints() //시작점에 가까움.(c언어에서 main도 end point)
{

	//'$변수' -> '$변수라고 출력됨.
	//"$변수" -> 변수 내용이 출력됨.
	echo '빠라바라밤 API <br>';
	  echo '<ul>
			  <li><a href="/">/</a> -> (home)</li>
			  <li><a href="/version">/version</a> -> (print the version of the api)</li>
			  <li><a href="/users">/users</a> -> (print each user)</li>
			</ul>';
}


function showVersion(){
	echo 3;
}

?>