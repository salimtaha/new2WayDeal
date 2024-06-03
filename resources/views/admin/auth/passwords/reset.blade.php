@extends('admin.layouts.app')
@section('title' , 'اعاده تعيين كلمه السر')

@section('body')
<div class="container">
    <h1>  اعاده تعيين كلمه السر</h1>

    <form action="{{ route('admin.password.reset') }}" method="post">
        @csrf
      <div class="form-group">
        <label for="code"> أدخل كلمه السر الجديده  :</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <div class="text-danger errorAlert" id="errorAlert">
                {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
      <label for="code"> تاكيد كلمه السر الجديده  :</label>
      <input type="password" id="password" name="password_confirmation" required>
      @error('password_confirmation')
      <div class="text-danger" id="errorAlert">
          {{ $message }}
      </div>
  @enderror
    </div>

      <input type="hidden" name="email" value="{{ $email }}">
      <div class="form-group">
        <button type="submit" class="btn"> تحديث رمز المرور</button>
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
