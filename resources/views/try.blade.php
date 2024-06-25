<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="{{ route('scout.send') }}" method="POST" style="margin-top: 3%" >
    @csrf
    <div class ="mb-3">
        <label for="message" class="form-label">Phone Number</label>
        <input type="tel" class="form-control "
        name="phone" value="0176059047"
        required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="3" required>You are scouted by {{ auth('staff')->user()->name }}.</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Scout</button>
</form>
</body>
</html>

