<section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                        <li class="active" data-filter="*">All</li>
                            @foreach($category as $category)
                            
                                <li data-filter=".{{$category->category_title}}">{{$category->category_title}}</li>
                            
                            
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($product as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{$product->category_title}} ">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="/product/{{$product->image}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{url('productDetails',$product->id)}}"><i class="fa fa-info"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{$product->title}}</a></h6>
                            
                            
                            @if($product->discount!=null)
                            <h5 style="text-decoration: line-through;">{{$product->price}}DH</h5>
                            <h5>{{$product->discount}}DH</h5>
                            @else
                            <h5>{{$product->price}}DH</h5>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>