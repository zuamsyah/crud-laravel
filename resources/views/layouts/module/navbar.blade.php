<li id="navbar-cart" class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle"
       href="#" role="button" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false"
    >
    
    <span class="badge badge-pill badge-dark" style="font-size: 90%">
        <i class="fa fa-shopping-cart"></i> {{ \Cart::getTotalQuantity()}}
    </span>
        
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 450px; padding: 0px; border-color: #9DA0A2">
        <ul id="shopping_cart" class="list-group" style="margin: 20px;">
            @include('partials.cart-drop')
        </ul>

    </div>
</li>