<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\TransactionRepository;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Services\QuickBooks;
use App\Models\Transaction;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    use ResponseTrait;

    /**
     * @param StoreTransactionRequest $request
     * @param TransactionRepository $transactionRepository
     * @return JsonResponse
     */
    public function create(StoreTransactionRequest $request, TransactionRepository $transactionRepository): JsonResponse
    {
        try {
            $transaction = $transactionRepository->findByTransationId($request->get('transaction_id'));
            if ($transaction) {
                return $this->errorResponse('Transaction already exists.', [], 409);
            }

            $transactionRepository->save($request->all());
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getCode());
        }

        return $this->successResponse(null, 'Transaction created successfully.');
    }

    /**
     * @throws Exception
     */
    public function recordExpense(Request $request): JsonResponse
    {

        $transactions = Transaction::pendingTransactions()->get();

        $amount = random_int(1, 100)/50;

        try {
            $qb = new QuickBooks();
            $qb->expense(['amount' => $amount]);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getCode());
        }

        return $this->successResponse("Expense ($amount) recorded successfully.");
    }
}
