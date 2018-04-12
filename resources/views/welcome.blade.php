@include('layouts.carousel')

@extends('layouts.master')

@section('title', "Home")

@section('content')
    <div class="container-fluid tradivas-home-content">
        <div class="row no-gutters">
            <div class="col tradivas-home-card">
                <a href="/new-arrivals">
                    <img src="{{ asset('img/stock-1.jpg') }}" alt="New Arrivals">
                </a>
            </div>
            <div class="col tradivas-home-card">
                <a href="/jump-suits">
                    <img src="{{ asset('img/stock-1.jpg') }}" alt="Jump Suits">
                </a>
            </div>
            <div class="col tradivas-home-card">
                <a href="/dresses">
                    <img src="{{ asset('img/stock-1.jpg') }}" alt="Dresses">
                </a>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col tradivas-home-full-card">
                <a href="/jump-suits">
                    <img src="{{ asset('img/stock-2.jpg') }}" alt="Jump Suits">
                </a>
            </div>
        </div>
    </div>
@endsection
