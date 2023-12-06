<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
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
    </style>
</head>
<body>
    <a href="{{ route('admin.dashboard') }}" class="dashboard-button">Go to Dashboard</a>
    @if ($users->count())
        <h1>Users</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered on</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="">{{ $user->name }}</a></td>
                        <td>{{ $user->role }}</td>
                        <td style="color: 
                            {{ $user->status == 'pending' ? '#DAA520' : 
                            ($user->status == 'active' ? '#32CD32' : 
                            ($user->status == 'inactive' ? 'red' : 'black')) 
                            }}">
                            {{ $user->status }}
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>@if ($user->status == 'active')
                                <form action="" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Block" class="block-button">
                                </form>
                            @elseif ($user->status == 'inactive')
                                <form action="" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Unblock" class="unblock-button">
                                </form>
                            @endif
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{ $users->links() }}
    @else
    <p>There are no users.</p>
    @endif
</body>
</html>