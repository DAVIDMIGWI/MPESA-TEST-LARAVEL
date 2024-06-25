<!DOCTYPE html>
<html>
<head>
    <title>M-Pesa STK Push</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: rgba(241, 15, 5, 10.9);
            padding: 210px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="/mpesa/stkpush" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" pattern="254\d{9}" placeholder="254XXXXXXXXX" title="Phone number must start with 254 and be followed by 9 digits." required><br><br>

        <label for="reference">Reference:</label>
        <input type="text" id="reference" name="reference" required><br><br>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
