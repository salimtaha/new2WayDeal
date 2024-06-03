@extends('admin.auth.layouts.app')
@section('title' , 'رمز التحقق')
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
                    <form action="{{ route('charities.password.check.otp.outside') }}" method="post">
                        @csrf
                        <!-- username -->
                        <div class="mb-4">
                            <label for="forUsername" class="block text-sm font-semibold mb-2 text-gray-600 flex justify-center gap-2 items-center ">رمز التحقق </label>
                            <input type="text" id="forUsername"  name="code"
                                class="@error('code') is-invalid @enderror py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 "
                                aria-describedby="hs-input-helper-text">
                            @error('code')
                                <span id="errorAlert" class="text-danger" style="color: red">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" type="email" value="{{ $email }}" name="email" >


                        <!-- button -->
                        <div class="grid my-6">
                            <button type="submit"
                                class="btn py-[10px] text-base text-white font-medium hover:bg-blue-700">فحص رمز التحقق </button>
                        </div>

                        <div class="flex justify-center gap-2 items-center">
                            <p class="text-base font-medium text-gray-500"> اكتب رمز الخاص المرسل اليك من فضلك</p>

                        </div>
                </div>
                </form>
            </div>
        </div>

        </div>
        <!--end of project-->
    </main>
@endsection
