<?php
//chdir('..');
include_once './src/Epi.php';
Epi::setPath('base', './src');
Epi::init('api');
Epi::init('route','database');

define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));
EpiDatabase::employ('mysql', DB_NAME, DB_HOST, DB_USER, DB_PASS); 

//전체 가져오기(최신순, wish순, 조회순)
getRoute()->get('/items/recently/?(\d+)?','get_items_recently_list',EpiApi::external);
getRoute()->get('/items/mostwish/?(\d+)?','get_items_mostwish_list',EpiApi::external);
getRoute()->get('/items/mostview/?(\d+)?','get_items_mostview_list',EpiApi::external);

//카테고리-패션의류 가져오기(최신순, wish순, 조회순)
getRoute()->get('/fashionclothes/recently/?(\d+)?','get_fashionclothes_recently_list',EpiApi::external);
getRoute()->get('/fashionclothes/mostwish/?(\d+)?','get_fashionclothes_mostwish_list',EpiApi::external);
getRoute()->get('/fashionclothes/mostview/?(\d+)?','get_fashionclothes_mostview_list',EpiApi::external);

//카테고리-패션잡화 가져오기(최신순, wish순, 조회순)
getRoute()->get('/fashiongoods/recently/?(\d+)?','get_fashiongoods_recently_list',EpiApi::external);
getRoute()->get('/fashiongoods/mostwish/?(\d+)?','get_fashiongoods_mostwish_list',EpiApi::external);
getRoute()->get('/fashiongoods/mostview/?(\d+)?','get_fashiongoods_mostview_list',EpiApi::external);

//카테고리-뷰티 가져오기(최신순, wish순, 조회순)
getRoute()->get('/beautygoods/recently/?(\d+)?','get_beautygoods_recently_list',EpiApi::external);
getRoute()->get('/beautygoods/mostwish/?(\d+)?','get_beautygoods_mostwish_list',EpiApi::external);
getRoute()->get('/beautygoods/mostview/?(\d+)?','get_beautygoods_mostview_list',EpiApi::external);

//카테고리-식품 가져오기(최신순, wish순, 조회순)
getRoute()->get('/foods/recently/?(\d+)?','get_foods_recently_list',EpiApi::external);
getRoute()->get('/foods/mostwish/?(\d+)?','get_foods_mostwish_list',EpiApi::external);
getRoute()->get('/foods/mostview/?(\d+)?','get_foods_mostview_list',EpiApi::external);

//카테고리-식품 가져오기(최신순, wish순, 조회순)
getRoute()->get('/fancygoods/recently/?(\d+)?','get_fancygoods_recently_list',EpiApi::external);
getRoute()->get('/fancygoods/mostwish/?(\d+)?','get_fancygoods_mostwish_list',EpiApi::external);
getRoute()->get('/fancygoods/mostview/?(\d+)?','get_fancygoods_mostview_list',EpiApi::external);

//좋아요 +1, -1 기능
getRoute()->post('/post/product/wish','post_wish_plus',EpiApi::external);
getRoute()->post('/post/product/unwish','post_wish_minus',EpiApi::external);

//글을 누르면 보이는 상품(d는 post number)
getRoute()->post('/post/products','get_product_list',EpiApi::external);

//wishList (조회순, 최신순, wish순 없음, 넣은 순서대로)
getRoute()->post('/wishitems','get_wishitems',EpiApi::external);

//맞춤검색-> 
getRoute()->post('/items/?(\d+)?','search_items',EpiApi::external);
getRoute()->post('/easysearch','easy_search',EpiApi::external);

getRoute()->get('/randomtags/?(\d+)?','random_tags',EpiApi::external);
getRoute()->run();


/*
 * ******************************************************************************************
 * Define functions and classes which are executed by EpiCode based on the $_['routes'] array
 * ******************************************************************************************
 */


//전체(All)
function get_items_recently_list( $count ){

	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT id, title, image, click,wish FROM posts as p order by id desc ';
	if($count > 0){
		$sql .= ' limit ' . $count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
							'click' => $r['click'],
							'wish' => $r['wish'],
					)
			);
		}

	return $items;

}
function get_items_mostwish_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT id, title, image FROM posts as p order by wish desc ';
	if($count > 0){
		$sql .= ' limit ' . $count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],	
					)
			);
		}

	return $items;
}
function get_items_mostview_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT id, title, image FROM posts as p order by click desc ';
	if($count > 0){
		$sql .= ' limit ' . $count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],							
					)
			);
		}

	return $items;
}


//패션의류
function get_fashionclothes_recently_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=1 order by p.id desc ';
	if($count >0){
		$sql .= 'limit ' . $count;
	}
	$rs = getDatabase()->all ($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],							
					)
			);
		}

	return $items;
}
function get_fashionclothes_mostwish_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=1 order by p.wish desc ';
	if($count > 0){
		$sql .= 'limit ' . $count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}
function get_fashionclothes_mostview_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image  FROM posts p, category c WHERE p.category = c.id and c.id=1 order by p.click desc ';
	if($count > 0){
		$sql .= ' limit ' . $count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}

//패션잡화
function get_fashiongoods_recently_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=2 order by p.id desc ';
	if($count > 0 ){
			$sql .= ' limit ' . $count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],							
					)
			);
		}

	return $items;
	
}
function get_fashiongoods_mostwish_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=2 order by p.wish desc ';
	if($count > 0 ) {
		$sql .= 'limit ' .$count;
	}

	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}
function get_fashiongoods_mostview_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=2 order by p.click desc ';
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all( $sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],							
					)
			);
		}

	return $items;
}

//미용
function get_beautygoods_recently_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=3 order by p.id desc ';
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}
function get_beautygoods_mostwish_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=3 order by p.wish desc ';
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all( $sql );
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}
function get_beautygoods_mostview_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=3 order by p.click desc ' ;
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],						
					)
			);
		}

	return $items;
}

//식품
function get_foods_recently_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=4 order by p.id desc ';
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}
function get_foods_mostwish_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=4 order by p.wish desc ';
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],						
					)
			);
		}

	return $items;
}
function get_foods_mostview_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=4 order by p.click desc ';
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}

//팬시문구
function get_fancygoods_recently_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=5 order by p.id desc ' ;
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],										
					)
			);
		}

	return $items;
}
function get_fancygoods_mostwish_list($count){
	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=5 order by p.wish desc ';
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}
function get_fancygoods_mostview_list($count){
//	getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT p.id as id, p.title as title, p.image as image FROM posts p, category c WHERE p.category = c.id and c.id=5 order by p.click desc ';
	if($count > 0) {
		$sql .= 'limit ' .$count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;
}

function post_wish_plus(){
	//getDatabase()->execute('SET NAMES utf8');
	getDatabase()->execute('UPDATE posts SET wish = wish+1 where id = ' .$_POST['post_id'] );

}
function post_wish_minus(){
	//getDatabase()->execute('SET NAMES utf8');
	getDatabase()->execute('UPDATE posts SET wish = wish-1 where id = ' .$_POST['post_id'] );

}

function get_product_list(){
	//getDatabase()->execute('SET NAMES utf8');
	getDatabase()->execute('UPDATE posts SET click = click+1 where id = ' .$_POST['post_id'] );
	$rs = getDatabase()->all('SELECT id, name,image,price,text FROM products WHERE post = '.$_POST['post_id'] );
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'name' => $r['name'],
							'image' => $r['image'],
							'price' => $r['price'],
							'text' => $r['text'],	
					)
			);
		}

	return $items;

}

function get_wishitems(){
	//getDatabase()->execute('SET NAMES utf8');
	
	if(strlen($_POST['wish_id_list'])< 1 ){
		return  array();
	}

	$rs = getDatabase()->all('SELECT p.id as id, p.title as title, p.image as image, p.click as click, p.wish as wish, p.date as wdate FROM posts p WHERE p.id in('.$_POST['wish_id_list'].') ' );

	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
							'click' => $r['click'],
							'wish' => $r['wish'],
							'date' => $r['date'],
					)
			);
		}

		return $items;


}

function search_items(){
	//getDatabase()->execute('SET NAMES utf8');

	/*
	$_POST['age']
	$_POST['gender']
	$_POST['tag']
	$_POST['maxprice']
	$_POST['orderby']
	*/

	if(strlen($_POST['tag']) < 1 ){
		$sql = 'SELECT DISTINCT p.id as id ,p.title as title ,p.image as image FROM posts p, posts_gender g,posts_age a, products pro WHERE p.id = g.p_id and p.id = a.p_id and p.id=pro.post and g.g_id= '.$_POST['gender'].' and a.a_id = ' . $_POST['age'] .' GROUP BY pro.post HAVING min(pro.price)<= '. $_POST['maxprice'] ;

	}else{
		$sql ='SELECT DISTINCT p.id as id ,p.title as title ,p.image as image FROM posts p,posts_tag t, posts_gender g,posts_age a, products pro where p.id = g.p_id and p.id = t.p_id and p.id = a.p_id and p.id=pro.post and  g.g_id= '.$_POST['gender'].' and a.a_id = '. $_POST['age'] .' and t.t_id  in( SELECT no FROM tag WHERE name in("'.$_POST['tag'].'")) GROUP BY p.id  HAVING min(pro.price)<= '. $_POST['maxprice'] ;
	}

	if($_POST['orderby'] == 1){
		$sql .= ' order by p.click desc';
	}else if($_POST['orderby']==2){
		$sql .= ' order by p.id desc';
	}


	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'id' => $r['id'],
							'title' => $r['title'],
							'image' => $r['image'],
					)
			);
		}

	return $items;

}


function random_tags( $count = 6 ){

	//getDatabase()->execute('SET NAMES utf8');
	$sql = 'SELECT no,name FROM tag order by rand() ';
	if($count > 0){
		$sql .= ' limit ' . $count;
	}
	$rs = getDatabase()->all($sql);
	$items = array();
	foreach( $rs as $key => $r ){
			array_push( $items,
					array(
							'no' => $r['no'],
							'name' => $r['name'],						
					)
			);
		}

	return $items;

}

function easy_search(){
//getDatabase()->execute('SET NAMES utf8');
$sql = 'SELECT DISTINCT p.id,p.title,p.image FROM posts p, products pro where p.id=pro.post and (p.title LIKE "%'.$_POST['word'].'%" or pro.text LIKE "%'.$_POST['word'].'%"); ' ;


$rs = getDatabase()->all($sql);
$items = array();
foreach( $rs as $key => $r ){
		array_push( $items,
				array(
						'id' => $r['id'],
						'title' => $r['title'],
						'image' => $r['image'],										
				)
		);
	}

return $items;
}
?>