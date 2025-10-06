<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Code</th>
            <th>Name</th>
            <th>Supplier</th>
            <th>Categories</th>
            <th>Description</th>
            <th>Price Store</th>
            <th>Discount Store</th>
            <th>Price OLShop</th>
            <th>Discount OLShop</th>
            <th>VAT</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $index => $product)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->supplier?->name }}</td>
            <td>{{ $product->categories }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price_store }}</td>
            <td>{{ $product->discount_store }}</td>
            <td>{{ $product->price_olshop }}</td>
            <td>{{ $product->discount_olshop }}</td>
            <td>{{ $product->is_vat ? 'Yes' : 'No' }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->is_active ? 'Active' : 'Non-Active' }}</td>
            <td>{{ $product->creator?->name }}</td>
            <td>{{ $product->updater?->name }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>