<!DOCTYPE html>
<html>
<head>
    <title>Accounts</title>
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
                        <td>{{ $account->status }}</td>
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
