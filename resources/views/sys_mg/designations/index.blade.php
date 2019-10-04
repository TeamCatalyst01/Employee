@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-2 center">Designation Management</h4>
    
    {{-- Include the searh component with with title and route --}}
    @component('sys_mg.inc.search',['title' => 'Designation' , 'route' => 'designations.search'])
    @endcomponent
    
    <div class="row">
        <!-- Show All Designation List as a Card -->
        <div class="card col s12 m12 l12 xl12">
            <div class="card-content">
                <div class="row">
                    <h5 class="pl-15 grey-text text-darken-2">Designation List</h5>
                    <!-- Table that shows Designation List -->
                    <table class="responsive-table col s12 m12 l12 xl12">
                        <thead class="grey-text text-darken-2">
                            <tr>
                                <th>ID</th>
                                <th>Designation Name</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Check if there are any designation to render in view -->
                            @if($designations->count())
                                @foreach($designations as $designation)
                                    <tr>
                                        <td>{{$designation->id}}</td>
                                        <td>{{$designation->designation_name}}</td>
                                        <td>{{$designation->created_at}}</td>
                                        <td>{{$designation->updated_at}}</td>
                                        <td>
                                            <div class="row mb-0">
                                              <div class="col">
                                                    <a href="{{route('designations.edit',$designation->id)}}" class="btn btn-floating btn-small waves=effect waves-light orange"><i class="material-icons">mode_edit</i></a>
                                                </div>
                                                <div class="col">
                                                    <form action="{{route('designations.destroy',$designation->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf()
                                                        <button type="submit" class="btn btn-floating btn-small waves=effect waves-light red"><i class="material-icons">delete</i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <!-- if there are no Designations then show this message -->
                                <tr>
                                    <td colspan="5"><h6 class="grey-text text-darken-2 center">No Designations found yet!</h6></td>
                                </tr>
                            @endif
                            @if(isset($search))
                                <tr>
                                    <td colspan="3">
                                        <a href="/designations" class="right">Show All</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <!-- Designations Table END -->
                </div>
                <!-- Show Pagination Links -->
                <div class="center">
                  {{$designations->links('vendor.pagination.default',['paginator' => $designations])}}
                </div>
            </div>
        </div>
        <!-- Card END -->
    </div>
</div>


<!-- This is the button that is located at the right bottom, that navigates us to designations.create view -->
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves=effect waves-light red" href="{{route('designations.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div>
@endsection