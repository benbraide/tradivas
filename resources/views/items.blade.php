@extends('layouts.master')

<?php $count = 0; ?>

@if ($sub_category)
    @section('title', ucwords($sub_category->name))
@else
    @section('title', ucwords($category->name))
@endif

@section("page-links")
    <div class="float-right tradivas-page-links">
        {{ $items->links() }}
    </div>
    <div class="clearfix"></div>
@endsection

@section('content')
    @if ($items->isNotEmpty())
        @yield("page-links")
        <div class="container-fluid tradivas-items-container">
            <div class="row">
            @foreach ($items as $item)
                @if ((++$count % 5) == 0)
                    </div>
                    <div class="row">
                @endif
                <div class="col-3">
                    <div class="tradivas-item-info">
                        <a href="{{ $item->link() }}">
                            <div class="tradivas-item-image">
                                <img src="{{ $item->image() }}" alt="Item image">
                            </div>
                            <div>
                                <div class="tradivas-item-title">{{ $item->title }}</div>
                                @if ($item->salePrice())
                                    <div class="tradivas-item-price tradivas-item-price-with-sale">${{ $item->price }} CAD</div>
                                    <div class="tradivas-item-sale-price">${{ $item->salePrice() }} CAD</div>
                                @else
                                    <div class="tradivas-item-price">${{ $item->price }} CAD</div>
                                @endif
                            </div>
                        </a>
                        <a href="{{ $item->link() }}" class="btn tradivas-btn">Choose Options</a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        @yield("page-links")
    @else
        <p>
            There are no items in this 
            @if ($sub_category)
                sub-category
            @else
                category
            @endif
        </p>
    @endif
@endsection

@push('styles')
    <style>
        .tradivas-items-container{}
        .tradivas-items-container > .row + .row{
            margin-top: 40px;
        }
        .tradivas-item-info{}
        .tradivas-item-info > a{
            text-decoration: none;
            color: inherit;
        }
        .tradivas-item-image{
            height: 300px;
        }
        .tradivas-item-image > img{
            width: 100%;
            height: auto;
            margin: auto;
        }
        .tradivas-item-title{}
        .tradivas-item-price{
            padding: 0 0 10px;
            font-weight: bold;
        }
        .tradivas-item-price.tradivas-item-price-with-sale{}
        .tradivas-item-sale-price{}
        .tradivas-page-links{
            margin-top: 20px;
        }
        .page-item.active .page-link{
            background-color: var(--tradivas-btn-bg-color);
            color: var(--tradivas-btn-color);
            border-color: var(--tradivas-btn-bg-color);
        }
        .page-item.active .page-link:hover{
            cursor: default;
        }
    </style>
@endpush
