<!DOCTYPE html>
<html>
<head>
    <title>Accounts</title>
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
    </style>
</head>
<body>
    @if ($accounts->count())
        <h1>Your Accounts</h1>
        <table>
            <thead>
                <tr>
                    <th>Account Number</th>
                    <th>Balance</th>
                    <th>Currency</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->account_number }}</td>
                        <td>{{ $account->balance }}</td>
                        <td>{{ $account->currency }}</td>
                        <td>{{ $account->created_at }}</td>
                        <td style="color: 
                            {{ $account->status == 'pending' ? '#DAA520' : 
                            ($account->status == 'active' ? '#32CD32' : 
                            ($account->status == 'blocked' ? 'red' : 'black')) 
                            }}">
                            {{ $account->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ $accounts->links() }}
    @else
    <p>You have no bank accounts.</p>
    @endif
</body>
</html>