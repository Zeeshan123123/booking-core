<?php  $languages = \Modules\Language\Models\Language::getActive();  ?>
@if(is_default_lang())
<div class="panel">
    <div class="panel-title"><strong>{{__("Distance")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Range")}}</label>
                        <input type="number" step="any" min="0" name="ranges" class="form-control" value="{{$row->ranges}}" placeholder="{{__("Range")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("From (Km)")}}</label>
                        <input type="number" step="any" min="0" name="distance_from" class="form-control" value="{{$row->distance_from}}" placeholder="{{__("From (Km)")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("To (Km)")}}</label>
                        <input type="number" step="any" min="0" name="distance_to" class="form-control" value="{{$row->distance_to}}" placeholder="{{__("To (Km)")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Oneway trip")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="number" step="any" min="0" name="one_way_trip_price" class="form-control" value="{{$row->one_way_trip_price}}" placeholder="{{__("Price")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Discount")}}</label>
                        <input type="number" step="any" min="0" name="one_way_trip_discount" class="form-control" value="{{$row->one_way_trip_discount}}" placeholder="{{__("Discount")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Round trip")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="number" step="any" min="0" name="round_trip_price" class="form-control" value="{{$row->round_trip_price}}" placeholder="{{__("Price")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Discount")}}</label>
                        <input type="number" step="any" min="0" name="round_trip_discount" class="form-control" value="{{$row->round_trip_discount}}" placeholder="{{__("Discount")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>
@endif
