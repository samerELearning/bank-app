
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to the User Dashboard</h1>
    <ul>
        <li><a href="{{ route('create-account') }}">Create Bank Account</a></li>
        <li><a href="{{ route('view-accounts') }}">View Bank Accounts</a></li>
        <li><a href="{{ route('transactions') }}">Transactions</a></li>
        <li><a href="{{ route('withdraw') }}">Withdraw</a></li>
        <li><a href="{{ route('deposit') }}">Deposit</a></li>
        <li><a href="{{ route('transfer') }}">Transfer</a></li>
        <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
</body>
</html>
