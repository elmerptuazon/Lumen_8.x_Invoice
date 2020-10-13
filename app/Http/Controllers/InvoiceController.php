<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request) {
        $authCheck = $this->authUser($request->header('Authorization'));
        if(!$authCheck) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $invoice = Invoice::all();
        return response()->json($invoice);
    }

    public function store(Request $request) {

        $authCheck = $this->authUser($request->header('Authorization'));
        if(!$authCheck) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->validate($request, [
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'user_id' => 'required',
            'customer_name' => 'required',
            'product_name' => 'required',
            'product_quantity' => 'required|numeric',
            'product_price' => 'required',
            'total_invoice_amount' => 'required'
        ]);

        Invoice::create([
            'invoice_number' => $request->input('invoice_number'),
            'invoice_date' => $request->input('invoice_date'),
            'user_id' => $request->input('user_id'),
            'customer_name' => $request->input('customer_name'),
            'product_name' => $request->input('product_name'),
            'product_quantity' => $request->input('product_quantity'),
            'product_price' => $request->input('product_price'),
            'total_invoice_amount' => $request->input('total_invoice_amount')
        ]);

        return response()->json(['status' => 'success'], 200);

    }

    public function show(Request $request, $id) {
        $authCheck = $this->authUser($request->header('Authorization'));
        if(!$authCheck) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $invoice = Invoice::where('id', $id)->get();
        return response()->json($invoice);
    }

    public function update(Request $request) {
        $authCheck = $this->authUser($request->header('Authorization'));
        if(!$authCheck) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->validate($request, [
            'invoice_id' => 'required',
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'customer_name' => 'required',
            'product_name' => 'required',
            'product_quantity' => 'required|numeric',
            'product_price' => 'required',
            'total_invoice_amount' => 'required'
        ]);
        
        $checkInvoiceId =  Invoice::where('id', $request->input('invoice_id'))->first();

        if($checkInvoiceId) {
            Invoice::where('id', $request->input('invoice_id'))->update([
                'invoice_number' => $request->input('invoice_number'),
                'invoice_date' => $request->input('invoice_date'),
                'customer_name' => $request->input('customer_name'),
                'product_name' => $request->input('product_name'),
                'product_quantity' => $request->input('product_quantity'),
                'product_price' => $request->input('product_price'),
                'total_invoice_amount' => $request->input('total_invoice_amount')
            ]);
            return response()->json(['status' => 'success'], 200);
        }else {
            return response()->json(['status' => 'fail'],401);
        }

    }

    public function destroy(Request $request, $id) {
        $authCheck = $this->authUser($request->header('Authorization'));
        if(!$authCheck) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $checkInvoiceId =  Invoice::where('id', $id)->first();

        if($checkInvoiceId) {
            Invoice::where('id', $id)->delete();
            return response()->json(['status' => 'success'], 200);
        }else {
            return response()->json(['status' => 'fail'],401);
        }
    }
}
