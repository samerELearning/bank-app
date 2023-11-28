
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
    </style>
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
