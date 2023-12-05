<!DOCTYPE html>
<html>
<head>
    <title>Withdraw</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: blue;
        }
        form {
            background-color: #fff;
            padding: 100px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: darkgreen;
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
    </style>
</head>
<body>
    <a href="{{ route('user.dashboard') }}" class="dashboard-button">Go to Dashboard</a>
    <h1>Deposit</h1>
    <form action="{{ route('show.deposit.form') }}" method="get">
        @csrf
        <label for="account_number">Account Number:</label><br>
        <input type="text" id="account_number" name="account_number"><br>
        <label for="amount">Amount:</label><br>
        <input type="number" id="amount" name="amount" min="0.01" step="10"><br>
        <input type="submit" value="Deposit">
    </form>
</body>
</html>