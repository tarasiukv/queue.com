<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Jobs\PaymentJob;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $per_page = 100;

        try {
            $model = Payment::with([
                'user',
            ])->paginate($per_page);

            return PaymentResource::collection($model);

        } catch (\Exception $e) {
            Log::error('Failed to retrieve users: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve users'], 500);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $model = Payment::create($request->all());
            $model->save();

            DB::commit();

            PaymentJob::dispatch($model)->onQueue('payment');

            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        if (!Payment::find($payment->id))
        {
            Log::info("Verify failed: {$user->email}");
            return;
        }

        return $payment;
    }
}
