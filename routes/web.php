<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/movimentos', 'HomeController@movimentos');

Route::get('/consultaestoque', 'HomeController@consultaestoque');

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://siatra.localhost/home',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://siatra.localhost/oauth/authorize?' . $query);
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://siatra.localhost/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '3',
            'client_secret' => 'RjonkAbUx1I3tdI0ULLORAT7TOnLE8GUUR2nluDa',
            'redirect_uri' => 'http://siatra.localhost/home',
            'code' => 'def502003fd4e291409e7f5debf487ad84e28b2be02cece3616dd4e7e437849b99bb21b1994bdea8352539841e1789cab3edb718f0b723e01dee3fda072f23c4c45c798be095f11613d3eca32adcdd1afde66a03ce4b9f5fb2606078dd1fed29f7e09592f3b599e4605d8ef5ac79d4228de996d35e2fad0ccf2316e1772c5e44eccca56330c0f88a73a52dde6a31919e6fa41d5da1525d20412217434952bff360b1aa8685e5b30bbd34ab9249e6983c7bf412500b6e89cc4a266a58572272d1f44302e920927a91c4dad1e28010dbc7554c2062fdbaa40402f8716b84e0f93cf3eac5b9faeca2d887526ce34053ab43db1d53699fc3ea79351d4ac37867fe019bd1daa881e9cd09127dbb8d4f884d995082ebef6f6a9b2a034ca457531a95f4b967ec05135834724a0ba95cd82a3de11c399ee4300702a2d23dd7e834f9efb5da8fb7eb49ae7b3247b213fc06049c8c748da0d71d370cf93960ffd3367d',
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});

Route::get('/geratoken', function () {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://siatra.localhost/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '4',
            'client_secret' => 'aZB8dCT1iBgrQfO3CEoccAazh4Ru4Pc8psfspMQl',
            'username' => 'atxaloisio@hotmail.com',
            'password' => 'mestre',
            'scope' => '',
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});

