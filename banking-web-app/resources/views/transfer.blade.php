<!DOCTYPE html>
<html>
<head>
    <title>Transfer</title>
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
            display: block;
            margin: auto;
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
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <a href="{{ route('user.dashboard') }}" class="dashboard-button">Go to Dashboard</a>
    <!-- Display the error message -->
    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    <h1>Transfer</h1>
    <form action="/user/transfer" method="post">
        @csrf
        <label for="from_account_number">From Account Number:</label><br>
        <input type="text" id="from_account_number" name="from_account_number"><br>
        <label for="to_account_number">To Account Number:</label><br>
        <input type="text" id="to_account_number" name="to_account_number"><br>
        <label for="amount">Amount:</label><br>
        <input type="number" id="amount" name="amount" min="0.01" step="0.01"><br>
        <input type="submit" value="Transfer">
    </form>
</body>
</html>