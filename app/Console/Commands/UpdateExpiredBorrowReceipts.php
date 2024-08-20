<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BorrowReceipt;
use Carbon\Carbon;

class UpdateExpiredBorrowReceipts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'borrow-receipts:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of borrow receipts that have not been updated to "borrowing" within 2 days to "canceled".';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Calculate the cutoff date
        $cutoffDate = Carbon::now()->subDays(2);

        // Find and update borrow receipts where the status is not "borrowing" and created before the cutoff date
        $updatedCount = BorrowReceipt::where('status', '!=', 'borrowing')
            ->where('created_at', '<=', $cutoffDate)
            ->update(['status' => 'canceled']);

        $this->info("Updated $updatedCount borrow receipts to 'canceled'.");
        return 0;
    }
}
