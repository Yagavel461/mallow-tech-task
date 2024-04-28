<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PurchaseItem;
use App\Models\PurchaseHistory;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Mail;


class ProductController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $page = request()->query('page', 1);
        $skip = ($page - 1) * $perPage;
        $products = Product::orderBy('created_at', 'desc')->skip($skip)->limit($perPage)->get()->toArray();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'product_id' => 'required|string|unique:products',
            'available_stocks' => 'required|integer',
            'price' => 'required|numeric',
            'tax_percentage' => 'required|numeric',
        ]);

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function generateBill()
    {
        return view('products.generateBill');
    }

    public function calculateBill(Request $request)
    {
        $validatedData = $request->validate([
            'amount_given' => 'required|numeric|gte:1',
        ], [
            'amount_given.gte' => 'The :attribute must be greater than or equal to 1.',
        ]);

        $inputData = $request->input();
        $items = $inputData['product'];
        $purchase_id = 'bill_'.uniqid();
        $total_price = $total_tax = 0;
        foreach ($items as $key => $val){
            $product = Product::where('product_id', $val['product_id'])->first();
            if (!empty($product)) {
                $selectedFields = $product->only(['id', 'name', 'product_id', 'available_stocks', 'price', 'tax_percentage']);
                $purchaseItem = [
                    'customer_email' => $inputData['customer_email'],
                    'purchase_id' => $purchase_id,
                    'product_id' => $val['product_id'],
                    'quantity' => $val['quantity'],
                    'unit_price' => $selectedFields['price'],
                    'total_price' => $val['quantity'] * $selectedFields['price'],
                    'total_tax' => ($selectedFields['tax_percentage']/100) * ($val['quantity'] * $selectedFields['price']),
                ];
                $total_price += ($val['quantity'] * $selectedFields['price']);
                $total_tax += ($selectedFields['tax_percentage'] / 100) * ($val['quantity'] * $selectedFields['price']);
                PurchaseItem::create($purchaseItem);
                $inputData['product'][$key]['details'] = $selectedFields;
            } else {
                return redirect()->route('products.generatebill')->with('failed', 'Invalid Product ID ' . $val['product_id']);
            }
        }
        $purchaseItem = [
            'customer_email' => $inputData['customer_email'],
            'purchase_id' => $purchase_id,
            'total_price' => $total_price,
            'total_tax' => $total_tax,
            'status' => 'completed',
            'notes' => 'Bill Generated'
        ];
        PurchaseHistory::create($purchaseItem);

        $totalAmtPaidbyCustomer = 0;
        foreach($inputData['denominations'] as $key => $val){
            if(!empty($val)){
                $totalAmtPaidbyCustomer += $key * $val;
            }
        }
        $bill = [
            'customer_email' => $inputData['customer_email'],
            'product' => $inputData['product'],
            'denominations' => $inputData['denominations'],
            'total_amount_paid_by_customer' => $totalAmtPaidbyCustomer
        ];
        dispatch(new SendEmailJob($bill));
        return view('products.bill', compact('bill'));
    }

    public function purchaseHistory(){
        $perPage = 100;
        $page = request()->query('page', 1);
        $skip = ($page - 1) * $perPage;
        $products = PurchaseHistory::orderBy('created_at', 'desc')->skip($skip)->limit($perPage)->get()->toArray();
        return view('products.purchasehistories', compact('products'));
    }

    public function purchaseDetails($id)
    {
        $products = PurchaseItem::where('purchase_id', $id)->get()->toArray();
        $overallTax = array_sum(array_column($products, 'total_tax'));
        $overallTotalPrice = array_sum(array_column($products, 'total_price'));
        return view('products.purchasedetail', compact('products', 'overallTax', 'overallTotalPrice'));
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function update(Request $request)
    {
        $productId = $request->input('id');
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $product->update($request->all());
        return redirect()->back()->with('success', 'Product updated successfully.');
    }



}
