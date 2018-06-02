@section('slide-show')
    <div class="tradivas-display">
        <div id="tradivas-display" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#tradivas-display" data-slide-to="0" class="active"></li>
                <li data-target="#tradivas-display" data-slide-to="1"></li>
                <li data-target="#tradivas-display" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="/target">
                        <img class="d-block img-fluid w-100" src="{{ asset('img/stock-1.jpg') }}" alt="First slide">
                    </a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="/target">
                        <img class="d-block img-fluid w-100" src="{{ asset('img/stock-2.jpg') }}" alt="Second slide">
                    </a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <a href="/target">
                        <img class="d-block img-fluid w-100" src="{{ asset('img/stock-3.jpg') }}" alt="Third slide">
                    </a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Title</h5>
                        <p>Description</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#tradivas-display" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#tradivas-display" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@endsection
