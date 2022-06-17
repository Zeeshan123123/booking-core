<style>
    .cus-style-pickup-date {
        width: 47%;
        /*padding-left: 1.5%; */
        /*padding-top: 1%;*/
        margin-left: 4%;
    }

    .cus-style-persons {
        width: 44%;
        margin-left: 4%;
    }

    .cus-style-pickup-time {
        width: 45.2%;
    }

    button:disabled,
    button[disabled] {
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
    }

    .cus-font {
        font-size: 13px !important;
        color: #5e6d77 !important;
        margin-top: 1% !important;
    }

    .cus-font-price {
        font-size: 20px !important;
        color: #5e6d77 !important;
        margin-left: 6px !important;
    }

    .cus-style-total {
        padding: 16px 125px !important;
    }

    #pac-input::placeholder {
        font-size: 16px;
        color: #1a2b48;
        font-weight: 500;
    }

    .bg-focus {
        background-color: #e7e5e5 !important;
    }

    .cus-label {
        font-size: 13px !important;
        color: black !important;
        font-weight: 300 !important;
    }

    .cus-pickup-label {
        font-size: 14px !important;
        color: black !important;
        font-weight: 300 !important;
    }

    .search-box, .close-icon, .search-wrapper {
        position: relative;
        padding: 10px;
    }

    .search-wrapper {
        width: 500px;
        margin-top: -14px;
        margin-bottom: -15px;
    }

    .search-box {
        width: 59%;
        border: 1px solid #ccc;
        outline: 0;
    }

    .search-box:focus {
        box-shadow: 0 0 15px 5px #b0e0ee;
        border: 2px solid #bebede;
    }

    .close-icon {
        border: 1px solid transparent;
        background-color: transparent;
        display: inline-block;
        vertical-align: middle;
        outline: 0;
        cursor: pointer;
    }

    .close-icon:after {
        content: "X";
        display: block;
        width: 15px;
        height: 15px;
        position: absolute;
        /*background-color: #FA9595;*/
        z-index: 1;
        right: 35px;
        top: 0;
        bottom: 0;
        margin: auto;
        /*padding: 2px;*/
        border-radius: 50%;
        text-align: center;
        color: #212529;
        font-weight: normal;
        font-size: 12px;
        box-shadow: 0 0 2px #000000;
        cursor: pointer;
    }

    .search-box:not(:valid) ~ .close-icon {
        display: none;
    }

    .flt-suggestion {
        background-color: #f9f9f9;
    }

    .bravo_wrap .bravo_detail_car .bravo_single_book .one-way {
        position: absolute;
        top: -5px;
        overflow: hidden;
        height: 70px;
        width: 70px;
        right: -1px;
    }

    .bravo_wrap .bravo_detail_car .bravo_single_book .one-way .sale_class {
        position: absolute;
        width: 90px;
        height: 48px;
        transform: rotate(45deg);
        right: -30px;
        top: -9px;
        line-height: 65px;
        text-align: center;
        color: #fff;
        font-size: 15px;
        z-index: 8;
        background-color: #c03;
    }

    .bravo_wrap .bravo_detail_car .bravo_single_book {
        border-top: 0px;
    }

    .trip-buttons {
        border: 2px solid;
        margin-top: -5px;
        cursor: pointer;
    }

    .bravo_wrap .bravo_detail_car .bravo_single_book .form-head {
        border-bottom: 0px;
    }

    .bravo_wrap .bravo_detail_car .bravo_single_book .form-head {
        padding: 0px;
    }
    .active-trip{
        border-color: #5191fa;
    }
</style>
<div class="bravo_single_book_wrap">
    <div class="bravo_single_book">
        <div id="bravo_car_book_app" v-cloak>
            <div class="row">

                {{--            @if($row->discount_percent)--}}
                <div class="form-group form-guest-search cus-style-persons trip-buttons single-trip active-trip">

                    <div class="one-way">
                        <span class="sale_class box_sale sale_small">82%</span>
                        {{--                    <span class="sale_class box_sale sale_small">{{$row->discount_percent}}</span>--}}
                    </div>
                    {{--            @endif--}}
                    <div class="form-head">
                        <div class="price">
                            <span class="value">
                        <span class="onsale">{{ $row->display_sale_price }}</span>
                        <span class="text-lg">{{ $row->display_price }}</span>

                    <p class="label">
                        {{__("Oneway Trip")}}
                    </p>
                    </span>
                        </div>
                    </div>
                </div>
                <div class="form-group form-guest-search cus-style-persons trip-buttons round-trip">

                    <div class="tour-sale-box">
                        <span class="sale_class box_sale sale_small">82%</span>
                        {{--                    <span class="sale_class box_sale sale_small">{{$row->discount_percent}}</span>--}}
                    </div>
                    {{--            @endif--}}
                    <div class="form-head">
                        <div class="price">

                            <span class="value">
                        <span class="onsale">{{ $row->display_sale_price }}</span>
                        <span class="text-lg">{{ $row->display_price }}</span>

                            <p class="label">
                                {{__("Round Trip")}}
                            </p>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-enquiry" v-if="is_form_enquiry_and_book">
                <div class="enquiry-item active">
                    <span>{{ __("Book") }}</span>
                </div>
                <div class="enquiry-item" data-toggle="modal" data-target="#enquiry_form_modal">
                    <span>{{ __("Enquiry") }}</span>
                </div>
            </div>
            <div class="form-content" :class="{'d-none':enquiry_type!='book'}">
                <div class="row">
                <!-- data-format="{{get_moment_date_format()}}" -->
                    <div class="form-group form-date-field form-date-search clearfix cus-style-pickup-date">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="pickupInput" placeholder="Pickup Date">
                            <label for="pickupInput">{{__("Pickup Date")}}</label>
                        </div>
                    </div>
                    <div class="form-group cus-style-pickup-time">


                        <div class="form-floating">
                            <input type="time" class="form-control" id="floatingInput"
                                   placeholder="Enter Your Pickup Location">
                            <label for="floatingInput">{{__("Pickup Time")}}</label>
                        </div>
                    </div>
                </div>
                <div class="row d-none" style="margin-top: 10px;" id="return-quicks">
                <!-- data-format="{{get_moment_date_format()}}" -->
                    <div class="form-group form-date-field form-date-search clearfix cus-style-pickup-date">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="pickupInput" placeholder="Pickup Date">
                            <label for="pickupInput">{{__("Pickup Date")}}</label>
                        </div>
                    </div>
                    <div class="form-group cus-style-pickup-time">


                        <div class="form-floating">
                            <input type="time" class="form-control" id="floatingInput"
                                   placeholder="Enter Your Pickup Location">
                            <label for="floatingInput">{{__("Pickup Time")}}</label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 5px;">
                    <div class="form-group form-guest-search cus-style-persons">
                        <!-- d-flex -->
                        <div class="guest-wrapper justify-content-between align-items-center" style="margin-left: -6%;">
                            <div class="flex-grow-1">
                                <label class="cus-label">{{__("Persons")}}</label>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="input-number-group">
                                    <select v-model="persons" class="form-control" @change="startTimeChange()">
                                        @for ( $i = 0 ; $i <= 30 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-guest-search cus-style-persons">
                        <!-- d-flex -->
                        <div class="guest-wrapper justify-content-between align-items-center" style="margin-left: -6%;">
                            <div class="flex-grow-1">
                                <label class="cus-label">{{__("Luggage")}}</label>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="input-number-group">
                                    <select v-model="persons" class="form-control" @change="startTimeChange()">
                                        @for ( $i = 0 ; $i <= 30 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group form-guest-search text-center flt-suggestion">
                    <label>Provide your FLT#, if it's late, we will wait!</label>
                </div>
                <div class="row" style="margin-top: 5px;">
                    <div class="form-group form-guest-search cus-style-persons">
                        <!-- d-flex -->
                        <div class="guest-wrapper justify-content-between align-items-center" style="margin-left: -6%;">
                            <div class="flex-grow-1">
                                <label class="cus-label">{{__("Pickup FLT#")}}</label>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="input-number-group">
                                    <select v-model="persons" class="form-control" @change="startTimeChange()">
                                        @for ( $i = 0 ; $i <= 30 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-guest-search cus-style-persons">
                        <!-- d-flex -->
                        <div class="guest-wrapper justify-content-between align-items-center" style="margin-left: -6%;">
                            <div class="flex-grow-1">
                                <label class="cus-label">{{__("Return FLT#")}}</label>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="input-number-group">
                                    <select v-model="persons" class="form-control" @change="startTimeChange()">
                                        @for ( $i = 0 ; $i <= 30 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="submit-group">

                    <div class="row">
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-large" @click="doSubmit($event)"
                           :class="{'disabled':onSubmit,'btn-success':(step == 2),'btn-primary':step == 1}"
                           name="submit" style="width: 92%;">
                            <span>{{__("BOOK NOW")}}</span>
                            <i v-show="onSubmit" class="fa fa-spinner fa-spin"></i>
                        </a>
                    </div>

                    <div class="alert-text mt10" v-show="message.content" v-html="message.content"
                         :class="{'danger':!message.type,'success':message.type}"></div>
                </div>
                <ul class="form-section-total list-unstyled" v-if="total_price > 0">
                    <li>
                        <label>{{__("Total")}}</label>
                        <span class="price">@{{total_price_html}}</span>
                    </li>
                    <li v-if="is_deposit_ready">
                        <label for="">{{__("Pay now")}}</label>
                        <span class="price">@{{pay_now_price_html}}</span>
                    </li>
                </ul>
                <div v-html="html"></div>
            </div>
            <div class="form-send-enquiry" v-show="enquiry_type=='enquiry'">
                <button class="btn btn-primary" data-toggle="modal" data-target="#enquiry_form_modal">
                    {{ __("Contact Now") }}
                </button>
            </div>
        </div>
    </div>
</div>
@include("Booking::frontend.global.enquiry-form",['service_type'=>'car'])
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $( document ).ready(function() {
        $(".round-trip").on('click', function(event){
            // console.log('active');
            $(".single-trip").removeClass("active-trip");
            $(".round-trip").addClass("active-trip");

            $("#return-quicks").removeClass("d-none");
        });
    });
    $( document ).ready(function() {
        $(".single-trip").on('click', function(event){
            // console.log('active');
            $(".single-trip").addClass("active-trip");
            $(".round-trip").removeClass("active-trip");

            $("#return-quicks").addClass("d-none");
        });
    });

</script>