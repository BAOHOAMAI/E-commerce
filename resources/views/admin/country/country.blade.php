@extends('admin.layouts.index');

@section ('content')
	<div class="page-wrapper" style="margin-left: 0px">
           <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">Action</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $countryData as $value ) 
                                        <tr>
                                            <th scope="row">{{$value -> id}}</th>
                                            <td>{{$value -> name}}</td>
                                            <td><a href="{{route('deletecountry',['id'=>$value->id])}}"><i class="m-r-10 mdi mdi-delete">Delete</i></a> </td>
                                        </tr>                         
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                
             </div>
             <button class="btn btn-success" style="background: white; margin-left: 20px"><a href="{{route('uploadCountry')}}">ADD</a></button>
                           
    </div>

@endsection