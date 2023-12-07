<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Create a bank account for user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUserAccount(Request $request)
    {
        $request->validate([
            'currency' => 'required|in:USD,EUR,LBP',
        ]);

        $account = new Account;
        $account->user_id = Auth::id();
        $account->currency = $request->currency;
        $account->balance = 0;

        // Generate a random 10-digit account number
        $account->account_number = rand(1000000000, 9999999999);

        $account->save();

        return redirect('/user/show-bank-accounts')->with('success', 
                        'Your account creation request has been submitted successfully. 
                         Please wait for an admin to approve it.');
    }
}