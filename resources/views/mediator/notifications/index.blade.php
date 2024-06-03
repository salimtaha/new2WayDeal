@extends('mediator.layouts.app')
@section('title' , 'الاشعارات')

@section('body')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notification Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    /* Custom CSS */
    .notification {
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 15px;
      background-color: #fff; /* Optional: Change background color */
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h1 class="mb-4">Notifications</h1>
  <div id="notifications">
    <div class="notification d-flex justify-content-between align-items-center">
        <div>gflpgfpgfpgfpg</div><p>2003-2-3</p>
        <button class="btn btn-outline-danger btn-sm delete-notification"><i class="fas fa-trash"></i> Delete</button>
      </div>
      <div class="notification d-flex justify-content-between align-items-center">
        <div>gflpgfpgfpgfpg</div>
        <button class="btn btn-outline-danger btn-sm delete-notification"><i class="fas fa-trash"></i> Delete</button>
      </div>
      <div class="notification d-flex justify-content-between align-items-center">
        <div>gflpgfpgfpgfpg</div>
        <button class="btn btn-outline-danger btn-sm delete-notification"><i class="fas fa-trash"></i> Delete</button>
      </div>
  </div>
</div>

</body>
</html>

@endsection
