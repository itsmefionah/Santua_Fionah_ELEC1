<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | Add</title>
</head>
<body style="background-color: #f0f2f5; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div style="width: 90%; max-width: 400px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: #007bff;">Add Student</h2>
        <form action="/create" method="post" style="display: flex; flex-direction: column; gap: 15px;">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <label for="stud_name" style="font-weight: bold;">Name</label>
            <input type='text' id='stud_name' name='stud_name' required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 94%;">
            <input type='submit' value="Add Student" style="background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
        </form>
    </div>
</body>
</html>
