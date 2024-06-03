@extends('admin.auth.layouts.app')
@section('title' , 'اعاده تعيين كلمه المرور')
@section('body')
    <main>
        <!-- Main Content -->
        <div
            class="flex flex-col w-full  overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">

            <div class="justify-center items-center w-full card lg:flex max-w-md ">
                <div class=" w-full card-body">
                   <img src="{{ asset('assets/images/logo.jpg') }}"
                          width="70px"  alt="" class="mx-auto" />
                    <!-- form --><br>
                    <form action="{{ route('admin.password.reset.outside') }}" method="post">
                        @csrf

                        <!-- password -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-semibold mb-2 text-gray-600">كلمه المرور</label>
                            <input type="password" id="password" name="password"
                                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 "
                                aria-describedby="hs-input-helper-text">
                            @error('password')
                                <span id="errorAlert" class="text-danger" style="color: red">
                                    <p class="text-danger">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        <!-- password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-semibold mb-2 text-gray-600">تاكيد كلمه المرور </label>
                            <input type="password_confirmation" id="password_confirmation" name="password_confirmation"
                                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 "
                                aria-describedby="hs-input-helper-text">
                            @error('password_confirmation')
                                <span id="errorAlert" class="text-danger" style="color: red">
                                    <p class="text-danger">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" value="{{ $email }}" name="email">


                        <!-- button -->
                        <div class="grid my-6">
                            <button type="submit"
                                class="btn py-[10px] text-base text-white font-medium hover:bg-blue-700">تاكيد  </button>
                        </div>


                        <div class="flex justify-center gap-2 items-center">
                            <p class="text-base font-medium text-gray-500"><a href="{{ route('admin.showLogin') }}">تسجيل الدخول</a> </p>

                        </div>
                </div>
                </form>
            </div>
        </div>

        </div>
        <!--end of project-->
    </main>
@endsection
