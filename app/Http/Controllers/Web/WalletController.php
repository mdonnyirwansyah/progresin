<?php

namespace App\Http\Controllers\Web;

use App\Models\Wallet;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Web\Wallet\WalletStoreRequest;
use App\Http\Requests\Web\Wallet\WalletUpdateRequest;

class WalletController extends Controller
{
    public function view(): View
    {
        return view('app.wallet');
    }

    public function list(): JsonResponse
    {
        $wallets = Wallet::query()
            ->select([
                'slug',
                'name',
                'balance'
            ]);

        return DataTables::eloquent($wallets)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(WalletStoreRequest $request)
    {
        $wallet = Wallet::create($request->validated());

        return response()->json([
            'data' => $wallet->only([
                'slug',
                'name',
                'balance'
            ])
        ]);
    }

    public function show(Wallet $wallet): JsonResponse
    {
        return response()
            ->json([
                'data' => $wallet->only([
                    'slug',
                    'name',
                    'balance'
                ])
            ]);
    }

    public function update(WalletUpdateRequest $request, Wallet $wallet)
    {
        $wallet->update($request->validated());

        return response()->json([
            'data' => $wallet->only([
                'slug',
                'name',
                'balance'
            ])
        ]);
    }

    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return response()->json([
            'data' => $wallet->only([
                'slug',
                'name',
                'balance'
            ])
        ]);
    }
}
