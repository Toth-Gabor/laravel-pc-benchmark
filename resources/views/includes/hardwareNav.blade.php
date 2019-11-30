<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div><h5>Hardwares</h5>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a href="{{--{{{ action('HardwareController@showCPUList') }}}--}}" class="nav-item nav-link">CPU
                    List</a>
                <a href="{{--{{{ action('HardwareController@showGPUList') }}}--}}" class="nav-item nav-link">GPU
                    List</a>
                <a href="{{--{{{ action('HardwareController@showRAMList') }}}--}}" class="nav-item nav-link">RAM
                    List</a>
                <a href="{{--{{{ action('HardwareController@showSSDList') }}}--}}" class="nav-item nav-link">SSD
                    List</a>
                <a href="{{--{{{ action('HardwareController@showHDDList') }}}--}}" class="nav-item nav-link">HDD
                    List</a>
            </div>
        </div>
    </div>
</nav>
