
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome {{ Auth::user()->name}}</h1>
    <ul>
        <li><a href="">Create Bank Account</a></li>
        <li><a href="">My Bank Accounts</a></li>
        <li><a href="">My Transactions</a></li>
        <li><a href="">Withdraw</a></li>
        <li><a href="">Deposit</a></li>
        <li><a href="">Transfer</a></li>
        <li><a href="">Logout</a></li>
    </ul>
</body>
</html>
