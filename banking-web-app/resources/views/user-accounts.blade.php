<!DOCTYPE html>
<html>
<head>
    <title>{{ Auth::user()->name}}'s Accounts</title>
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
        .users-button {
            position: absolute;
            top: 50px;
            left: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .users-button:hover {
            background-color: darkgreen;
        }
        .block-button {
            color: white;
            background-color: red;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .block-button:hover {
            background-color: darkred;
        }
        .unblock-button {
            color: white;
            background-color: #4CAF50;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .unblock-button:hover {
            background-color: darkgreen;
        }
        .approve-button {
            color: white;
            background-color: #4CAF50;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .approve-button:hover {
            background-color: darkgreen;
        }
        .reject-button {
            color: white;
            background-color: red;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }
        .reject-button:hover {
            background-color: darkred;
        }
        .next-button {
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
            float: right;
        }
        .next-button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <a href="{{ route('admin.dashboard') }}" class="dashboard-button">Go to Dashboard</a>
    <a href="{{ route('show.users') }}" class="users-button">Back to Users</a>
    @if ($accounts->count())
        <h1>{{ $user->name }}'s Accounts&nbsp;&nbsp;<a href="" class="next-button">></a></h1>
        <table>
            <thead>
                <tr>
                    <th>Account Number</th>
                    <th>Balance</th>
                    <th>Currency</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                        <td>@if ($account->status == 'active')
                                <form action="" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Block" class="block-button">
                                </form>
                            @elseif ($account->status == 'blocked')
                                <form action="" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Unblock" class="unblock-button">
                                </form>
                            @else
                                <form action="" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Approve" class="approve-button">
                                    <input type="submit" value="Reject" class="reject-button">
                                </form>
                            @endif
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{ $accounts->links() }}
    @else
    <p>{{ $user->name }} has no accounts.</p>
    @endif
</body>
</html>