<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// Dashboard > Edit Profile
Breadcrumbs::for('edit_profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('profile.edit'));
});

// Dashboard > Edit Password
Breadcrumbs::for('edit_password', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Password', route('password.edit'));
});

// User Management
Breadcrumbs::for('user_management', function ($trail) {
    $trail->push('User Management');
});

//User Management > Roles 
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('user_management');
    $trail->push("Roles", route('roles.index'));
});

Breadcrumbs::for('add_role', function ($trail) {
    $trail->parent('roles');
    $trail->push('Create Role', route('roles.create'));
});

Breadcrumbs::for('edit_role', function ($trail, $role) {
    $trail->parent('roles');
    $trail->push($role->name, route('roles.edit', ['role' => $role]));
});

//User Management > Users 
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('user_management');
    $trail->push("User", route('users.index'));
});

Breadcrumbs::for('add_user', function ($trail) {
    $trail->parent('users');
    $trail->push('Add User', route('users.create'));
});

Breadcrumbs::for('edit_user', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->name, route('users.edit', ['user' => $user]));
});

// --------------------------------------------------------------------- //

// Master
Breadcrumbs::for('master', function ($trail) {
    $trail->push('Master');
});

//Master > Single Upload 
Breadcrumbs::for('single_upload', function ($trail) {
    $trail->parent('master');
    $trail->push("Single Upload", route('single_upload.index'));
});

Breadcrumbs::for('add_single_upload', function ($trail) {
    $trail->parent('single_upload');
    $trail->push('Add Single Upload', route('single_upload.create'));
});

Breadcrumbs::for('edit_single_upload', function ($trail, $single_upload) {
    $trail->parent('single_upload');
    $trail->push($single_upload->title, route('single_upload.edit', ['single_upload' => $single_upload]));
});

//Master > Meta
Breadcrumbs::for('meta', function ($trail) {
    $trail->parent('master');
    $trail->push("Meta", route('metas.index'));
});

Breadcrumbs::for('add_meta', function ($trail) {
    $trail->parent('meta');
    $trail->push('Add Meta', route('metas.create'));
});

Breadcrumbs::for('edit_meta', function ($trail, $meta) {
    $trail->parent('meta');
    $trail->push($meta->name, route('metas.edit', ['meta' => $meta]));
});

//Master > Portfolio 
Breadcrumbs::for('portfolio', function ($trail) {
    $trail->parent('master');
    $trail->push("Portfolio", route('portfolio.index'));
});

Breadcrumbs::for('add_portfolio', function ($trail) {
    $trail->parent('portfolio');
    $trail->push('Add Portfolio', route('portfolio.create'));
});

Breadcrumbs::for('edit_portfolio', function ($trail, $portfolio) {
    $trail->parent('portfolio');
    $trail->push($portfolio->client_name, route('portfolio.edit', ['portfolio' => $portfolio]));
});

//Dashboard > Project Type
Breadcrumbs::for('project-type', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Project Type", route('project-type.index'));
});

Breadcrumbs::for('add_project_type', function ($trail) {
    $trail->parent('project-type');
    $trail->push('Add project-type', route('project-type.create'));
});

Breadcrumbs::for('detail_project_type', function ($trail, $projectType) {
    $trail->parent('project-type', $projectType);
    $trail->push($projectType->name, route('project-type.show', ['project_type' => $projectType]));
});

//Dashboard > Skill
Breadcrumbs::for('skill', function ($trail) {
    $trail->parent('dashboard');
    $trail->push("Categories", route('skill.index'));
});

Breadcrumbs::for('add_skill', function ($trail) {
    $trail->parent('skill');
    $trail->push('Add Categories', route('skill.create'));
});

Breadcrumbs::for('detail_skill', function ($trail, $skill) {
    $trail->parent('skill', $skill);
    $trail->push($skill->name, route('skill.show', ['skill' => $skill]));
});

// Master > Product 
Breadcrumbs::for('product', function ($trail) {
    $trail->parent('master');
    $trail->push("Product", route('product.index'));
});

Breadcrumbs::for('add_product', function ($trail) {
    $trail->parent('product');
    $trail->push('Add Product', route('product.create'));
});

Breadcrumbs::for('edit_product', function ($trail, $product) {
    $trail->parent('product');
    $trail->push($product->name, route('product.edit', ['product' => $product]));
});
