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
    <div class="panel-title"><strong>{{__("Pax: 1 - 4")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="number" step="any" min="0" name="range_1_price" class="form-control" value="{{$row->range_1_price}}" placeholder="{{__("Price")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Add")}}</label>
                        <input type="number" step="any" min="0" name="range_1_add" class="form-control" value="{{$row->range_1_add}}" placeholder="{{__("Add")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Discount")}}</label>
                        <input type="number" step="any" min="0" name="range_1_discount" class="form-control" value="{{$row->range_1_discount}}" placeholder="{{__("Discount")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Pax: 5 - 6")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="number" step="any" min="0" name="range_2_price" class="form-control" value="{{$row->range_2_price}}" placeholder="{{__("Price")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Add")}}</label>
                        <input type="number" step="any" min="0" name="range_2_add" class="form-control" value="{{$row->range_2_add}}" placeholder="{{__("Add")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Discount")}}</label>
                        <input type="number" step="any" min="0" name="range_2_discount" class="form-control" value="{{$row->range_2_discount}}" placeholder="{{__("Discount")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Pax: 7 - 10")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="number" step="any" min="0" name="range_3_price" class="form-control" value="{{$row->range_3_price}}" placeholder="{{__("Price")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Add")}}</label>
                        <input type="number" step="any" min="0" name="range_3_add" class="form-control" value="{{$row->range_3_add}}" placeholder="{{__("Add")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Discount")}}</label>
                        <input type="number" step="any" min="0" name="range_3_discount" class="form-control" value="{{$row->range_3_discount}}" placeholder="{{__("Discount")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Pax: 11 - 15")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="number" step="any" min="0" name="range_4_price" class="form-control" value="{{$row->range_4_price}}" placeholder="{{__("Price")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Add")}}</label>
                        <input type="number" step="any" min="0" name="range_4_add" class="form-control" value="{{$row->range_4_add}}" placeholder="{{__("Add")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Discount")}}</label>
                        <input type="number" step="any" min="0" name="range_4_discount" class="form-control" value="{{$row->range_4_discount}}" placeholder="{{__("Discount")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Pax: 16 - 22")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="number" step="any" min="0" name="range_5_price" class="form-control" value="{{$row->range_5_price}}" placeholder="{{__("Price")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Add")}}</label>
                        <input type="number" step="any" min="0" name="range_5_add" class="form-control" value="{{$row->range_5_add}}" placeholder="{{__("Add")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Discount")}}</label>
                        <input type="number" step="any" min="0" name="range_5_discount" class="form-control" value="{{$row->range_5_discount}}" placeholder="{{__("Discount")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

<div class="panel">
    <div class="panel-title"><strong>{{__("Pax: 23 - 30")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="number" step="any" min="0" name="range_6_price" class="form-control" value="{{$row->range_6_price}}" placeholder="{{__("Price")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Add")}}</label>
                        <input type="number" step="any" min="0" name="range_6_add" class="form-control" value="{{$row->range_6_add}}" placeholder="{{__("Add")}}">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">    
                        <label class="control-label">{{__("Discount")}}</label>
                        <input type="number" step="any" min="0" name="range_6_discount" class="form-control" value="{{$row->range_6_discount}}" placeholder="{{__("Discount")}}">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>
@endif
