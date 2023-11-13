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

// Master > Product Categories
Breadcrumbs::for('product-categories', function ($trail) {
    $trail->parent('master');
    $trail->push("Product Categories", route('product-category.index'));
});

Breadcrumbs::for('add_product_categories', function ($trail) {
    $trail->parent('product-categories');
    $trail->push('Add Product Categories', route('product-category.create'));
});

Breadcrumbs::for('edit_product_categories', function ($trail, $productCategory) {
    $trail->parent('product-categories');
    $trail->push($productCategory->categories, route('product-category.edit', ['product_categories' => $productCategory]));
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

// Membership 
Breadcrumbs::for('membership', function ($trail) {
    $trail->push("Membership", route('membership.index'));
});

Breadcrumbs::for('add_membership', function ($trail) {
    $trail->parent('membership');
    $trail->push('Add Membership', route('membership.create'));
});

Breadcrumbs::for('edit_membership', function ($trail, $membership) {
    $trail->parent('membership');
    $trail->push($membership->code, route('membership.edit', ['membership' => $membership]));
});

// cashflow 
Breadcrumbs::for('cashflow', function ($trail) {
    $trail->push("Cashflow", route('cashflow.index'));
});

Breadcrumbs::for('add_cashflow', function ($trail) {
    $trail->parent('cashflow');
    $trail->push('Add Cashflow', route('cashflow.create'));
});

Breadcrumbs::for('edit_cashflow', function ($trail, $cashflow) {
    $trail->parent('cashflow');
    $trail->push($cashflow->id, route('cashflow.edit', ['cashflow' => $cashflow]));
});

// Master
Breadcrumbs::for('report', function ($trail) {
    $trail->push('Report');
});

// Report Stock
Breadcrumbs::for('report_stock', function ($trail) {
    $trail->push("Report Stock", route('report.stock'));
});

// Report Stock by Invoice
Breadcrumbs::for('report_stock_by_invoice', function ($trail) {
    $trail->push("Report Stock by Invoice", route('report.stockinvoice'));
});

// Report Stock by Product
Breadcrumbs::for('report_stock_by_product', function ($trail) {
    $trail->push("Report Stock by Product", route('report.stockproduct'));
});

// Report Transaction
Breadcrumbs::for('report_transaction', function ($trail) {
    $trail->push("Report Transaction", route('report.transaction'));
});

// Report Transaction by Invoice
Breadcrumbs::for('report_transaction_by_invoice', function ($trail) {
    $trail->push("Report Transaction by Invoice", route('report.transactioninvoice'));
});

// Report Transaction by Product
Breadcrumbs::for('report_transaction_by_product', function ($trail) {
    $trail->push("Report Transaction by Product", route('report.transactionproduct'));
});

// Report Receive
Breadcrumbs::for('report_receive', function ($trail) {
    $trail->push("Report Receive", route('report.receive'));
});

// Report Receive by Receive No
Breadcrumbs::for('report_receive_by_no', function ($trail) {
    $trail->push("Report Receive by No", route('report.receiveno'));
});

// Report Receive by Product
Breadcrumbs::for('report_receive_by_product', function ($trail) {
    $trail->push("Report Receive by Product", route('report.receiveproduct'));
});

// Report Cashflow
Breadcrumbs::for('report_cashflow', function ($trail) {
    $trail->push("Report cashflow", route('report.cashflow'));
});

// Report Cashflow
Breadcrumbs::for('report_bestseller', function ($trail) {
    $trail->push("Report bestseller", route('report.bestseller'));
});

// Closing date
Breadcrumbs::for('closing_date', function ($trail) {
    $trail->push('Closing Date');
});

// Code
Breadcrumbs::for('code', function ($trail) {
    $trail->push("Code", route('code.index'));
});

Breadcrumbs::for('add_code', function ($trail) {
    $trail->parent('code');
    $trail->push('Add code', route('code.create'));
});

Breadcrumbs::for('edit_code', function ($trail, $code) {
    $trail->parent('code');
    $trail->push($code->code, route('code.edit', ['code' => $code]));
});

// Common Code
Breadcrumbs::for('common_code', function ($trail) {
    $trail->push("Common code", route('common-code.index'));
});

Breadcrumbs::for('add_common_code', function ($trail) {
    $trail->parent('common_code');
    $trail->push('Add common code', route('common-code.create'));
});

Breadcrumbs::for('edit_common_code', function ($trail, $commonCode) {
    $trail->parent('common_code');
    $trail->push($commonCode->name, route('common-code.edit', ['common_code' => $commonCode]));
});

// Purchase Order
Breadcrumbs::for('purchase_order', function ($trail) {
    $trail->push("Purchase Order", route('purchase-order.index'));
});

Breadcrumbs::for('add_purchase_order', function ($trail) {
    $trail->parent('purchase_order');
    $trail->push('Add Purchase Order', route('purchase-order.create'));
});

Breadcrumbs::for('edit_purchase_order', function ($trail, $purchaseOrder) {
    $trail->parent('purchase_order');
    $trail->push($purchaseOrder->name, route('purchase-order.edit', ['purchase_order' => $purchaseOrder]));
});

// Receive Material
Breadcrumbs::for('receive_material', function ($trail) {
    $trail->push("Receive Material", route('receive-material.index'));
});

Breadcrumbs::for('add_receive_material', function ($trail) {
    $trail->parent('receive_material');
    $trail->push('Add Receive Material', route('receive-material.create'));
});

Breadcrumbs::for('edit_receive_material', function ($trail, $receiveMaterial) {
    $trail->parent('receive_material');
    $trail->push($receiveMaterial->name, route('receive-material.edit', ['receive_material' => $receiveMaterial]));
});

// Supplier
Breadcrumbs::for('supplier', function ($trail) {
    $trail->push("Supplier", route('supplier.index'));
});

Breadcrumbs::for('add_supplier', function ($trail) {
    $trail->parent('supplier');
    $trail->push('Add Supplier', route('supplier.create'));
});

Breadcrumbs::for('edit_supplier', function ($trail, $supplier) {
    $trail->parent('supplier');
    $trail->push($supplier->name, route('supplier.edit', ['supplier' => $supplier]));
});

