<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Perform a withdrawal transaction for clients.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientWithdraw(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:0',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }

        $account = Account::where('account_number', $request->account_number)
                  ->where('user_id', Auth::id())
                  ->first();

        if (!$account) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }
        if ($account->status == 'pending') {
            return redirect()->back()->with(['error' => 'This account is still pending approval.']);
        }
        if ($account->status == 'blocked') {
            return redirect()->back()->with(['error' => 'This account has been blocked.']);
        }
        if ($account->balance < $request->amount) {
            return redirect()->back()->with(['error' => 'Insufficient balance.']);
        }

        $account->balance -= $request->amount;
        $account->save();

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'withdraw';
        $transaction->user_id = $account->user_id;
        $transaction->from_account_id = $account->id;
        $transaction->save();

        return redirect('/user/show-transaction-history')->with('success', 'Withdrawal successful.');
    }

    /**
     * Perform a deposit transaction for clients.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientDeposit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:0',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }

        $account = Account::where('account_number', $request->account_number)
                  ->where('user_id', Auth::id())
                  ->first();

        if (!$account) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }
        if ($account->status == 'pending') {
            return redirect()->back()->with(['error' => 'This account is still pending approval.']);
        }
        if ($account->status == 'blocked') {
            return redirect()->back()->with(['error' => 'This account has been blocked.']);
        }

        $account->balance += $request->amount;
        $account->save();

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'deposit';
        $transaction->user_id = $account->user_id;
        $transaction->to_account_id = $account->id;
        $transaction->save();

        return redirect('/user/show-transaction-history')->with('success', 'Deposit successful.');
    }

    /**
     * Perform a transfer transaction for clients.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientTransfer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'from_account_number' => 'required|exists:accounts,account_number',
            'to_account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:0',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }

        $from_account = Account::where('account_number', $request->from_account_number)
                  ->where('user_id', Auth::id())
                  ->first();

        if (!$from_account) {
            return redirect()->back()->with(['error' => 'First account not found.']);
        }
        if ($from_account->status == 'pending') {
            return redirect()->back()->with(['error' => 'First account is still pending approval.']);
        }
        if ($from_account->status == 'blocked') {
            return redirect()->back()->with(['error' => 'First account has been blocked.']);
        }
        if ($from_account->balance < $request->amount) {
            return redirect()->back()->with(['error' => 'Insufficient balance in first account.']);
        }

        $to_account = Account::where('account_number', $request->to_account_number)
                  ->first();

        if (!$to_account) {
            return redirect()->back()->with(['error' => 'Second account not found.']);
        }
        if ($to_account->status == 'pending') {
            return redirect()->back()->with(['error' => 'Second account is still pending approval.']);
        }
        if ($to_account->status == 'blocked') {
            return redirect()->back()->with(['error' => 'Second account has been blocked.']);
        }

        $from_account->balance -= $request->amount;
        $from_account->save();

        $to_account->balance += $request->amount;
        $to_account->save();

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'transfer';
        $transaction->user_id = $from_account->user_id;
        $transaction->from_account_id = $from_account->id;
        $transaction->to_account_id = $to_account->id;
        $transaction->save();

        return redirect('/user/show-transaction-history')->with('success', 'Transfer successful.');
    }
}