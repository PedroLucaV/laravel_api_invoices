<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\InvoicesFilter;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use App\Models\Customer;
use App\Http\Requests\V1\StoreInvoicesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Requests\V1\BulkStoreInvoicesRequest;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new InvoicesFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new InvoiceCollection(Invoice::paginate());
        } else {
            $invoices = Invoice::where($queryItems)->paginate();
            return new InvoiceCollection($invoices->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoicesRequest $request)
    {
        return new InvoiceResource(Invoice::create($request->all()));
    }

    public function bulkStore(BulkStoreInvoicesRequest $request){
        $bulk = collect($request->all())->map(function($arr, $key){
            return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });

        Invoice::insert($bulk->toArray());

        return json_encode(['status'=> 'success', 'message' => 'insert successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
