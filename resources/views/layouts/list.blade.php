<?php $count = 0; ?>
@if ($list_size > 0)
    <div class="container-fluid tradivas-list-container">
        @foreach ($list as $item)
            @if (($count++ % $cols) == 0)
                </div>
                <div class="row">
            @endif
            <div class="col">
                <div class="tradivas-list-info">
                    <a href="{{ $item->link }}">
                        @if (isset($item->image))
                            <img src="{{ $item->image }}" alt="List item image" height="300px">
                        @else
                            <img src="{{ $item->image }}" alt="List item image" height="300px">
                        @endif
                        <div>
                            <div class="tradivas-item-title">{{ $item->title }}</div>
                            @if (isset($item->sale_price))
                                <div class="tradivas-item-price tradivas-item-price-with-sale">CAD {{ $item->price }}</div>
                                <div class="tradivas-item-sale-price">CAD {{ $item->salePrice }}</div>
                            @else
                                <div class="tradivas-item-price">CAD {{ $item->price }}</div>
                            @endif
                        </div>
                    </a>
                    <a href="{{ $item->link }}" class="tradivas-btn">Choose Options</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    @push('styles')
        <style>
            .tradivas-list-container .tradivas-list-info a{
                display: block;
            }
            .tradivas-list-container .tradivas-list-info img{
                width: 100%;
            }
            .tradivas-list-container .tradivas-list-info img + div{

            }
            .tradivas-list-container .tradivas-list-info .tradivas-item-title{
                font-size: 12px;
            }
            .tradivas-list-container .tradivas-list-info .tradivas-item-price{
                font-weight: bold;
                font-size: 13px;
            }
            .tradivas-list-container .tradivas-list-info .tradivas-item-price-with-sale{
                text-decoration: line-through;
            }
            .tradivas-list-container .tradivas-list-info .tradivas-item-sale-price{
                color: #dd2222;
                font-weight: bold;
                font-size: 13px;
            }
        </style>
    @endpush
@endif
