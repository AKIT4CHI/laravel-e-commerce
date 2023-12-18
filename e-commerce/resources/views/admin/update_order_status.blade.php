<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <base href="/public">
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
                                Update <strong>Order</strong> 
                            </div>
                            <div class="card-body card-block">
                                <form action="{{url('/update_order_confirm',$order->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">User Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="user_name" placeholder="Product title" class="form-control" value="{{$order->name}}"disabled><small class="form-text text-muted"></small></div>
                                    </div>

                                    

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Status</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="status" id="select" class="form-control">
                                                
                                                    <option value="Ordered">Ordered</option>
                                                    <option value="On Delivery">On Delivery</option>
                                                    <option value="Delivered">Delivered</option>
                                                    <option value="Canceled">Canceled</option>
                                                
                                                
                                                
                                            </select>
                                        </div>
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

    @include('admin.script')
</body>
</html>
