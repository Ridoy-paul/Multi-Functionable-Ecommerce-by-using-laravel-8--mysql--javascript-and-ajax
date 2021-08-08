@extends('user.user_master')
@section('user_content')

<!--section start-->
<section class="login-page section-big-py-space b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-lg-5 offset-lg-4">
                <div class="theme-card">
                    <h3 class="text-center">Update Password</h3>
                    <form class="theme-form" action="{{ route('updatepass.step_one') }}" method="POST">
                        @csrf
                            <div class="col-md-12 form-group">
                                <label ><span class="text-danger">*</span>Email or Phone</label>
                                <input type="text" class="form-control" placeholder="Enter your email or phone" id="" name="userInfo"  required>
                            </div>
                            <div class="col-md-12 form-group"><button type="submit" class="btn btn-normal">Submit</button></div>
                        </div>
                        <div class="row g-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

@endsection
