@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __("Car Prices") }}</h1>
            <div class="title-actions">
                <a href="{{route('car.admin.prices.create')}}" class="btn btn-primary">{{__("Add new price")}}</a>
            </div>
        </div>
        @include('admin.message')

        
        <div class="filter-div d-flex justify-content-between ">

             
            <div class="col-left">
                {{--
                @if(!empty($rows))
                    <form method="post" action="{{route('car.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>

                            @if(!empty($recovery))
                                <option value="recovery">{{__(" Recovery ")}}</option>
                                <option value="permanently_delete">{{__("Permanently delete")}}</option>
                            @else
                                <option value="publish">{{__(" Publish ")}}</option>
                                <option value="draft">{{__(" Move to Draft ")}}</option>
                                <option value="pending">{{__("Move to Pending")}}</option>
                                <option value="clone">{{__(" Clone ")}}</option>
                                <option value="delete">{{__(" Delete ")}}</option>
                            @endif
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                    </form>
                @endif
                --}}
            </div>
            

            <div class="col-left dropdown">
                <form method="get" action="{{ !empty($rows) ? route('car.admin.prices') : '' }}" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    @if(!empty($rows) and $car_manage_others)
                        <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}" class="form-control">

                        {{-- 
                        <div class="ml-3 position-relative">
                            <button class="btn btn-secondary dropdown-toggle bc-dropdown-toggle-filter" type="button" id="dropdown_filters">
                                {{ __("Advanced") }}
                            </button>
                            <div class="dropdown-menu px-3 py-3 dropdown-menu-right" aria-labelledby="dropdown_filters">
                                @include("Core::admin.global.advanced-filter")
                            </div>
                        </div>
                        --}}

                    @endif
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search')}}</button>
                </form>
            </div>
        </div>
        


        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="50px"> {{ __('Range #') }}</th>
                            <th width="90px"> {{ __('From (Km)') }}</th>
                            <th width="80px"> {{ __('To (Km)') }}</th>
                            <th width="150px"> {{ __('Oneway trip (Price)') }}</th>
                            <th width="170px"> {{ __('Oneway trip (Discount)') }}</th>
                            <th width="150px"> {{ __('Round trip (Price)') }}</th>
                            <th width="160px"> {{ __('Round trip (Discount)') }}</th>
                            <th width="110px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($rows->total() > 0)
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{$row->ranges ?? ''}}</td>
                                    <td>{{$row->distance_from ?? ''}}</td>
                                    <td>{{$row->distance_to ?? ''}}</td>
                                    <td>{{$row->one_way_trip_price ?? ''}}</td>
                                    <td>{{$row->one_way_trip_discount ?? ''}}</td>
                                    <td>{{$row->round_trip_price ?? ''}}</td>
                                    <td>{{$row->round_trip_discount ?? ''}}</td>
                                    <td>
                                        <a href="{{route('car.admin.prices.edit',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}
                                        </a> 
                                        <br/>
                                        /
                                        <br/>
                                        <a href="{{route('car.admin.prices.remove',['id'=>$row->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{__('Remove')}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">{{__("No car found")}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </form>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
