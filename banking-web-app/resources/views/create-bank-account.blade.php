<!DOCTYPE html>
<html>
<head>
    <title>Create Bank Account</title>
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
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: blue
        }
        label, select, input[type="submit"] {
            display: block;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background: #007BFF;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Create a New Bank Account</h1>
    <form action="/user/create-bank-account" method="post">
        @csrf
        <label for="currency">Currency:</label><br>
        <select name="currency" id="currency">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="LBP">LBP</option>
        </select><br>
        <input type="submit" value="Create Account">
    </form>
</body>
</html>