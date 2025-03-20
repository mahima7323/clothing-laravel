<!-- resources/views/admin/subcategories/show.blade.php -->
@extends('layouts.admin_header')

@section('content')
    <div class="container">
        <h2>Subcategory Details</h2>
        
        <div class="form-group">
            <label for="name">Name</label>
            <p>{{ $subcategory->name }}</p>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <p>{{ $subcategory->description }}</p>
        </div>

        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-primary">Back to Subcategories</a>
    </div>
@endsection
