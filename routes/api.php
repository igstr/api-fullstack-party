<?php

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->group(
        [ 'prefix' => 'repo', 'middleware' => 'auth', 'as' => 'repo' ],
        function () use ($router) {
            $router->get('/', 'RepoController@getAction' );
        }
    );

    $router->group(
        [ 'prefix' => 'issues', 'middleware' => 'auth' ],
        function () use ($router) {
            $router->get('/', [ 'as' => 'issues', 'uses' => 'IssuesController@listAction' ] );
            $router->get('/{num}/', [ 'as' => 'issue', 'uses' => 'IssuesController@getAction' ] );

            $router->get('/{num}/comments/', [
                'as' => 'issue_comments',
                'uses' => 'IssueCommentsController@getAction',
            ]);
        }
    );

});