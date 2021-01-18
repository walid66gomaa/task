@extends('frontend.layouts.app')
@section('title', trans('labels.frontend.cart.subscripe').' | '.app_name())

@push('after-styles')
  
    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>

    <style>

section.pricing {
  background: #f4f8fb;
}

.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 0.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 0.7;
  transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}
    </style>

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
               


                      
                    </div>

                
                </div>
            </div>
        </div>
    </section>

    <section class="pricing py-5">
        <div class="container">
          <div class="row">
            <!-- Free Tier -->
            @foreach ($subPackages as $subPackage)
            <div class="col-lg-4">
              <div class="card mb-5 mb-lg-0">
                <div class="card-body">
                  <h5 class="card-title text-muted text-uppercase text-center">{{ $subPackage->title }}</h5>
                  <h6 class="card-price text-center">  {{' USD '.$subPackage->price}}<span class="period"> </span></h6>
                  <hr>
                  <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-check"></i></span>مشاهده جميع الدورات</li>
                    <li><span class="fa-li"><i class="fas fa-check"></i></span>لمده {{ $subPackage->duration }} اشهر </li>
                  
                  </ul>
                  
                  <form action ="{{ route('frontend.auth.subscripe.selecte', [ $subPackage->slug] )}}"  method="POST">
                 @csrf()
                    <button  class="btn btn-block btn-primary text-uppercase">اشترك</button>
                 
                  </form>
                </div>
              </div>
            </div>
            @endforeach
       
          </div>
        </div>
      </section>
    <!-- End  of Checkout content
        ============================================= -->


@endsection

@push('after-scripts')
 
@endpush

