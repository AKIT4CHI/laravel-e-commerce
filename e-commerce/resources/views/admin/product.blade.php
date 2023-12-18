<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    @include('admin.css')
</head>

<body>
    <!-- Left Panel -->
    @include('admin.sidebar')
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        @include('admin.header')
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <div class="animated fadeIn">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>    
                        {{session()->get('message')}}
                    </div>    
                @endif

                <div class="row">
                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Add <strong>Product</strong> 
                            </div>
                            <div class="card-body card-block">
                                <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Title</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="product_name" placeholder="Product title" class="form-control" required><small class="form-text text-muted"></small></div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product price</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="text-input" name="product_price" placeholder="Product price" class="form-control" required><small class="form-text text-muted"></small></div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Discount</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="text-input" name="discount" placeholder="Product price" class="form-control"><small class="form-text text-muted"></small></div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
                                        <div class="col-12 col-md-9"><textarea name="product_description" id="textarea-input" rows="9" placeholder="Product Description..." class="form-control" required></textarea></div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Category</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="category" id="select" class="form-control">
                                                @foreach($category as $category)
                                                    <option value="{{$category->id}}">{{$category->category_title}}</option>
                                                @endforeach
                                                
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Image</label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="file-input" name="image" class="form-control-file"></div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-multiple-input" class=" form-control-label">Multiple File input</label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="file-multiple-input" name="Multipleimage[]" multiple="" class="form-control-file"></div>
                                    </div>
                                    
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                            </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Products</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th class="avatar">Avatar</th>
                                            
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        
                                        <?php $i=0; ?>
                                        @foreach($product as $product)
                                        <?php $i++; ?>
                                        <tr>
                                            <td class="serial"><?= $i;?></td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle" src="/product/{{$product->image}}" alt=""></a>
                                                </div>
                                            </td>
                                            
                                            <td><span class="name">{{$product->title}}</span> </td>
                                            <td><span class="product">{{$product->description}}</span> </td>
                                            <td><span class="count">{{$product->stock}}</span></td>
                                            <td><span class="count">{{$product->price}}</span></td>
                                            <td><span class="count">{{$product->discount}}</span></td>
                                            <td><span class="count">{{$product->category_id}}</span></td>
                                            <td>
                                                <a href="{{url('add_stock',$product->id)}}"><span class="badge badge-complete">Stock</span></a>
                                                <a href="{{url('update_product',$product->id)}}"><span class="badge badge-complete">Update</span></a>
                                                <a href="{{url('delete_product',$product->id)}}" onClick="return confirm('are you sure to delete this product?')"><span class="badge badge-complete">Delete</span></a>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                         
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->
    
    <script>
        $(document).ready(function () {

            $(document).on('click','.editbtn', function () {

                var product_id = $(this).val();
                alert();
        });
    });
</script>
    @include('admin.script')
</body>
</html>
