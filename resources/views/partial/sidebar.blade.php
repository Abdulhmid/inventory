<?php $segment = GLobalHelp::indexUrl(); ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li class="header">Main Menu</li>

            <li class="{!! $segment == '' ? 'active' : '' !!}">
                <a href="{!! url('/') !!}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{!! $segment == 'selling' ? 'active' : '' !!}">
                <a href="{!! url('/selling') !!}">
                    <i class="fa fa-file-text"></i>
                    <span>Penjualan</span>
                </a>
            </li>
            <li class="{!! $segment == 'buying' ? 'active' : '' !!}">
                <a href="{!! url('/buying') !!}">
                    <i class="fa fa-file-text"></i>
                    <span>Pembelian</span>
                </a>
            </li>
            <li class="{!! $segment == 'return' ? 'active' : '' !!}">
                <a href="{!! url('/return') !!}">
                    <i class="fa fa-file-text"></i>
                    <span>Return</span>
                </a>
            </li>

            <li class="{!! $segment == 'items' ? 'active' : '' !!}">
                <a href="{!! url('/items') !!}">
                    <i class="fa fa-file-text"></i>
                    <span>Barang</span>
                </a>
            </li>

            <li class="treeview {!! $segment == 'reports' ? 'active' : '' !!}" style="display:none">
                <?php $segmentReport = Request::segment(2); ?>
                <a href="#">
                    <i class="fa fa-area-chart"></i>
                    <span>Laporan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <li class="{!! $segment == 'reports' && $segmentReport == ''  ? 'active' : '' !!}">
                        <a href="{!! url('/reports') !!}">
                            <i class="fa fa-bar-chart"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li class="{!! $segmentReport == 'create-income' ? 'active' : '' !!}">
                        <a href="{!! url('/reports/incomes') !!}">
                            <i class="fa fa-bar-chart"></i>
                            <span>Laporan Pendapatan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {!! $segment == 'areas' || $segment == 'locations' || $segment == 'machine' || $segment == 'users' || $segment == 'groups' ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>Pengaturan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! $segment == 'suppliers' ? 'active' : '' !!}">
                        <a href="{!! url('/suppliers') !!}">
                            <i class="fa fa-group"></i>
                            <span>Suppliers</span>
                        </a>
                    </li>
                    <li class="{!! $segment == 'items-category' ? 'active' : '' !!}">
                        <a href="{!! url('/items-category') !!}">
                            <i class="fa fa-group"></i>
                            <span>Kategori Barang</span>
                        </a>
                    </li>
                    <li class="{!! $segment == 'groups' ? 'active' : '' !!}">
                        <a href="{!! url('/groups') !!}">
                            <i class="fa fa-group"></i>
                            <span>Group Pengguna</span>
                        </a>
                    </li>
                    <li class="{!! $segment == 'users' ? 'active' : '' !!}">
                        <a href="{!! url('/users') !!}">
                            <i class="fa fa-user"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
