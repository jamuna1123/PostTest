
<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});


// Home > Post (Post index)
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('User', route('users.index'));
});
// Home > Users > Create (Create user)
Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Create User', route('users.create'));
});

// Home > Users > [User Name] > Edit (Edit user)
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.show', $user);
    $trail->push('Edit User', route('users.edit', $user->id));
});

// Home > Post (Post index)
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.index');
   $trail->push($user->name, route('users.show', $user->id));
});

// Home > Post Category(Post Category index)
Breadcrumbs::for('post-category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Post Category', route('post-category.index'));
});

// Home > Post Category > Create (Create Post Category)
Breadcrumbs::for('post-category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('post-category.index');
    $trail->push('Create Post Category', route('post-category.create'));
});

// Home > Post Category > [Category Title] > Edit (Edit Post Category)
Breadcrumbs::for('post-category.edit', function (BreadcrumbTrail $trail, $postcategory) {
    $trail->parent('post-category.show', $postcategory);
    $trail->push('Edit Post Category', route('post-category.edit', $postcategory->id));
});
// Home > Post > [Post Title] (Single Post)
Breadcrumbs::for('post-category.show', function (BreadcrumbTrail $trail, $postCategory) {
    $trail->parent('post-category.index');
    $trail->push($postCategory->title, route('post-category.show', $postCategory));
});
// Home > Post (Post index)
Breadcrumbs::for('post.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Post', route('post.index'));
});
// Home > Post > Create (Create Post)
Breadcrumbs::for('post.create', function (BreadcrumbTrail $trail) {
    $trail->parent('post.index');
    $trail->push('Create Post', route('post.create'));
});

// Home > Post > [Post Title] > Edit (Edit Post)
Breadcrumbs::for('post.edit', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('post.show', $post);
    $trail->push('Edit Post', route('post.edit', $post));
});
// Home > Post > [Post Title] (Single Post)
Breadcrumbs::for('post.show', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('post.index');
    $trail->push($post->title, route('post.show', $post));
});


