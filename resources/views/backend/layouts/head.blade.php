<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <link rel="apple-touch-icon" href="{{ asset('backend//images/apple-icon.png') }}"> --}}
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.css" />-->
    
    <!-- Add this in the head section of your HTML file -->
<style>
    /*#sortable-table {*/
    /*    width: 100%;*/
    /*    border-collapse: collapse;*/
    /*    margin-top: 20px;*/
    /*}*/

    /*#sortable-table th, #sortable-table td {*/
    /*    border: 1px solid #ddd;*/
    /*    padding: 8px;*/
    /*    text-align: left;*/
    /*}*/

    /*#sortable-table th {*/
    /*    background-color: #f2f2f2;*/
    /*}*/

    /*#sortable-table tbody {*/
    /*    cursor: grab;*/
    /*}*/

    /*#sortable-table tbody tr {*/
    /*    cursor: grab;*/
    /*}*/
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
 
  
</style>

</head>