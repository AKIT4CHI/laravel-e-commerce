@include('home.css')

@include('home.header')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalPrice=0; ?>
                                @foreach($cart as $cart)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="product/{{$cart->image}}" alt="" width="50px" height="50px">
                                        <h5>{{$cart->product_title}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{$cart->price}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$cart->quantity}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?php $priceProduct = $cart->price * $cart->quantity; ?>
                                        {{$priceProduct}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{url('remove_cart',$cart->id)}}"><span class="icon_close"></span></a>
                                    </td>
                                    
                                </tr>
                               <?php $totalPrice += $priceProduct; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/redirect" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Update Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>{{$totalPrice}} DH</span></li>
                            <li>Total <span>{{$totalPrice}} DH</span></li>
                        </ul>
                        <a href="{{url('/checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    @include('home.footer')