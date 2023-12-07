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
        /*$request->validate([
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:0',
        ]);*/

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

        return redirect('show.transaction.history')->with('success', 'Withdrawal successful.');
    }
}