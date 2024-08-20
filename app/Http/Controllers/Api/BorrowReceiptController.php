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
        return Inertia::render('BorrowReceipts', [
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
        return Inertia::render('BorrowReceiptDetail', [
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

        return redirect()->route('borrow-receipts.index')->with('success', 'Borrow receipt created successfully.');
    }

    /**
     * Update the specified borrow receipt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('borrow-receipts.index')->with('error', 'Unauthorized.');
        }

        $borrowReceipt = BorrowReceipt::findOrFail($id);

        $validated = $request->validate([
            'receipt_id' => 'required|string',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
            'return_date' => 'nullable|date',
            'status' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $borrowReceipt->update($validated);

        return redirect()->route('borrow-receipts.index')->with('success', 'Borrow receipt updated successfully.');
    }

    /**
     * Remove the specified borrow receipt.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('borrow-receipts.index')->with('error', 'Unauthorized.');
        }

        $borrowReceipt = BorrowReceipt::findOrFail($id);
        $borrowReceipt->delete();

        return redirect()->route('borrow-receipts.index')->with('success', 'Borrow receipt deleted successfully.');
    }
}
