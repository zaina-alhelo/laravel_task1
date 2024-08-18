@extends('admin.layout.master')   
@section('section', 'Product')
@section('header')
<h1>Welcome To Products Page </h1>




<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
        </tr> 
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
@stop