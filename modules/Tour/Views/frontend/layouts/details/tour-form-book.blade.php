<style>
    .cus-style-pickup-date {
        width: 38%; 
        padding-left: 1.5%; 
        padding-top: 1%;
        margin-left: 3%;
    }

    .cus-style-pickup-time {
        width: 54.2%;
    }

    button:disabled,
    button[disabled]{
      border: 1px solid #999999;
      background-color: #cccccc;
      color: #666666;
    }

    .inline {
   width: 50%;
}
</style>


<div class="bravo_single_book_wrap @if(setting_item('tour_enable_inbox')) has-vendor-box @endif">
    <div class="bravo_single_book">
        <div id="bravo_tour_book_app" v-cloak>
            @if($row->discount_percent)
                <div class="tour-sale-box">
                    <span class="sale_class box_sale sale_small">{{$row->discount_percent}}</span>
                </div>
            @endif
            <div class="form-head">
                <div class="price">
                    <span class="label">
                        {{__("from")}}
                    </span>
                    <span class="value">
                        <span class="onsale">{{ $row->display_sale_price }}</span>
                        <span class="text-lg">{{ $row->display_price }}</span>
                    </span>
                </div>
            </div>
            <div class="nav-enquiry" v-if="is_form_enquiry_and_book">
                <div class="enquiry-item active" >
                    <span>{{ __("Book") }}</span>
                </div>
                <div class="enquiry-item" data-toggle="modal" data-target="#enquiry_form_modal">
                    <span>{{ __("Enquiry") }}</span>
                </div>
            </div>
            <div class="form-book" :class="{'d-none':enquiry_type!='book'}">
                <div class="form-content">


                    

                    <div class="form-group form-guest-search">
                        <div class="guest-wrapper d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <label>{{ __('Enter Your Pickup Location') }}</label>
                            </div>
                            
                        </div>


                        <div class="guest-wrapper d-flex justify-content-between align-items-center">
                            
                                <div class="bravo_form_search_map">
                                    <div class="g-map-place">
                                        <input type="text" style="height: 25px" name="location" id="pac-input" placeholder="{{__("Pickup location?")}}" value="" class="form-control border-0 pickup-location">
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    


                    <div class="row">
                        <div class="form-group form-date-field form-date-search clearfix cus-style-pickup-date" data-format="{{get_moment_date_format()}}">
                            <div class="date-wrapper clearfix" @click="openStartDate">
                                <div class="check-in-wrapper">
                                    {{-- <label>{{__("Start Date")}}</label> --}}
                                    <label>{{__("Pickup Date")}}</label>
                                    <div class="render check-in-render">@{{start_date_html}}</div>
                                </div>
                                <i class="fa fa-angle-down arrow"></i>
                            </div>
                            <input type="text" class="start_date" ref="start_date" style="height: 1px; visibility: hidden">
                        </div>

                        <div class="form-group form-guest-search cus-style-pickup-time">
                            <div class="guest-wrapper d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <label>{{__("Pickup Time")}}</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="input-number-group">
                                        <select v-model="start_time" class="form-control" @change="startTimeChange()">
                                            @for ( $i = 0 ; $i <= 23 ; $i++)
                                                <option value="{{ sprintf("%02d", $i) }}:00">{{ sprintf("%02d", $i) }} : 00</option>
                                                <option value="{{ sprintf("%02d", $i) }}:30">{{ sprintf("%02d", $i) }} : 30</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 
                    <div class="" v-if="person_types">
                        <div class="form-group form-guest-search" v-for="(type,index) in person_types">
                            <div class="guest-wrapper d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <label>@{{type.name}}</label>
                                    <div class="render check-in-render">@{{type.desc}}</div>
                                    <div class="render check-in-render">@{{type.display_price}} {{__("per person")}}</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="input-number-group">
                                        <i class="icon ion-ios-remove-circle-outline" @click="minusPersonType(type)"></i>
                                        <span class="input"><input type="number" v-model="type.number" min="1" @change="changePersonType(type)"/></span>
                                        <i class="icon ion-ios-add-circle-outline" @click="addPersonType(type)"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-guest-search" v-else>
                        <div class="guest-wrapper d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <label>{{__("Guests")}}</label>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="input-number-group">
                                    <i class="icon ion-ios-remove-circle-outline" @click="minusGuestsType()"></i>
                                    <span class="input"><input type="number" v-model="guests" min="1"/></span>
                                    <i class="icon ion-ios-add-circle-outline" @click="addGuestsType()"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-section-group form-group" v-if="extra_price.length">
                        <h4 class="form-section-title">{{__('Extra prices:')}}</h4>
                        <div class="form-group" v-for="(type,index) in extra_price">
                            <div class="extra-price-wrap d-flex justify-content-between">
                                <div class="flex-grow-1">
                                    <label><input type="checkbox" true-value="1" false-value="0" v-model="type.enable"> @{{type.name}}</label>
                                    <div class="render" v-if="type.price_type">(@{{type.price_type}})</div>
                                </div>
                                <div class="flex-shrink-0">@{{type.price_html}}</div>
                            </div>
                        </div>
                    </div>
                    --}} 

                    <div class="" v-if="person_types">
                        <div class="form-group form-guest-search" v-for="(type,index) in person_types" v-if="type.name == 'Adult'">
                            <div class="guest-wrapper d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <label>{{ __('Persons') }}</label>
                                </div>


                                <div class="flex-shrink-0">
                                    <div class="input-number-group">
                                        <i class="icon ion-ios-remove-circle-outline" @click="minusPersonType(type)"></i>
                                        <span class="input"><input type="number" v-model="type.number" min="1" @change="changePersonType(type)"/></span>
                                        <i class="icon ion-ios-add-circle-outline" @click="addPersonType(type)"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group form-guest-search">
                        <div class="guest-wrapper d-flex justify-content-between align-items-center">
                            <div class="row">
                            <div class="flex-grow-1 cus-style-pickup-date">
                                <label>{{__("Travel Time")}}</label>
                            </div>
                            

                            <div class="flex-shrink-1 cus-style-pickup-time">
                                <div class="input-number-group">

                                    <input type="number" min="0" class="form-control" readonly>Hrs.
                                    <input type="number" min="0" class="form-control" readonly>Mins
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    {{-- 
                    <div class="form-group form-guest-search" v-else>
                        <div class="guest-wrapper d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <label>{{__("Guests")}}</label>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="input-number-group">
                                    <i class="icon ion-ios-remove-circle-outline" @click="minusGuestsType()"></i>
                                    <span class="input"><input type="number" v-model="guests" min="1"/></span>
                                    <i class="icon ion-ios-add-circle-outline" @click="addGuestsType()"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}


                    {{-- 
                    <div class="form-section-group form-group-padding" v-if="buyer_fees.length">
                        <div class="extra-price-wrap d-flex justify-content-between" v-for="(type,index) in buyer_fees">
                            <div class="flex-grow-1">
                                <label>@{{type.type_name}}
                                    <i class="icofont-info-circle" v-if="type.desc" data-toggle="tooltip" data-placement="top" :title="type.type_desc"></i>
                                </label>
                                <div class="render" v-if="type.price_type">(@{{type.price_type}})</div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="unit" v-if='type.unit == "percent"'>
                                    @{{ type.price }}%
                                </div>
                                <div class="unit" v-else >
                                    @{{ formatMoney(type.price) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
                </div>

                <!-- v-if="total_price > 0" -->
                <ul class="form-section-total list-unstyled" >
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
                <div class="submit-group">

                    <div class="row">
                        <button type="button" disabled class="btn btn-secondary" data-dismiss="modal" style="width: 45%">{{__('Cancel')}}</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-large" @click="doSubmit($event)" :class="{'disabled':onSubmit,'btn-success':(step == 2),'btn-primary':step == 1}" name="submit" style="width: 45%;">
                            <span>{{__("BOOK NOW")}}</span>
                            <i v-show="onSubmit" class="fa fa-spinner fa-spin"></i>
                        </a>
                    </div>
                    
                    <div class="alert-text mt10" v-show="message.content" v-html="message.content" :class="{'danger':!message.type,'success':message.type}"></div>
                </div>
            </div>
            <div class="form-send-enquiry" v-show="enquiry_type=='enquiry'">
                <button class="btn btn-primary" data-toggle="modal" data-target="#enquiry_form_modal">
                    {{ __("Contact Now") }}
                </button>
            </div>
        </div>
    </div>
</div>
@include("Booking::frontend.global.enquiry-form",['service_type'=>'tour'])

<script>
    function openStartTime() {
        console.log("openStartTime clicked")
    }
</script>
