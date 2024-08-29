@extends('_layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <div class="max-w-lg w-full bg-white border p-6">
        <form action="{{ route('login.request') }}" class="space-y-6" method="post">
            <div>
                @csrf
                <div class="space-y-1">
                    <h1 class="text-xl font-semibold">Login</h1>
                    <p class="text-sm text-gray-500">Welcome back! Please enter your details</p>
                </div>
            </div>

            <div class="space-y-3">
                <div class="tw-form-group @error('email') tw-form-input-error @enderror">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="tw-form-control" value="{{ old('email') }}"
                        placeholder="Enter e-mail" />
                    <small class="tw-form-error-text">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </small>
                </div>

                <div class="tw-form-group @error('password') tw-form-input-error @enderror">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="tw-form-control"
                        placeholder="Enter password" />
                    <small class="tw-form-error-text">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>

            <button class="tw-btn bg-sky-500 text-white">
                <span>login</span>
            </button>
        </form>
    </div>
@endsection
