<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;


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

    /**
     * Create a bank account for user by admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUserAccountByAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|',
            'currency' => 'required|in:USD,EUR,LBP',
        ]);
    
        $user = User::where('name', $request->name)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
    
        $account = new Account;
        $account->user_id = $user->id;
        $account->currency = $request->currency;
        $account->balance = 0;
        $account->status = 'active';
    
        // Generate a random 10-digit account number
        $account->account_number = rand(1000000000, 9999999999);
    
        $account->save();
    
        return redirect()->route('show.user.accounts', ['user' => $user->id])->with('success', 
                                 'Account created successfully.');
    }

    /**
     * Approve/reject account creation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveAccount(Request $request, $id)
    {
        $account = Account::find($id);

        if ($request->action == 'Approve') {
            $account->status = 'active';
        } elseif ($request->action == 'Reject') {
            $account->status = 'blocked';
        }

        $account->save();

        return redirect()->back()->with('success', 'Action performed successfully.');
    }

    /**
     * Block users by admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function block($id)
    {
        $user = User::find($id);
        $user->status = 'inactive';
        $user->save();

        return redirect()->back()->with('success', 'User blocked successfully.');
    }

    /**
     * Unblock users by admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function unblock($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->save();

        return redirect()->back()->with('success', 'User unblocked successfully.');
    }
}