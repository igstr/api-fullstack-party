<?php

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->group(
        [ 'prefix' => 'repo', 'middleware' => 'auth' ],
        function () use ($router) {
            $router->get('/', 'RepoController@getAction' );
        }
    );

    $router->group(
        [ 'prefix' => 'issues', 'middleware' => 'auth' ],
        function () use ($router) {
            $router->get('/', 'IssuesController@listAction' );
            $router->get('/{num}/', 'IssuesController@getAction' );

            $router->get('/{num}/comments/', [
                'as' => 'issue_comments',
                'uses' => 'IssueCommentsController@getAction',
            ]);
        }
    );

});