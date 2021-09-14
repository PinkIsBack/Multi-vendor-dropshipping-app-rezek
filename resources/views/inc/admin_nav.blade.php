<ul class="metismenu" id="menu">
    <li>
        <a href="{{ route('home') }}">
            <div class="parent-icon icon-color-3"><i class="bx bx-home"></i></div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    @role('Merchant')
    <li>
        <a class="has-arrow" href="javascript:;" aria-expanded="false">
            <div class="parent-icon icon-color-1"><i class="bx bx-package"></i>
            </div>
            <div class="menu-title">Products</div>
        </a>
        <ul class="mm-collapse" style="height: 2px;">
            <li><a href="{{ route('product.all') }}"><i class="bx bx-right-arrow-alt"></i>Search Products</a>
            </li>
            <li><a href="{{ route('import.product.list') }}"><i class="bx bx-right-arrow-alt"></i>Import List</a>
            </li>
            <li><a href="{{ route('my.product.list') }}"><i class="bx bx-right-arrow-alt"></i>My Products</a>
            </li>
        </ul>
    </li>
    <li>
        <a class="has-arrow" href="javascript:;" aria-expanded="false">
            <div class="parent-icon icon-color-4"><i class="bx bx-cart"></i>
            </div>
            <div class="menu-title">Orders</div>
        </a>
        <ul class="mm-collapse" style="height: 2px;">
            <li><a href="{{ route('store.orders') }}"><i class="bx bx-right-arrow-alt"></i>My Orders</a>
            </li>
        </ul>
    </li>
    @endrole
    @role('Admin|Supplier')
    <li>
        <a href="{{ route('product.all') }}">
            <div class="parent-icon icon-color-1"><i class="bx bxs-package"></i></div>
            <div class="menu-title">Products</div>
        </a>
    </li>
    @endrole
    @role('Admin')
    <li>
        <a href="{{ route('users.index') }}">
            <div class="parent-icon icon-color-8"><i class="bx bx-user-voice"></i></div>
            <div class="menu-title">Users</div>
        </a>
    </li>
    <li>
        <a href="{{ route('merchant.all') }}">
            <div class="parent-icon icon-color-6"><i class="bx bxl-shopify"></i></div>
            <div class="menu-title">Merchants</div>
        </a>
    </li>
    <li>
        <a href="{{ route('supplier.all') }}">
            <div class="parent-icon icon-color-9"><i class="bx bx-store"></i></div>
            <div class="menu-title">Suppliers</div>
        </a>
    </li>
    <li>
        <a href="{{ route('category.all') }}">
            <div class="parent-icon icon-color-2"><i class="bx bxs-category-alt"></i></div>
            <div class="menu-title">Categories</div>
        </a>
    </li>
    <li>
        <a class="has-arrow" href="javascript:;" aria-expanded="false">
            <div class="parent-icon icon-color-11"><i class="bx bx-shopping-bag"></i>
            </div>
            <div class="menu-title">Shipping</div>
        </a>
        <ul class="mm-collapse" style="height: 2px;">
            <li><a href="{{ route('shipping.areas') }}"><i class="bx bx-right-arrow-alt"></i>Areas</a></li>
            <li><a href="{{ route('shipping.routes') }}"><i class="bx bx-right-arrow-alt"></i>Route & Pricing</a></li>
        </ul>
    </li>
    <li>
        <a class="has-arrow" href="javascript:;" aria-expanded="false">
            <div class="parent-icon icon-color-7"><i class="bx bx-lock"></i>
            </div>
            <div class="menu-title">Settings</div>
        </a>
        <ul class="mm-collapse" style="height: 2px;">
            <li><a href="{{ route('roles.index') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a></li>
            <li><a href="{{ route('productstatus.all') }}"><i class="bx bx-right-arrow-alt"></i>Product Status</a></li>
            <li><a href="{{ route('setting') }}"><i class="bx bx-right-arrow-alt"></i>Currency & Margin</a></li>
        </ul>
    </li>
    @endrole
</ul>
