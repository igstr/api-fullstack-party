<?php

use App\Api\Controllers;

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->group(['prefix' => 'repo'], function () use ($router) {
        $router->get('/', 'RepoController@getAction' );
    });

    $router->group(['prefix' => 'issues'], function () use ($router) {
        $router->get('/', 'IssuesController@listAction' );
        $router->get('/{num}/', 'IssuesController@getAction' );

        $router->get('/{num}/comments/', [
            'as' => 'issue_comments',
            'uses' => 'IssueCommentsController@getAction',
        ]);
    });

});