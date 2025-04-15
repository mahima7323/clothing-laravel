<!-- resources/views/layouts/partials/sidebar.blade.php -->
<div class="sidebar">
    <h3>Filter by Category</h3>
    <ul>
        @foreach($categories as $category)
            <li><a href="{{ route('product.filter', ['category_id' => $category->id]) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>

    <h3>Filter by Subcategory</h3>
    <ul>
        @foreach($subcategories as $subcategory)
            <li><a href="{{ route('product.filter', ['subcategory_id' => $subcategory->id]) }}">{{ $subcategory->name }}</a></li>
        @endforeach
    </ul>

    <!-- Add more filters or options as needed -->
</div>
