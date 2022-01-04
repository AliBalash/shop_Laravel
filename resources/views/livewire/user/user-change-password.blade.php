@section('title')Change Password @endsection
@if(session()->has('success'))
    <div class="mt-10 alert alert-success">
        {{Session::get('success')}}
    </div>
@elseif(session()->has('success'))
    <div class="mt-10 alert alert-danger">
        {{Session::get('success')}}
    </div>
@endif
<div class="row mt-10">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
        <div class=" main-content-area">
            <div class="wrap-login-item ">
                <div class="login-form form-item form-stl">

                    <form wire:submit.prevent="changePassword()">
                        <fieldset class="wrap-title">
                            <h3 class="form-title">Change Your Password</h3>
                        </fieldset>
                        <fieldset class="wrap-input">
                            <label for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password"
                                   placeholder="Type your Current Password" wire:model="current_password">
                            @error('current_password') <span class="error">{{$message}}</span> @enderror
                        </fieldset>
                        <fieldset class="wrap-input">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password" placeholder="New Password"
                                   wire:model="password">
                            @error('password') <span class="error">{{$message}}</span> @enderror
                        </fieldset>

                        <fieldset class="wrap-input">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   placeholder="password confirmation" wire:model="password_confirmation">
                            @error('current_password') <span class="error">{{$message}}</span> @enderror
                        </fieldset>


                        <input type="submit" class="btn btn-submit" value="Change" name="submit">
                    </form>
                </div>
            </div>
        </div><!--end main products area-->
    </div>
</div><!--end row-->

</div><!--end container-->
