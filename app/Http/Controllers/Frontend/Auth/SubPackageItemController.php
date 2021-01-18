<?php

namespace App\Http\Controllers\Frontend\Auth;

use Omnipay\Omnipay;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\SubscripPackage;
use App\Models\SubscripPackageItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SubPackageItemController extends Controller
{
    private $currency;

    public function __construct()
    {

        $this->currency['short_code'] = 'USD';


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $subPackages= SubscripPackage::where('active',1)->get();
    
       return view('frontend.sub-packages.index',compact('subPackages'));
    }

 
   
    

    /**
     * Display the specified resource.
     *
     * @param  \App\SubscripPackageItem  $subscripPackageItem
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $subPackage= SubscripPackage::where('slug',$slug)->first();
        return view('frontend.sub-packages.show',compact('subPackage'));
    
    }

    public function stripePayment(Request $request)
    {
      
        $subPackage= SubscripPackage::where('slug',$request->package_slug)->first();
        $gateway = Omnipay::create('Stripe');
        // STRIPE_ACTIVE=1
        // STRIPE_KEY=pk_test_cg2c7WrkzAWIHcWEMw1gMyTH
        // STRIPE_SECRET=sk_test_3jpTvL7BvxqGta6PPQrLhq8Q

        $gateway->setApiKey(env('STRIPE_SECRET'));
        $token = $request->reservation['stripe_token'];
 
        $amount = $subPackage->price;
        $currency = $this->currency['short_code'];
        $response = $gateway->purchase([
            'amount' => $amount,
            'currency' => $currency,
            'token' => $token,
            'confirm' => true,
            'description' => auth()->user()->name
            ])->send();
            
           
            if ($response->isSuccessful()) {
              
                $this->subPackageItenCreate( $subPackage);
                $transaction = Transaction::create([
                    'user_id' => auth()->user()->id,
                    'transaction_id' => ($response->getData())['id'],
                    'paymentway' => 'srtipe'
                    
                ]);
                  $transaction->save();
                  Session::flash('flash_success', 'payment success');
                return redirect()->route('frontend.index')->with('flash_success', 'payment success');
        

        } else {
        
            \Log::info($response->getMessage() . ' for id = ' . auth()->user()->id);
            Session::flash('failure', 'try again');
          
            return redirect()->route('frontend.auth.subscripe');
        }
    }

   

    
    private function subPackageItenCreate(SubscripPackage $subPackage )
    {
        $subPackageItem=new SubscripPackageItem();
        $subPackageItem->user_id=auth()->user()->id;
        $subPackageItem->subscrip_package_id=$subPackage->id;
        $subPackageItem->price=$subPackage->price;
        $subPackageItem->duration=$subPackage->duration;
        $subPackageItem->start_date=now();
        $subPackageItem->save();
        return $subPackageItem;
    }


   
}
