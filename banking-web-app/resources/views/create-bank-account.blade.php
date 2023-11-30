<!DOCTYPE html>
<html>
<head>
    <title>Create Bank Account</title>
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