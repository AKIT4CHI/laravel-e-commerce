@include('home.css')

@include('home.header')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Order History</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Order History</span>
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
                                    <th class="shoping__product">Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($order as $order)
                                <tr>
                                    <td class="shoping__cart__item">
                                        
                                        <h5>{{$order->created_at}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{$order->total}}
                                    </td>
                                    
                                    <td>{{$order->status}}</td>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{url('/order_infoU',$order->id)}}"><span class="icon_info"></span></a>
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