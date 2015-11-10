<?php
//chdir('..');
include_once './src/Epi.php';
Epi::setPath('base', './src');
Epi::init('api');

/* 라 우 팅 */
getRoute()->get('/', 'showEndpoints');
getRoute()->get('/version', 'showVersion');
getRoute()->get('/users', 'getUserList',EpiApi::external);

//전체 가져오기(최신순, wish순, 조회순)
getRoute()->get('/items/recently/?(\d+)?','get_items_recently_list',EpiApi::external);
getRoute()->get('/items/mostwish','get_items_mostwish_list',EpiApi::external);
getRoute()->get('/items/mostview','get_items_mostview_list',EpiApi::external);

//카테고리-패션의류 가져오기(최신순, wish순, 조회순)
getRoute()->get('/fashionclothes/recently','get_fashionclothes_recently_list',EpiApi::external);
getRoute()->get('/fashionclothes/mostwish','get_fashionclothes_mostwish_list',EpiApi::external);
getRoute()->get('/fashionclothes/mostview','get_fashionclothes_mostview_list',EpiApi::external);

//카테고리-패션잡화 가져오기(최신순, wish순, 조회순)
getRoute()->get('/fashiongoods/recently','get_fashiongoods_recently_list',EpiApi::external);
getRoute()->get('/fashiongoods/mostwish','get_fashiongoods_mostwish_list',EpiApi::external);
getRoute()->get('/fashiongoods/mostview','get_fashiongoods_mostview_list',EpiApi::external);

//카테고리-뷰티 가져오기(최신순, wish순, 조회순)
getRoute()->get('/beautygoods/recently','get_beautygoods_recently_list',EpiApi::external);
getRoute()->get('/beautygoods/mostwish','get_beautygoods_mostwish_list',EpiApi::external);
getRoute()->get('/beautygoods/mostview','get_beautygoods_mostview_list',EpiApi::external);

//카테고리-식품 가져오기(최신순, wish순, 조회순)
getRoute()->get('/foods/recently','get_foods_recently_list',EpiApi::external);
getRoute()->get('/foods/mostwish','get_foods_mostwish_list',EpiApi::external);
getRoute()->get('/foods/mostview','get_foods_mostview_list',EpiApi::external);

//카테고리-식품 가져오기(최신순, wish순, 조회순)
getRoute()->get('/fancygoods/recently','get_fancygoods_recently_list',EpiApi::external);
getRoute()->get('/fancygoods/mostwish','get_fancygoods_mostwish_list',EpiApi::external);
getRoute()->get('/fancygoods/mostview','get_fancygoods_mostview_list',EpiApi::external);

//좋아요 +1, -1 기능
getRoute()->get('/post/(\d+)/product/wish','post_wish_plus',EpiApi::external);
getRoute()->get('/post/(\d+)/product/unwish','post_wish_minus',EpiApi::external);

//글을 누르면 보이는 상품(d는 post number)
getRoute()->get('/post/(\d+)/products','get_product_list',EpiApi::external);

//wishList (조회순, 최신순, wish순 없음, 넣은 순서대로)
getRoute()->get('/wishitems','get_wishitems',EpiApi::external);

//맞춤검색-> 
getRoute()->post('/items/recently','search_items_recently_list',EpiApi::external);
getRoute()->post('/items/mostwish','search_items_mostwish_list',EpiApi::external);
getRoute()->post('/items/mostview','search_items_mostview_list',EpiApi::external);

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

function getUserList()
{
  return array(
    array('name' => '이연재'),
    array('name' => '허하진'),
    array('name' => '윤서영')
  );
}


function get_items_recently_list( $count = 10 ){
	$items = array();

	for($i = 0; $i < $count; $i ++){
		array_push( $items,
				array(
					'id' => $i,
					'name' => '연미령',
					'tel' => '010-1234-5678',
					'address' => '서울시 관악구 호암로546(신림동)'
				)
		);
	}
	return $items;

}

?>