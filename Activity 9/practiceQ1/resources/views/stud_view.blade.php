<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Records</title>
</head>
<body style="background-color: #f0f2f5; font-family: Arial, sans-serif; margin: 20px; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="width: 90%; max-width: 700px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h2 style="color: #007bff; margin: 0;">Student Records</h2>
            <a href="/insert" style="background-color: #28a745; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px; font-size: 14px;">Add Student</a>
        </div>

        @if (session('Success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">{{ session('Success') }}</div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 5px; overflow: hidden;">
                <thead>
                    <tr style="background-color: #007bff; color: white; text-align: left;">
                        <th style="padding: 10px;">ID</th>
                        <th style="padding: 10px;">Name</th>
                        <th style="padding: 10px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;">{{ $user->id }}</td>
                        <td style="padding: 10px;">{{ $user->name }}</td>
                        <td style="padding: 10px; text-align: center;">
                            <a href="/edit/{{ $user->id }}" style="background-color: #ffc107; color: black; padding: 5px 8px; text-decoration: none; border-radius: 3px; font-size: 13px;">Edit</a>
                            <a href="/delete/{{ $user->id }}" style="background-color: #dc3545; color: white; padding: 5px 8px; text-decoration: none; border-radius: 3px; font-size: 13px; margin-left: 5px;">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>