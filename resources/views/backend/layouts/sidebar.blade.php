
@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview {{($prefix=='/users')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Users<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('user.view')}}" class="nav-link {{($route =='user.view')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View User</p>
                </a>
              </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/profiles')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Profile<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('profiles.view')}}" class="nav-link {{($route =='profiles.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profiles.password.view')}}" class="nav-link {{($route =='profiles.password.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Change Password</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/suppliers')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Supplier<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('suppliers.view')}}" class="nav-link {{($route =='suppliers.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Supplier</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/customers')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Customers<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('customers.view')}}" class="nav-link {{($route =='customers.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Customers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('customers.report.view')}}" class="nav-link {{($route =='customers.report.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Cradit Customers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('customers.paid.view')}}" class="nav-link {{($route =='customers.paid.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Paid Customers</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('customers.wise.report')}}" class="nav-link {{($route=='customers.wise.report')?'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customer Wise Report</p>
                  </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/units')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Units<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('units.view')}}" class="nav-link {{($route =='units.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Units</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/categorys')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Category<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('categorys.view')}}" class="nav-link {{($route =='categorys.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Categorys</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/products')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Products<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('products.view')}}" class="nav-link {{($route =='products.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Products</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/purchases')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Purchase<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('purchases.view')}}" class="nav-link {{($route =='purchases.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Purchases</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('purchases.pending.view')}}" class="nav-link {{($route =='purchases.pending.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Approved Purchases</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/invoices')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Invoice<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('invoices.view')}}" class="nav-link {{($route =='invoices.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('invoices.pending.view')}}" class="nav-link {{($route =='invoices.pending.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Approved Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('invoices.print.list')}}" class="nav-link {{($route =='invoices.print.list')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Invoice Print List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('invoices.dely.report')}}" class="nav-link {{($route =='invoices.dely.report')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Invoice Dely Report</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{($prefix=='/stocks')?'menu-open':''}}">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>Manage Stock<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('stocks.view')}}" class="nav-link {{($route =='stocks.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Stock</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('stock.supplier.view')}}" class="nav-link {{($route =='stock.supplier.view')?'active':''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Supplier Stock</p>
                    </a>
                </li>
            </ul>
        </li>
        
    </ul>
</nav>