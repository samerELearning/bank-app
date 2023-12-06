<!DOCTYPE html>
<html>
<head>
    <title>Requests</title>
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
    </style>
</head>
<body>
    <a href="{{ route('admin.dashboard') }}" class="dashboard-button">Go to Dashboard</a>
    @if ($accounts->count())
        <h1>Requests</h1>
        <table>
            <thead>
                <tr>
                    <th>Account Number</th>
                    <th>Balance</th>
                    <th>Currency</th>
                    <th>Created At</th>
                    <th>Client</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    @if ($account->status == 'pending')
                        <tr>
                            <td>{{ $account->account_number }}</td>
                            <td>{{ $account->balance }}</td>
                            <td>{{ $account->currency }}</td>
                            <td>{{ $account->created_at }}</td>
                            <td>{{ $account->user->name }}</td>
                            <td>
                                <form action="" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Approve"
                                           style="background-color:#4CAF50;
                                                  color: white;
                                                  border: none;
                                                  padding: 5px 10px;
                                                  cursor: pointer;">
                                    <input type="submit" value="Reject"
                                           style="background-color:red;
                                                  color: white;
                                                  border: none;
                                                  padding: 5px 10px;
                                                  cursor: pointer;">
                                    
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    {{ $accounts->links() }}
    @else
    <p>You have no bank accounts.</p>
    @endif
</body>
</html>