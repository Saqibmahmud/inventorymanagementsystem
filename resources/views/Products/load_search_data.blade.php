@if(count($searched_products) > 0)
    <ul class="list-group">
        @foreach ($searched_products as $d)
            <li class="list-group-item product-item" data-id="{{$d->id}}" data-name="{{$d->product_name}}" style="cursor:pointer;">
                {{ $d->product_name }}
            </li>
        @endforeach
    </ul>
@else
    <div class="text-muted">No products found</div>
@endif
