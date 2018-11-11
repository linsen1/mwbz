<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/addarticle','ArticleController@addArticle');
Route::delete('/delarticle/{id}','ArticleController@delArticle');
Route::put('/editearticle/{id}','ArticleController@editearticle');
Route::post('/addarticlecontent/{id}','ArticleController@addarticleContent');
Route::put('/editarticlecontent/{id}/articleid/{articleid}','ArticleController@editarticleContent');
Route::delete('/delarticlecontent/{id}/articleid/{articleid}','ArticleController@delarticleContent');
Route::post('/addtag/{id}/type/{type}','tagController@addTag');
Route::delete('/deltag/{id}/artilceid/{artilceid}/type/{type}','tagController@delTag');
Route::put('/edittag/{id}/aticleid/{articleid}/type/{type}','tagController@updateTag');


Route::post('/addPic','PicController@addPic');
Route::put("editPic/{id}","PicController@editPic");
Route::delete("delPic/{id}","PicController@delPic");

Route::post("addPicArticle/{picid}","PicController@addPicArticle");
Route::put("editPicArticle/id/{id}/picid/{picid}","PicController@editPicArticle");
Route::delete("delpicArticle/id/{id}/picid/{picid}","PicController@delpicArticle");



