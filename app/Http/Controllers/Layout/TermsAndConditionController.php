<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsAndConditionController extends Controller
{
    public function condition()
    {
        return view('layout.pages.privacy.condition');          
    }
        public function policy()
    {
        return view('layout.pages.privacy.policy');          
    }
     public function paymentcondition()
    {
        return view('layout.pages.privacy.payment-condition');          
    }
    public function moneyback()
    {
        return view('layout.pages.privacy.moneyback');          
    }
     public function howToOrder()
    {
        return view('layout.pages.privacy.howtoorder');          
    }
}
