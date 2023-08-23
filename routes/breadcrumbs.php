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

//Master > Transaction 
Breadcrumbs::for('transaction', function ($trail) {
    $trail->parent('master');
    $trail->push("Transaction", route('transaction.index'));
});

Breadcrumbs::for('add_transaction', function ($trail) {
    $trail->parent('transaction');
    $trail->push('Add Transaction', route('transaction.create'));
});

Breadcrumbs::for('edit_transaction', function ($trail, $transaction) {
    $trail->parent('transaction');
    $trail->push($transaction->client_name, route('transaction.edit', ['transaction' => $transaction]));
});

// Penerimaan Barang 
Breadcrumbs::for('receive', function ($trail) {
    $trail->push("Receive", route('receive.index'));
});

Breadcrumbs::for('add_receive', function ($trail) {
    $trail->parent('receive');
    $trail->push('Add Receive', route('receive.create'));
});

Breadcrumbs::for('edit_receive', function ($trail, $receive) {
    $trail->parent('receive');
    $trail->push($receive->code, route('receive.edit', ['receive' => $receive]));
});
