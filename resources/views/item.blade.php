@extends('layouts.master')

@section('title', ucwords($item->title))

@section('content')
    <div class="container-fluid tradivas-item-container">
        <div class="row">
            <div class="col-5 tradivas-item-image">
                <div class="tradivas-item-large-image">
                    <img src="{{ $item->image() }}" alt="Item image">
                </div>
                <div class="container-fluid tradivas-item-thumbnail">
                    <div class="row">
                        @foreach($item->images as $image)
                            <div class="col-2">
                                <img src="{{ $image->path() }}" alt="Item thumbnail">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-7 tradivas-item-info">
                <div class="tradivas-item-title">{{ ucwords($item->title) }}</div>
                @if ($item->price != $item->base_price)
                    <div class="tradivas-item-price tradivas-item-price-with-sale">${{ $item->base_price }} CAD</div>
                    <div class="tradivas-item-sale-price">${{ $item->price }} CAD</div>
                    <div class="tradivas-item-discount">{{ -$item->discount() }}%</div>
                @else
                    <div class="tradivas-item-price">${{ $item->price }} CAD</div>
                @endif
                <div class="tradivas-item-sku">
                    <div class="tradivas-item-sku-label">SKU:</div>
                    <div class="tradivas-item-sku-value"></div>
                </div>
                <div class="tradivas-ruler"></div>
                <div class="tradivas-item-size">
                    <div class="tradivas-item-size-label">Size:</div>
                    <div class="tradivas-item-size-value"></div>
                </div>
                <div class="tradivas-ruler"></div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .tradivas-item-container{
            padding: 0;
        }
        .tradivas-item-large-image{
            height: 500px;
            width: 100%;
        }
        .tradivas-item-large-image > img, .tradivas-item-thumbnail img{
            height: 100%;
            width: 100%;
            cursor: crosshair;
        }
        .tradivas-item-thumbnail{
            margin-top: 10px;
            padding: 0;
        }
        .tradivas-item-thumbnail > .row{
            margin-left: 0;
        }
        .tradivas-item-thumbnail .col-2{
            padding: 0 10px 0 0;
            height: 80px;
        }
        .tradivas-item-thumbnail img{
            cursor: pointer;
        }
        .tradivas-item-title{
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .tradivas-item-price{
            padding: 0 0 10px;
            font-weight: bold;
            font-size: 18px;
        }
        .tradivas-item-price.tradivas-item-price-with-sale{
            display: inline-block;
            font-size: 14px;
            text-decoration: line-through;
            font-weight: normal;
        }
        .tradivas-item-sale-price{
            display: inline-block;
            font-weight: bold;
            font-size: 18px;
        }
        .tradivas-item-discount{
            color: #dd2222;
            display: inline-block;
            font-size: 14px;
        }
        .tradivas-item-sku{}
        .tradivas-item-sku-label{
            font-weight: bold;
        }
        .tradivas-item-size{
            margin-top: 40px;
        }
        .tradivas-item-size-label{
            font-weight: bold;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script>
        $(function(){
            $(".tradivas-item-thumbnail img").hover(function(){
                $(".tradivas-item-large-image > img").attr("src", $(this).attr("src"));
                $('.tradivas-item-large-image').trigger('zoom.destroy');
                $(".tradivas-item-large-image").zoom({});
            });
            $(".tradivas-item-large-image").zoom({});
        });
    </script>
@endpush
