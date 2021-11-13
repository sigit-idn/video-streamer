@extends('templates.dashboard')
@section('title')
    Account Settings
@endsection

@section("dashboard-main")
<div class="container mb-5 px-0">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column p-3 py-5">
                {{-- <img class="rounded-circle mt-5"
                    width="150px"
                    src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"> --}}
                    <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                    <span class="text-black-50">{{ Auth::user()->email }}</span>
                    <span> </span>
                </div>
        </div>
        <div class="col-md-8 border-right">
            <form method="post" action="/dashboard/account" class="p-3 py-5">
                @csrf
                @method("put")
                {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>{} --}}
                    <div ><label class="labels mt-2">Name</label>
                        <input required type="text" class="form-control @error("name") is-invalid @enderror" name="name" placeholder="Name" value="{{ Auth::user()->name }}">
                        @error("name")
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="labels mt-2">Email</label>
                        <input required type="email"
                            class="form-control @error("email") is-invalid @enderror" name="email" placeholder="Enter email address" value="{{ Auth::user()->email }}">
                            @error("email")
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                    <div class="col-md-12">
                    <div class="col-md-12">
                        <label class="labels mt-2">Username</label>
                        <input required type="text"
                            class="form-control @error("username") is-invalid @enderror" name="username" placeholder="Enter username" value="{{ Auth::user()->username }}">
                            @error("username")
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        <label class="labels mt-2">Password</label>
                        <input type="password"
                        class="form-control @error("password") is-invalid @enderror" name="password" placeholder="Enter new password">
                            @error("password")
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <label class="labels mt-2">Mobile Number</label>
                        <input type="text"
                            class="form-control @error("phone") is-invalid @enderror" name="phone" placeholder="Enter phone number" value="{{ Auth::user()->phone }}">
                            @error("phone")
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                    <div class="col-md-12">
                        <label class="labels mt-2">Address</label>
                        <textarea type="text"
                        class="form-control @error("address") is-invalid @enderror" name="address" placeholder="Enter address line">{{ Auth::user()->address }}</textarea>
                            @error("address")
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                        Profile</button></div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
