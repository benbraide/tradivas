<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <h2 class="tradivas-footer-head">Help</h2>
            <ul>
                <li><a href="/size-chart">Size Chart</a></li>
                <li><a href="/model-size">Model Size</a></li>
            </ul>
        </div>
        <div class="col-3">
            <h2 class="tradivas-footer-head">Customer Care</h2>
            <ul>
                <li><a href="/faqs">FAQs</a></li>
                <li><a href="/policies">Policies</a></li>
                <li><a href="/returns">Return Policy</a></li>
                <li><a href="/shippings">Shipping Policy</a></li>
            </ul>
        </div>
        <div class="col-3">
            <h2 class="tradivas-footer-head">Company</h2>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/contact">Contact Us</a></li>
            </ul>
        </div>
        <div class="col-3">
            <h2 class="tradivas-footer-head newsletter">Sign up to receive our newsletter</h2>
            <form method="POST" action="/newsletter" class="tradivas-footer-head-newsletter-form">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-sm" name="name" placeholder="Name">
                    <input type="email" class="form-control form-control-sm" name="email" placeholder="Email" required>
                    <button type="submit" class="btn tradivas-btn">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>