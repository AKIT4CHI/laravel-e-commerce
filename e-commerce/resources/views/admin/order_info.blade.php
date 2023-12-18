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
                                <strong class="card-title">Order Info</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th class="avatar">Avatar</th>
                                            
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        
                                        <?php $i=0; ?>
                                        @foreach($order as $order)
                                        <?php $i++; ?>
                                        <tr>
                                            <td class="serial"><?= $i;?></td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle" src="" alt=""></a>
                                                </div>
                                            </td>
                                            
                                            <td><span class="name">{{$order->title}}</span> </td>
                                            
                                            <td><span class="count">{{$order->quantity}}</span></td>
                                            <td><span class="count">{{$order->price}}</span></td>
                                            
                                            
                                            
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
    
    
    @include('admin.script')
</body>
</html>
