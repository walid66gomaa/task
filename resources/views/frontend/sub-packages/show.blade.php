@extends('frontend.layouts.app')
@section('title', trans('labels.frontend.cart.subscripe').' | '.app_name())

@push('after-styles')
  
    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>

@endpush
@section('content')

    <!-- Start of breadcrumb section
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><span>@lang('labels.frontend.subscripe')</span> </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of Checkout content
        ============================================= -->
    <section id="checkout" class="checkout-section">
        <div class="container">
            <div class="section-title mb45 headline text-center">
                <span class="subtitle text-uppercase">@lang('labels.frontend.cart.your_shopping_cart')</span>
                <h2>اشترك في جميع الدورات</h2>
            </div>
            <div class="checkout-content">
                @if(session()->has('danger'))
                    <div class="alert alert-dismissable alert-danger fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {!! session('danger')  !!}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-9">
                        <div class="order-item mb30 course-page-section">
                            <div class="section-title-2  headline text-right">
                                <h2>@lang('labels.frontend.cart.order_item')</h2>
                            </div>

                           
                        </div>
                    


                        @if(isset($subPackage) > 0)
                            @if(env('STRIPE_ACTIVE') == 0)
                                <div class="order-payment">
                                    <div class="section-title-2  headline text-right">
                                <h2>@lang('labels.frontend.cart.no_payment_method')</h2>
                                    </div>
                                </div>
                            @else
                                <div class="order-payment">
                                    <div class="section-title-2  headline text-right">
                                        <h2>@lang('labels.frontend.cart.order_payment')</h2>
                                    </div>
                                    <div id="accordion">
                                        @if(env('STRIPE_ACTIVE') == 1)
                                            <div class="payment-method w-100 mb-0">
                                                <div class="payment-method-header">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="method-header-text">
                                                                <div class="radio">
                                                                    <label>
                                                                        <input data-toggle="collapse" href="#collapsePaymentOne"
                                                                               type="radio" name="paymentMethod" value="1"
                                                                               checked>
                                                                        @lang('labels.frontend.cart.payment_cards')
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="payment-img float-right">
                                                                <img src="{{asset('assets/img/banner/p-1.jpg')}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="check-out-form collapse show" id="collapsePaymentOne"
                                                     data-parent="#accordion">


                                                    <form accept-charset="UTF-8" action="{{route('frontend.auth.subPackages.stripe.payment')}}"
                                                          class="require-validation" data-cc-on-file="false"
                                                          data-stripe-publishable-key="{{env('STRIPE_KEY')}}" id="payment-form"
                                                          method="POST">
                                                         <input type="hidden" value="{{ $subPackage->slug }}" id="package_slug" name="package_slug"> 
                                                        <div style="margin:0;padding:0;display:inline">
                                                            <input name="utf8" type="hidden"
                                                                   value="✓"/>
                                                            @csrf
                                                        </div>



                                                        <div class="payment-info">
                                                            <label class=" control-label">@lang('labels.frontend.cart.name_on_card') :</label>
                                                            <input type="text" autocomplete='off' class="form-control required card-name"
                                                                   placeholder="@lang('labels.frontend.cart.name_on_card_placeholder')" value="">
                                                        </div>
                                                        <div class="payment-info">
                                                            <label class=" control-label">@lang('labels.frontend.cart.card_number') :</label>
                                                            <input autocomplete='off' type="text"
                                                                   class="form-control required card-number"
                                                                   placeholder="@lang('labels.frontend.cart.card_number_placeholder')" value="">
                                                        </div>
                                                        <div class="payment-info input-2">
                                                            <label class=" control-label">@lang('labels.frontend.cart.cvv') :</label>
                                                            <input type="text" class="form-control card-cvc required"
                                                                   placeholder="@lang('labels.frontend.cart.cvv')"
                                                                   value="">
                                                        </div>
                                                        <div class="payment-info input-2">
                                                            <label class=" control-label">@lang('labels.frontend.cart.expiration_date') :</label>
                                                            <input autocomplete='off' type="text"
                                                                   class="form-control required card-expiry-month"
                                                                   placeholder="@lang('labels.frontend.cart.mm')"
                                                                   value="">
                                                            <input autocomplete='off' type="text"
                                                                   class="form-control required card-expiry-year"
                                                                   placeholder="@lang('labels.frontend.cart.yy')"
                                                                   value="">
                                                        </div>
                                                        <button type="submit"
                                                                class="text-white genius-btn mt25 gradient-bg text-center text-uppercase  bold-font">
                                                            @lang('labels.frontend.cart.pay_now') <i class="fas fa-caret-right"></i>
                                                        </button>
                                                        <div class="row mt-3">
                                                            <div class="col-12 error form-group d-none">
                                                                <div class="alert-danger alert">
                                                                    @lang('labels.frontend.cart.stripe_error_message')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif

                                       
                                    
                                    </div>

                                    <div class="terms-text pb45 mt25">
                                        <p>@lang('labels.frontend.cart.confirmation_note')</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>

                
                </div>
            </div>
        </div>
    </section>
    <!-- End  of Checkout content
        ============================================= -->


@endsection

@push('after-scripts')
    @if(env('STRIPE_ACTIVE') == 1)
        <script type="text/javascript" src="{{asset('js/stripe-form.js')}}"></script>
    @endif
    <script>
        $(document).ready(function () {
            $(document).on('click', 'input[type="radio"]:checked', function () {
                $('#accordion .check-out-form').addClass('disabled')
                $(this).closest('.payment-method').find('.check-out-form').removeClass('disabled')
            });

        

        })
    </script>
@endpush