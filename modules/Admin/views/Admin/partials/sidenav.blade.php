<aside class="main-sidebar hidden-print">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>John Doe</p>
                <p class="designation">Frontend Developer</p>
            </div>
        </div>
        <!-- Sidebar Menu-->
        <ul class="sidebar-menu">
            <li class="active"><a href="index.html"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            
            <li class="treeview">
                <a href="#"><i class="fa fa-file-text"></i><span>Posts</span><i class="fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li><a href="{{route('admin.posts.all')}}"><i class="fa fa-circle-o"></i> Ver todos</a></li>
                    <li><a href="{{route('admin.post.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>Usuarios</span><i class="fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li><a href="{{route('admin.users.all')}}"><i class="fa fa-circle-o"></i> Ver todos</a></li>
                    <li><a href="{{route('admin.user.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-folder-open"></i></i><span>Categorias</span><i class="fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li><a href="{{route('admin.categories.all')}}"><i class="fa fa-circle-o"></i> Ver todos</a></li>
                    <li><a href="{{route('admin.category.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                </ul>
            </li>


             <li class="treeview">
                <a href="#"><i class="fa fa-tags"></i><span>Etiquetas</span><i class="fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li><a href="{{route('admin.tags.all')}}"><i class="fa fa-circle-o"></i> Ver todos</a></li>
                    <li><a href="{{route('admin.tag.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                </ul>
            </li>


          {{--   <li class="treeview">
                <a href="#"><i class="fa fa-laptop"></i><span>UI Elements</span><i class="fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li><a href="bootstrap-componants.html"><i class="fa fa-circle-o"></i> Bootstrap Elements</a></li>
                    <li><a href="ui-font-awesome.html"><i class="fa fa-circle-o"></i> Font Icons</a></li>
                    <li><a href="ui-cards.html"><i class="fa fa-circle-o"></i> Cards</a></li>
                    <li><a href="widgets.html"><i class="fa fa-circle-o"></i> Widgets</a></li>
                </ul>
            </li>
            <li><a href="charts.html"><i class="fa fa-pie-chart"></i><span>Charts</span></a></li>
            <li class="treeview"><a href="#"><i class="fa fa-edit"></i><span>Forms</span><i class="fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="form-componants.html"><i class="fa fa-circle-o"></i> Form Componants</a></li>
                <li><a href="form-custom.html"><i class="fa fa-circle-o"></i> Custom Componants</a></li>
                <li><a href="form-samples.html"><i class="fa fa-circle-o"></i> Form Samples</a></li>
                <li><a href="form-notifications.html"><i class="fa fa-circle-o"></i> Form Notifications</a></li>
            </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-th-list"></i><span>Tables</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="table-basic.html"><i class="fa fa-circle-o"></i> Basic Tables</a></li>
                    <li><a href="table-data-table.html"><i class="fa fa-circle-o"></i> Data Tables</a></li>
                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-file-text"></i><span>Pages</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="blank-page.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                    <li><a href="page-login.html"><i class="fa fa-circle-o"></i> Login Page</a></li>
                    <li><a href="page-user.html"><i class="fa fa-circle-o"></i> User Page</a></li>
                    <li><a href="page-lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen Page</a></li>
                    <li><a href="page-error.html"><i class="fa fa-circle-o"></i> Error Page</a></li>
                    <li><a href="page-invoice.html"><i class="fa fa-circle-o"></i> Invoice Page</a></li>
                    <li><a href="page-calendar.html"><i class="fa fa-circle-o"></i> Calendar Page</a></li>
                    <li><a href="page-mailbox.html"><i class="fa fa-circle-o"></i> Mailbox</a></li>
                </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-share"></i><span>MultiLavel Menu</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="blank-page.html"><i class="fa fa-circle-o"></i> Level One</a></li>
                    <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i><span> Level One</span><i class="fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                    <li><a href="blank-page.html"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i><span> Level Two</span></a></li>
                    </ul>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </section>
</aside>