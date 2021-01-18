@extends('frontend.layouts.app')
@section('title', trans('subscripe').' | '.app_name())

@push('after-styles')
  
    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>

@endpush
@section('content')

  


    <!-- Start of Checkout content
        ============================================= -->
    <section id="checkout" class="checkout-section">
        <div class="container">
            <div class="section-title mb45 headline text-center">
              <h2>see all products</h2>
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
                     
                    


                        @if(isset($subPackage) > 0)
                            @if(env('STRIPE_ACTIVE') == 0)
                                <div class="order-payment">
                                    <div class="section-title-2  headline text-right">
                                <h2>No payment method available at this moment</h2>
                                    </div>
                                </div>
                            @else
                                <div class="order-payment">
                                    <div class="section-title-2  headline text-right">
                                        <h2>Order <span>Payment.</span></h2>
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
                                                                               Credit or Debit Card
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
                                                            <label class=" control-label">Name on Card :</label>
                                                            <input type="text" autocomplete='off' class="form-control required card-name"
                                                                   placeholder="Enter the name written on your card" value="">
                                                        </div>
                                                        <div class="payment-info">
                                                            <label class=" control-label">@lang('card_number') :</label>
                                                            <input autocomplete='off' type="text"
                                                                   class="form-control required card-number"
                                                                   placeholder="@lang('card number')" value="">
                                                        </div>
                                                        <div class="payment-info input-2">
                                                            <label class=" control-label">@lang('cvv') :</label>
                                                            <input type="text" class="form-control card-cvc required"
                                                                   placeholder="@lang('cvv')"
                                                                   value="">
                                                        </div>
                                                        <div class="payment-info input-2">
                                                            <label class=" control-label">@lang('expiration date') :</label>
                                                            <input autocomplete='off' type="text"
                                                                   class="form-control required card-expiry-month"
                                                                   placeholder="@lang('mm')"
                                                                   value="">
                                                            <input autocomplete='off' type="text"
                                                                   class="form-control required card-expiry-year"
                                                                   placeholder="@lang('yy')"
                                                                   value="">
                                                        </div>
                                                        <button type="submit"
                                                                class="text-white genius-btn mt25 gradient-bg text-center text-uppercase  bold-font">
                                                            @lang('pay now') <i class="fas fa-caret-right"></i>
                                                        </button>
                                                        <div class="row mt-3">
                                                            <div class="col-12 error form-group d-none">
                                                                <div class="alert-danger alert">
                                                                    Please correct the errors and try again
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