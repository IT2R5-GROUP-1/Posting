<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// Base route
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// POST ROUTES
$router->post('/posts', 'PostController@create');           // Create a post
$router->get('/posts/search', 'PostController@search');     // Search posts
$router->get('/posts', 'PostController@getAll');
$router->delete('/posts/{id}', 'PostController@delete');


// COMMENT ROUTES (handled by CommentController)
$router->post('/posts/{postId}/comments', 'CommentController@comment');        // Add a comment to a post
$router->post('/comments/{commentId}/replies', 'CommentController@reply');     // Reply to a comment
$router->get('/post/{id}', 'PostController@getById');
