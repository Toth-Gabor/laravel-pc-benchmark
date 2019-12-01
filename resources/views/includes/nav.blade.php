<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a href="{{{ action('ComputerController@index') }}}" class="nav-item nav-link">Computer</a>
            <a href="{{{ action('HardwareController@index') }}}" class="nav-item nav-link">Hardware</a>
            <div id="custom-search-input">
                <div class="input-group">
                    <label for="search"></label>
                    <input id="search" name="search" type="text" class="form-control"
                           placeholder="Search hardware"/>
                </div>
            </div>
        </div>
    </div>
</nav>
<script type="text/javascript">
    let route = "{{ url('autocomplete') }}";
    $('#search').typeahead({
        source:  function (term, process) {
            return $.get(route, { term: term }, function (data) {
                return process(data);
            });
        }
    });

</script>
