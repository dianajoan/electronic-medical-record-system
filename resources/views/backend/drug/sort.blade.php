@extends('backend.layouts.master')
@section('title') Sort Members @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Sort members</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('admin')}}">Dashboard</a></li>
                            <li><a href="{{ route('team.index') }}">Team</a></li>
                            <li class="active">Sort members</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body card-block">
                        <form action="{{ route('team.sort') }}" method="get">
                            @csrf
                            <label for="category_id">Select Team Category:</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($teamCategories as $category)
                                    <option value="{{ $category->id }}" {{ $selectedCategory->id == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            <br/>
                            <button type="submit" class="btn btn-dark">Sort</button>
                        </form>

                        <hr>

                        <h4>Sorted Teams by Category: <b>{{ $selectedCategory->title }}</b></h4>
                       

                        
                            {{-- Display team information --}}
                             <ul id="sortable">
                                 @forelse($teams as $team)
                          <li class="ui-state-default" data-team_id="{{ $team->id }}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ $team->name }}</li>
                          @empty
                          <p>No teams found for the selected category.</p>
                          @endforelse
                         
                        </ul>
                            <!--<table id="sortable-table">-->
                            <!--    <thead>-->
                            <!--        <tr>-->
                            <!--            <th>ID</th>-->
                            <!--            <th>Name</th>-->
                            <!--        </tr>-->
                            <!--    </thead>-->
                            <!--    <tbody id="sortable-list">-->
                            <!--        @foreach ($teams as $team)-->
                            <!--            <tr data-id="{{ $team->id }}">-->
                            <!--                <td>{{ $team->id }}</td>-->
                            <!--                <td>{{ $team->name }}</td>-->
                            <!--            </tr>-->
                            <!--        @endforeach-->
                            <!--    </tbody>-->
                            <!--</table>-->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')


<script>


    // $(document).ready(function() {
    //     new Sortable(document.getElementById('sortable-table').getElementsByTagName('tbody')[0], {
    //         onUpdate: function (evt) {
    //             var rows = $('#sortable-table tbody tr');
    //             var teams = [];

    //             rows.each(function(index) {
    //                 teams.push({
    //                     id: $(this).data('id'),
    //                 });
    //             });

    //             $.ajax({
    //                 method: 'PATCH',
    //                 url: '/teams/update-order',
    //                 data: {
    //                     teams: JSON.stringify(teams),
    //                     _token: '{{ csrf_token() }}'
    //                 },
    //                 success: function (response) {
    //                     console.log('Order updated successfully');
    //                 }
    //             });
    //         }
    //     });
    // });
</script>
@endpush
@endsection
