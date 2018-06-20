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

@section("page-sort")
    <?php $sorts = App\Sort::all(); ?>
    <div class="float-left tradivas-page-sort">
        <div class="tradivas-page-sort-label">Sort by:</div>
        <form action="{{ Request::url() }}" method="GET">
            <select name="sort" onchange="this.form.submit()">
                @foreach($sorts as $sort)
                    @if($sort->label == Request::input("sort", "newest"))
                        <option value="{{ $sort->label }}" selected>{{ $sort->name }}</option>
                    @else
                        <option value="{{ $sort->label }}">{{ $sort->name }}</option>
                    @endif
                @endforeach
            </select>
            <input type="hidden" name="page" value="{{ $items->currentPage() }}">
        </form>
    </div>
@endsection

@section('content')
    @if ($items->isNotEmpty())
        @yield("page-sort")
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
                                @if ($item->price != $item->base_price)
                                    <div class="tradivas-item-price tradivas-item-price-with-sale">${{ $item->base_price }} CAD</div>
                                    <div class="tradivas-item-sale-price">${{ $item->price }} CAD</div>
                                    <div class="tradivas-item-discount">{{ -$item->discount() }}%</div>
                                @else
                                    <div class="tradivas-item-price">${{ $item->price }} CAD</div>
                                @endif
                            </div>
                        </a>
                        <a href="{{ $item->link() }}" class="btn tradivas-btn">Choose Options</a>
                        @admin
                            <a href="{{ $item->link() }}/edit" class="btn tradivas-btn" title="Edit item">
                                <span class="oi oi-pencil" aria-hidden="true"></span>
                            </a>
                            <a href="{{ $item->link() }}/delete" class="btn tradivas-btn" title="Delete Item">
                                <span class="oi oi-x" aria-hidden="true"></span>
                            </a>
                        @endadmin
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
        .tradivas-items-container{
            padding: 0;
        }
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
            height: 100%;
        }
        .tradivas-item-title{
            margin-top: 10px;
            font-size: 15px;
        }
        .tradivas-item-price{
            padding: 0 0 10px;
            font-weight: bold;
        }
        .tradivas-item-price.tradivas-item-price-with-sale{
            display: inline-block;
            font-size: 12px;
            text-decoration: line-through;
            font-weight: normal;
        }
        .tradivas-item-sale-price{
            display: inline-block;
            font-weight: bold;
        }
        .tradivas-item-discount{
            color: #dd2222;
            display: inline-block;
            font-size: 12px;
        }
        .tradivas-page-links{
            margin-top: 20px;
        }
        .tradivas-page-sort + .tradivas-page-links{
            margin-top: 2px;
        }
        .tradivas-page-sort{
            margin-bottom: 20px;
        }
        .tradivas-page-sort-label{
            display: inline-block;
            font-weight: bold;
        }
        .tradivas-page-sort-label + form{
            display: inline-block;
            margin: 11px 0 0 5px;
        }
        .page-item.active .page-link{
            background-color: var(--tradivas-btn-bg-color);
            color: var(--tradivas-btn-color);
            border-color: var(--tradivas-btn-bg-color);
        }
        .page-item.active .page-link:hover{
            cursor: default;
        }
        @admin
            .tradivas-item-info .oi{
                font-size: 13px;
            }
            a.btn.tradivas-btn{
                display: inline-block;
            }
        @endadmin
    </style>
@endpush
