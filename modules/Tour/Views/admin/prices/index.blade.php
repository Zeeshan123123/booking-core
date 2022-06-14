@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __("All Prices") }}</h1>
            <div class="title-actions">
                <a href="{{route('tour.admin.prices.create')}}" class="btn btn-primary">{{__("Add new prices")}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                {{-- 
                @if(!empty($rows))
                    <form method="post" action="{{route('tour.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
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
                <form method="get" action="{{ !empty($rows) ? route('tour.admin.prices') : route('tour.admin.index')}}" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}" class="form-control">
                    {{-- 
                    @if(!empty($rows) and $tour_manage_others)
                        <div class="ml-3 position-relative">
                            <button class="btn btn-secondary dropdown-toggle bc-dropdown-toggle-filter" type="button" id="dropdown_filters">
                                {{ __("Advanced") }}
                            </button>
                            <div class="dropdown-menu px-3 py-3 dropdown-menu-right" aria-labelledby="dropdown_filters">
                                <div class="mb-3">
                                    <label class="d-block" for="exampleInputEmail1">{{ __("Category") }}</label>
                                    <select name="cate_id" class="form-control">
                                        <option value="">{{ __('-- All Category --')}} </option>
                                        @foreach($tour_categories as $category)
                                            <option value="{{ $category->id }}" @if(Request()->cate_id == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @include("Core::admin.global.advanced-filter")
                            </div>
                        @endif
                    </div>
                    --}}
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
                                <th> {{ __('Range #')}}</th>
                                <th > {{ __('From (Km)')}}</th>
                                <th > {{ __('To (Km)')}}</th>
                                <th > {{ __('Price (1-4)')}}</th>
                                <th > {{ __('Add (1-4)')}}</th>
                                <th > {{ __('Discount (1-4)')}}</th>
                                <th > {{ __('Price (5-6)')}}</th>
                                <th > {{ __('Add (5-6)')}}</th>
                                <th > {{ __('Discount (5-6)')}}</th>
                                <th > {{ __('Price (7-10)')}}</th>
                                <th > {{ __('Add (7-10)')}}</th>
                                <th > {{ __('Discount (7-10)')}}</th>
                                <th > {{ __('Price (11-15)')}}</th>
                                <th > {{ __('Add (11-15)')}}</th>
                                <th > {{ __('Discount (11-15)')}}</th>
                                <th > {{ __('Price (16-22)')}}</th>
                                <th > {{ __('Add (16-22)')}}</th>
                                <th > {{ __('Discount (16-22)')}}</th>
                                <th > {{ __('Price (23-30)')}}</th>
                                <th > {{ __('Add (23-30)')}}</th>
                                <th > {{ __('Discount (23-30)')}}</th>
                                <th width="100px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($rows->total() > 0)
                                @foreach($rows as $row)
                                    <tr>
                                        <td>{{$row->ranges ?? ''}}</td>
                                        <td>{{$row->distance_from ?? ''}}</td>
                                        <td>{{$row->distance_to ?? ''}}</td>
                                        <td>{{$row->range_1_price ?? ''}}</td>
                                        <td>{{$row->range_1_add ?? ''}}</td>
                                        <td>{{$row->range_1_discount ?? ''}}</td>
                                        <td>{{$row->range_2_price ?? ''}}</td>
                                        <td>{{$row->range_2_add ?? ''}}</td>
                                        <td>{{$row->range_2_discount ?? ''}}</td>
                                        <td>{{$row->range_3_price ?? ''}}</td>
                                        <td>{{$row->range_3_add ?? ''}}</td>
                                        <td>{{$row->range_3_discount ?? ''}}</td>
                                        <td>{{$row->range_4_price ?? ''}}</td>
                                        <td>{{$row->range_4_add ?? ''}}</td>
                                        <td>{{$row->range_4_discount ?? ''}}</td>
                                        <td>{{$row->range_5_price ?? ''}}</td>
                                        <td>{{$row->range_5_add ?? ''}}</td>
                                        <td>{{$row->range_5_discount ?? ''}}</td>
                                        <td>{{$row->range_6_price ?? ''}}</td>
                                        <td>{{$row->range_6_add ?? ''}}</td>
                                        <td>{{$row->range_6_discount ?? ''}}</td>
                                        <td>
                                            <a href="{{route('tour.admin.prices.edit',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}
                                            </a>
                                            <br/>
                                            /
                                            <br/>
                                            <a href="{{route('tour.admin.prices.remove',['id'=>$row->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{__('Remove')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">{{__("No data")}}</td>
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
