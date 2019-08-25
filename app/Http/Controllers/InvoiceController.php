<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
  public function admin(){
    $invoices = [];

    if(auth()-> user()-> stripe_id){
      $invoices = auth()-> user()-> invoices();
    }

    return view('invoices.admin', compact('invoices'));
  }

  public function download($id){
    return auth()-> user()-> downloadInvoice($id, [
      'vendor' => 'Mi empresa',
      'product' => __('Subscripcion')
    ]);
  }
}
