<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="/">Fashion</a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li @yield('index') ><a href="/">Trang chủ</a></li>
                        <li  class="has-dropdown">
                            <a  href="/product">Cửa hàng</a>
                            <ul class="dropdown">
                                <li><a href="/product/cart">Giỏ hàng</a></li>
                                <li><a href="/checkout">Thanh toán</a></li>

                            </ul>
                        </li>
                        <li @yield('about')><a href="/about">Giới thiệu</a></li>
                        <li @yield('contact')><a href="/contact">Liên hệ</a></li>
                        <li @yield('cart') ><a href="/product/cart"><i class="icon-shopping-cart"></i> Giỏ hàng [{{ Cart::Content()->count() }}]</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>