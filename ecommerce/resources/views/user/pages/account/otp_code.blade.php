@extends('user.user_master')
@section('user_content')

<!--section start-->
<section class="login-page section-big-py-space b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-lg-5 offset-lg-4">
                <div class="theme-card">
                    <h3 class="text-center">Verify Account</h3>
                    <p>We have send an OTP code in your phone. Please Verify your Account</p>
                    <form class="theme-form" action="{{ route('verify.otp') }}" method="POST">
                        @csrf
                                <input type="hidden" name="phone" maxlength='11' value="{{$dbPhone}}" id="phoneForOTP" >
                            
                            <div class="col-md-12 form-group">
                                <label ><span class="text-danger">*</span>Enter OTP</label>
                                <input type="text" class="form-control" id="" name="otp" placeholder="Enter your OTP" required>
                            </div>
                            
                            <div class="col-md-12 form-group"><button type="submit" class="btn btn-normal">Verify</button></div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12 ">
                                <p>OTP Not Matched? or Not Sent? <span style="cursor: pointer;" onclick="create_otp()" class="txt-default">Send Again</span></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

@endsection
