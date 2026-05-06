<x-app-layout>

<h1>Products</h1>

@foreach($products as $product)
    <div style="margin-bottom:10px;">
        {{ $product->name }} - ₹{{ $product->price }}

        <a href="{{ url('/cart/add/'.$product->id) }}">
            Add to Cart
        </a>
    </div>
@endforeach

</x-app-layout>