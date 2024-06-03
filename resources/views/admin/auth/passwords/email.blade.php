@extends('admin.layouts.app')

@section('title' , ' البريدالالكتروني')

@section('body')

  <div class="container">
    <h1>نسيت كلمه السر</h1>
    <p>أدخل عنوان بريدك الإلكتروني أدناه لتلقي رمز إعادة تعيين كلمة المرور.</p>
    <form action="{{ route('admin.password.send.verfication.code') }}" method="post">
        @csrf
      <div class="form-group">
        <label for="email"> البريد الالكتروني:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn">نسيت كلمه السر</button>
      </div>
    </form>
  </div>

@endsection

@push('css')
<style>
    body {
      align-items: center;
      min-height: 100vh;
      background-color: #f8f8f8;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 400px;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h1 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
    }

    .container p {
      font-size: 14px;
      color: #888;
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>

@endpush
