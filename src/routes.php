<?php

// Register route converters.
// Each converter needs to check if the $id it received is actually a value,
// as a workaround for https://github.com/silexphp/Silex/pull/768.
$app['controllers']->convert('artist', function ($id) use ($app) {
    if ($id) {
        return $app['repository.artist']->find($id);
    }
});
$app['controllers']->convert('comment', function ($id) use ($app) {
    if ($id) {
        return $app['repository.comment']->find($id);
    }
});
$app['controllers']->convert('user', function ($id) use ($app) {
    if ($id) {
        return $app['repository.user']->find($id);
    }
});

// Register routes.
$app->get('/{pageName}', 'Condominio\Controller\IndexController::indexAction')
        ->value('pageName',false);

$app->get('/morador', 'Condominio\Controller\IndexController::indexAction')
        ->bind('morador');

$app->get('/construtora', 'Condominio\Controller\IndexController::indexAction')
        ->bind('construtora');


$app->get('/me', 'Condominio\Controller\UserController::meAction')
    ->bind('me');
$app->match('/login', 'Condominio\Controller\UserController::loginAction')
    ->bind('login');
$app->get('/logout', 'Condominio\Controller\UserController::logoutAction')
    ->bind('logout');

$app->get('/artists', 'Condominio\Controller\ArtistController::indexAction')
    ->bind('artists');
$app->match('/artist/{artist}', 'Condominio\Controller\ArtistController::viewAction')
    ->bind('artist');
$app->match('/artist/{artist}/like', 'Condominio\Controller\ArtistController::likeAction')
    ->bind('artist_like');
$app->get('/api/artists', 'Condominio\Controller\ApiArtistController::indexAction');
$app->get('/api/artist/{artist}', 'Condominio\Controller\ApiArtistController::viewAction');
$app->post('/api/artist', 'Condominio\Controller\ApiArtistController::addAction');
$app->put('/api/artist/{artist}', 'Condominio\Controller\ApiArtistController::editAction');
$app->delete('/api/artist/{artist}', 'Condominio\Controller\ApiArtistController::deleteAction');

$app->get('/admin', 'Condominio\Controller\AdminController::indexAction')
    ->bind('admin');

$app->get('/admin/artists', 'Condominio\Controller\AdminArtistController::indexAction')
    ->bind('admin_artists');
$app->match('/admin/artists/add', 'Condominio\Controller\AdminArtistController::addAction')
    ->bind('admin_artist_add');
$app->match('/admin/artists/{artist}/edit', 'Condominio\Controller\AdminArtistController::editAction')
    ->bind('admin_artist_edit');
$app->match('/admin/artists/{artist}/delete', 'Condominio\Controller\AdminArtistController::deleteAction')
    ->bind('admin_artist_delete');

$app->get('/admin/users', 'Condominio\Controller\AdminUserController::indexAction')
    ->bind('admin_users');
$app->match('/admin/users/add', 'Condominio\Controller\AdminUserController::addAction')
    ->bind('admin_user_add');
$app->match('/admin/users/{user}/edit', 'Condominio\Controller\AdminUserController::editAction')
    ->bind('admin_user_edit');
$app->match('/admin/users/{user}/delete', 'Condominio\Controller\AdminUserController::deleteAction')
    ->bind('admin_user_delete');

$app->get('/admin/comments', 'Condominio\Controller\AdminCommentController::indexAction')
    ->bind('admin_comments');
$app->match('/admin/comments/{comment}/edit', 'Condominio\Controller\AdminCommentController::editAction')
    ->bind('admin_comment_edit');
$app->match('/admin/comments/{comment}/delete', 'Condominio\Controller\AdminCommentController::deleteAction')
    ->bind('admin_comment_delete');
$app->match('/admin/comments/{comment}/approve', 'Condominio\Controller\AdminCommentController::approveAction')
    ->bind('admin_comment_approve');
$app->match('/admin/comments/{comment}/unapprove', 'Condominio\Controller\AdminCommentController::unapproveAction')
    ->bind('admin_comment_unapprove');
