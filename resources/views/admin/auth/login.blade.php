@extends('admin.auth.layouts.app')
@section('title', 'Login')
@section('body')
    <main>
        <!-- Main Content -->
        <div
            class="flex flex-col w-full  overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">

            <div class="justify-center items-center w-full card lg:flex max-w-md ">
                <div class=" w-full card-body">
                    <img src="{{ asset('login.png') }}" width="170px" alt="" class="mx-auto" />
                    <!-- form --><br>
                    <form action="{{ route('admin.check') }}" method="post">
                        @csrf
                        <div class="flex justify-center gap-2 items-center">
                            <p class="text-base font-medium text-gray-500">الادمن</p>

                        </div>
                        <!-- username -->
                        <div class="mb-4">
                            <label for="forUsername" class="block text-sm font-semibold mb-2 text-gray-600">البريد
                                الالكتروني</label>
                            <input type="text" id="forUsername" name="email" value="{{ old('email') }}"
                                class="@error('email') is-invalid @enderror py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 "
                                aria-describedby="hs-input-helper-text">
                            @error('email')
                                <span id="errorAlert" class="text-danger" style="color: red">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- password -->
                        <div class="mb-6">
                            <label for="forPassword" class="block text-sm font-semibold mb-2 text-gray-600">كلمه
                                المرور</label>
                            <input type="password" id="forPassword" name="password"
                                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 "
                                aria-describedby="hs-input-helper-text">
                            @error('password')
                                <span id="errorAlert" class="text-danger" style="color: red">
                                    <p class="text-danger">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-6" style="margin-left: 50px">
                            {!! NoCaptcha::display() !!}
                        </div>
                        <div class="mb-6 flex justify-center gap-2 items-center">
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block ">
                                <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                        </div>
                        <!-- checkbox -->
                        <div class="flex justify-between">
                            <div class="flex">
                                <input type="checkbox"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded-[4px] text-blue-600 focus:ring-blue-500 "
                                    name="remember" id="remember"{{ old('remember') ? 'checked' : '' }}>
                                <label for="hs-default-checkbox" class="text-sm text-gray-600 ms-3">تذكرني</label>
                            </div>


                            <a href="{{ route('admin.password.forgot.outside') }}"
                                class="text-sm font-medium text-blue-600 hover:text-blue-700">نسيت كلمه المرور
                                ?</a>
                        </div>
                        <!-- button -->
                        <div class="grid my-6">
                            <button type="submit"
                                class="btn py-[10px] text-base text-white font-medium hover:bg-blue-700">تسجيل
                                الدخول</button>
                        </div>


                </div>
                </form>
            </div>
        </div>

        </div>
        <!--end of project-->
    </main>
@endsection

@push('js')
    {!! NoCaptcha::renderJs() !!}
@endpush
