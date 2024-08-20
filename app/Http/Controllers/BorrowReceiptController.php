<?php

namespace App\Http\Controllers;

use App\Http\Resources\BorrowReceiptResource;
use App\Models\BorrowReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BorrowReceiptController extends Controller
{
    /**
     * Display a listing of all borrow receipts.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Load related data if needed
        $borrowReceipts = BorrowReceipt::with(['user', 'receiptDetails'])->get();
        return Inertia::render('BorrowReceipt/Index', [
            'borrowReceipts' => BorrowReceiptResource::collection($borrowReceipts),
        ]);
    }

    /**
     * Display the details of a single borrow receipt.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $borrowReceipt = BorrowReceipt::with(['user', 'receiptDetails'])->findOrFail($id);
        return Inertia::render('BorrowReceipt/Show', [
            'borrowReceipt' => new BorrowReceiptResource($borrowReceipt),
        ]);
    }

    /**
     * Store a newly created borrow receipt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receipt_id' => 'required|string',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
            'return_date' => 'nullable|date',
            'status' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        BorrowReceipt::create($validated);

        return redirect()->route('borrow-receipt.index')->with('success', 'Borrow receipt created successfully.');
    }

    /**
     * Remove the specified borrow receipt.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function destroy($id)
    {
        $borrowReceipt = BorrowReceipt::findOrFail($id);

        if ($borrowReceipt->status === 'pending') {
            // Iterate over each receipt detail to update book availability
            foreach ($borrowReceipt->receiptDetails as $detail) {
                $book = $detail->book;
                if ($book) {
                    $book->available += $detail->quantity; // Assuming quantity field in ReceiptDetail
                    $book->save();
                }
            }

            // Delete the borrow receipt
            $borrowReceipt->delete();

            return redirect()->route('borrow-receipt.index')->with('success', 'Borrow receipt deleted successfully.');
        }

        return redirect()->route('borrow-receipt.index')->with('error', 'Cannot delete borrow receipt. Only pending receipts can be deleted.');
    }
}
