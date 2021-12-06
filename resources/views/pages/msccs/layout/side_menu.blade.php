<nav id="sidebar" >
    <div id='main-menu'>
        <div class='logo-section'>
            <a href='/'><img src='/img/logo/logo.png' /></a>
        </div>
        <ul class="list-unstyled components mb-5">
            <li class="{{isNavActive(['index'])?'active':''}}">
                <a href='/'>
                    <i class="menu-icon ti-home">
                        <div>
                            <span> Dashboard</span>
                        </div>
                    </i>
                </a>
            </li>

            <li class="{{isNavActive(['call.*'])?'active':''}}">
                <a href='/call'>
                    <i class="menu-icon ti-headphone-alt">
                        <div>
                            <span>Call Center </span>
                        </div>
                    </i>
                </a>
            </li>

            <li class="{{isNavActive(['customer.*'])?'active':''}}">
                <a href='/customer'>
                    <i class="menu-icon ti-face-smile">
                        <div>
                            <span> Customer</span>
                        </div>
                    </i>
                </a>
            </li>


            <li class="{{isNavActive(['analysis.*'])?'active':''}}">
                <a href='/analysis'>
                    <i class="menu-icon ti-bar-chart">
                        <div>
                            <span> Analaysis </span>
                        </div>
                    </i>
                </a>
            </li>

            <li class="{{isNavActive(['setting.*'])?'active':''}}">
                <a href='/setting'>
                    <i class="menu-icon ti-settings">
                        <div>
                            <span> Setting </span>
                        </div>
                    </i>
                </a>
            </li>
        </ul>
        <div id="sideBottomNav">
            <a href='/logout'>
                <i class='ti ti-control-skip-backward'></i>
            </a>
        </div>
    </div>
</nav>