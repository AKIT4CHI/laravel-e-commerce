@include('home.css')

@include('home.header')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Order Info</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Order Info</span>
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
                                @foreach($order as $order)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="/product/{{$order->image}}" alt="" width="50px" height="50px">
                                        <h5>{{$order->title}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                    {{$order->price}}
                                    </td>
                                    <td class="shoping__cart__price">
                                    {{$order->quantity}}
                                    </td>
                                    <td class="shoping__cart__price">
                                    {{($order->quantity)*($order->price)}}
                                    </td>
                                    
                                    
                                    
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    @include('home.footer')