<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

@include('backend.layouts.head')

<body>
    @include('backend.layouts.sidebar')
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        @include('backend.layouts.header')

        @yield('main-content')
        
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{ asset('backend/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <script src="{{ asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/init-scripts/data-table/datatables-init.js') }}"></script>
    <script src="{{ asset('backend/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('backend/assets/js/widgets.js') }}"></script>
    <script src="{{ asset('backend/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('backend/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        (function($) {
            "use strict";
            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
            $( "#sortable" ).sortable({stop:function(i) {
                     var positions = {};
                        $("#sortable li").each(function(index) {
                            var teamId = $(this).data('team_id');
                            positions[teamId] = index + 1;
                        });
                        console.log(positions);
                     $.ajax({
                     type: "GET",
                     url: "/admin/teams/update-order",
                     data:{ positions: positions },
                     beforeSend: function() 
                    			{
                    				
                    			},
                    			success: function(response)
                    			{
                    
                    			}
                     });
                }
                });
        })(jQuery);
    </script>

</body>

</html>
<!-- end document-->
