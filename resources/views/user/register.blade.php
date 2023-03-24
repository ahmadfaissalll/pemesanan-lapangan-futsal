<x-user.layout :title="'Register {{ $role === 2 ? 'Customer' : 'Admin' }}'">
    <div class="container">
        <div class="form">
            <div class="col-lg-7">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Register {{ $role === 2 ? 'Customer' : 'Admin' }}</h1>
                    </div>

                    <form class="form-horizontal" method="post" action="{{ $role === 2 ? '/register' : '/register-admin' }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="username" class="form-control" id="username" placeholder="Username"
                                        value="{{ old('username') }}" name="username">
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder="Nama"
                                        value="{{ old('name') }}" name="name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        value="{{ old('email') }}" name="email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Password
                                    Confirm</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Password Confirmation" name="password_confirmation">
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <p>Sudah punya akun? <a href="{{ $role === 2 ? '/login' : '/login-admin' }}">Masuk</a></p>
                        </div>

                        <div class="card-footer">
                            <input type="hidden" name="role" value="{{ $role }}">
                            <button type="submit" class="btn btn-info">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-user.layout>
