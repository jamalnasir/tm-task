<?php

namespace App\Console\Commands;

use App\Http\Services\QuickBooks;
use App\Models\Platform;
use App\Models\Transaction;
use Exception;
use Illuminate\Console\Command;

class SyncTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to sync transactions for various platforms.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            $platforms = Platform::where('status', 1)->get();

            $transactions = Transaction::pendingTransactions()->get();

            foreach ($transactions as $transaction) {

                $amount = abs($transaction->amount);

                $platform = $this->searchCollection($platforms, 'Quickbooks');
                if ($platform) {
                    $qb = new QuickBooks();
                    $qb->expense(['amount' => $amount]);
                }

                $transaction->sync_status = 2;
                $transaction->save();

                if (!$transaction->platforms->contains($platform->id)) {
                    $transaction->platforms()->attach($platform->id);
                }

                $this->line($transaction->transaction_id . ' for amount (' . $amount . ') synced with ' . $platform->platform_name);
            }

            $this->line('Process completed!');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * @param $platforms
     * @param $value
     * @return Platform|null
     */
    private function searchCollection($platforms, $value): ?Platform
    {
        return $platforms->firstWhere('platform_name', $value);
    }
}
