<!DOCTYPE html>
<html>
<head>
    <title>{{ $user->name }}'s Transactions</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: blue;
        }
        table {
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        p {
            color: #333;
            font-size: 1.2em;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            width: 80%;
            margin: 0 auto;
        }
        .dashboard-button {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .dashboard-button:hover {
            background-color: darkgreen;
        }
        .users-button {
            position: absolute;
            top: 50px;
            left: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .users-button:hover {
            background-color: darkgreen;
        }
        .block-button {
            color: white;
            background-color: red;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .block-button:hover {
            background-color: darkred;
        }
        .unblock-button {
            color: white;
            background-color: #4CAF50;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .unblock-button:hover {
            background-color: darkgreen;
        }
        .approve-button {
            color: white;
            background-color: #4CAF50;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .approve-button:hover {
            background-color: darkgreen;
        }
        .reject-button {
            color: white;
            background-color: red;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .reject-button:hover {
            background-color: darkred;
        }
        .back-button {
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
            float: left;
        }
        .back-button:hover {
            background-color: #ddd;
        }
        .filter-form {
            position: absolute;
            top: 3%;
            left: 60%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .filter-form input, .filter-form select {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            flex: 1;
        }
        .filter-form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            flex-shrink: 0;
        }
        .filter-form button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <a href="{{ route('admin.dashboard') }}" class="dashboard-button">Go to Dashboard</a>
    <a href="{{ route('show.users') }}" class="users-button">Back to Users</a>
    <form class="filter-form" action="{{ route('show.user.transactions', $user->id) }}" method="get">
        <input type="text" name="account_number" placeholder="Account Number">
        <input type="date" name="timestamp" placeholder="Timestamp">
        <select name="transaction_type">
            <option value="">All</option>
            <option value="deposit">Deposit</option>
            <option value="withdraw">Withdraw</option>
            <option value="transfer">Transfer</option>
        </select>
        <button type="submit">Search</button>
    </form>
    @if ($transactions->count())
        <h1><a href="{{ route('show.user.accounts', $user->id) }}" class="back-button"><</a>&nbsp;&nbsp;{{ $user->name }}'s Transactions</h1>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>From Account</th>
                    <th>To Account</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->transaction_type }}</td>
                        <td>{{ $transaction->fromAccount ? $transaction->fromAccount->account_number : 'N/A' }}</td>
                        <td>{{ $transaction->toAccount ? $transaction->toAccount->account_number : 'N/A' }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{ $transactions->links() }}
    @else
    <p>{{ $user->name }} hasn't made any transactions.</p>
    @endif
</body>
</html>