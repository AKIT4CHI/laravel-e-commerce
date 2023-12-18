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
                                <strong class="card-title">Users</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th class="avatar">Avatar</th>
                                            
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        
                                        <?php $i=0; ?>
                                        @foreach($user as $user)
                                        <?php $i++; ?>
                                        <tr>
                                            <td class="serial"><?= $i;?></td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle" src="" alt=""></a>
                                                </div>
                                            </td>
                                            
                                            <td><span class="name">{{$user->name}}</span> </td>
                                            <td><span class="product">{{$user->address}}</span> </td>
                                            <td><span class="name">{{$user->phone}}</span></td>
                                            <td><span class="name">{{$user->email}}</span></td>
                                            <td><span class="name">@if($user->usertype==1)
                                                super-admin
                                                @elseif($user->usertype==0)
                                                Client
                                                @else
                                                Admin
                                                @endif
                                            </span></td>
                                            
                                            <td>
                                                
                                                <a href="{{url('update_user',$user->id)}}"><span class="badge badge-complete">Update</span></a>
                                                <a href="{{url('delete_user',$user->id)}}" onClick="return confirm('are you sure to delete this User?')"><span class="badge badge-complete">Delete</span></a>
                                                
                                            </td>
                                        </tr>
                                        @endforeach   
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Users</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th class="avatar">Avatar</th>
                                            
                                            <th>Name</th>
                                            
                                            
                                            <th>Actions</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        
                                        <?php $i=0; ?>
                                        @foreach($logs as $logs)
                                        <?php $i++; ?>
                                        <tr>
                                            <td class="serial"><?= $i;?></td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle" src="" alt=""></a>
                                                </div>
                                            </td>
                                            
                                            <td><span class="name">{{$logs->name}}</span> </td>
                                            
                                            
                                            
                                            
                                            
                                            <td>
                                                
                                            <span class="name">{{$logs->action}}</span>
                                                
                                            </td>
                                            <td>
                                                
                                            <span class="name">{{$logs->created_at}}</span>
                                                
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
    
    
    @include('admin.script')
</body>
</html>
