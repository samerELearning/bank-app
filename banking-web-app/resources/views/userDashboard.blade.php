
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-left: 20px; /* Add padding to the left of the body */
        }
        h1 {
            color: blue;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            color: green;
            text-decoration: none;
        }
        a:hover {
            color: black;
        }
        button {
            color: white;
            background-color: #32CD32;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <h1>Welcome {{ Auth::user()->name}}</h1>
    <ul>
        <li><a href="{{ route('create.bank.account') }}">Create Bank Account</a></li>
        <li><a href="{{ route('show.bank.accounts') }}">My Bank Accounts</a></li>
        <li><a href="{{ route('show.transaction.history') }}">My Transactions</a></li>
        <li><a href="{{ route('show.withdraw.form') }}">Withdraw</a></li>
        <li><a href="{{ route('show.deposit.form') }}">Deposit</a></li>
        <li><a href="{{ route('show.transfer.form' }}">Transfer</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</body>
</html>
