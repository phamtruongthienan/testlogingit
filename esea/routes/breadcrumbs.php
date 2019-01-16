<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home.index'));
});

Breadcrumbs::for('detailschool', function ($trail, $post) {
    $trail->parent('home');
    $trail->push($post->mSchooltranslations[0]->name, route('home.detail.school', [$post->mSchooltranslations[0]->slug, $post->id]));
});

Breadcrumbs::for('page', function ($trail, $post, $route) {
    $trail->parent('home');
    $trail->push($post, route($route));
});


Breadcrumbs::for('promotions', function ($trail) {
    $trail->parent('home');
    $trail->push('Promotions', route('home.promotion'));
});

Breadcrumbs::for('promotiondetail', function ($trail, $post, $route) {
    $trail->parent('promotions');
    $trail->push($post->mSchooleventtranslations[0]->name, route($route, $post->mSchooleventtranslations[0]->slug));
});

Breadcrumbs::for('news', function ($trail) {
    $trail->parent('home');
    $trail->push('News', route('home.news'));
});

Breadcrumbs::for('account', function ($trail) {
    $trail->parent('home');
    $trail->push('Account', route('home.account'));
});


Breadcrumbs::for('schools_detail', function ($trail, $name, $slug) {
    $trail->parent('home');
    $trail->push($name, asset($slug));
});

Breadcrumbs::for('course_detail', function ($trail, $name, $slug, $name1, $slug1) {
    $trail->parent('schools_detail', $name, $slug);
    $trail->push($name1, asset($slug1));
});


