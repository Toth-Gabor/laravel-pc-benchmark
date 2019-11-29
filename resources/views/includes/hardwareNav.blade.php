<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a href="{{{ action('HardwareController@showCPUAndAvgScoreList') }}}" class="nav-item nav-link">CPU</a>
            <a href="{{{ action('HardwareController@showGPUAndAvgScoreList') }}}" class="nav-item nav-link">GPU</a>
            <a href="{{{ action('HardwareController@showRAMAndAvgScoreList') }}}" class="nav-item nav-link">RAM</a>
            <a href="{{{ action('HardwareController@showSSDAndAvgScoreList') }}}" class="nav-item nav-link">SSD</a>
            <a href="{{{ action('HardwareController@showHDDAndAvgScoreList') }}}" class="nav-item nav-link">HDD</a>
        </div>
    </div>
</nav>
