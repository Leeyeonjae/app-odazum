<?php
//chdir('..');
include_once './src/Epi.php';
Epi::setPath('base', './src');
Epi::init('api');
include_once './db.php';
EpiDatabase::employ('mysql',$db['db'],$db['host'],$db['user'],$db['pw']);

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
getRoute()->get('/post/(\d+)/product/wish','post_wish_plus',EpiApi::external);
getRoute()->get('/post/(\d+)/product/unwish','post_wish_minus',EpiApi::external);

//글을 누르면 보이는 상품(d는 post number)
getRoute()->get('/post/(\d+)/products','get_product_list',EpiApi::external);

//wishList (조회순, 최신순, wish순 없음, 넣은 순서대로)
getRoute()->get('/wishitems','get_wishitems',EpiApi::external);

//맞춤검색-> 
getRoute()->post('/items/recently/?(\d+)?','search_items_recently_list',EpiApi::external);
getRoute()->post('/items/mostwish/?(\d+)?','search_items_mostwish_list',EpiApi::external);
getRoute()->post('/items/mostview/?(\d+)?','search_items_mostview_list',EpiApi::external);

getRoute()->run();


/*
 * ******************************************************************************************
 * Define functions and classes which are executed by EpiCode based on the $_['routes'] array
 * ******************************************************************************************
 */


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
function get_items_mostwish_list($count){

}
function get_items_mostview_list($count){
	
}

function get_fashionclothes_recently_list($count){
	
}
function get_fashionclothes_mostwish_list($count){
	
}
function get_fashionclothes_mostview_list($count){
	
}

function get_fashiongoods_recently_list($count){
	
}
function get_fashiongoods_mostwish_list($count){

}
function get_fashiongoods_mostview_list($count){

}

function get_beautygoods_recently_list($count){

}
function get_beautygoods_mostwish_list($count){

}
function get_beautygoods_mostview_list($count){

}

function get_foods_recently_list($count){

}
function get_foods_mostwish_list($count){

}
function get_foods_mostview_list($count){

}

function get_fancygoods_recently_list($count){

}
function get_fancygoods_mostwish_list($count){

}
function get_fancygoods_mostview_list($count){

}

function post_wish_plus($post_id){
}
function post_wish_minus($post_id){
}

function get_product_list($post_id){
}

function get_wishitems{
}

function search_items_recently_list($count){
}
function search_items_mostwish_list($count){
}
function search_items_mostview_list($count){
}

?>