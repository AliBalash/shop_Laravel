<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserChangePassword extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
                'current_password' => 'required|',
                'password' => 'required|confirmed|min:8|different:current_password',
            ]);
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8|different:current_password',
        ]);
        if (Hash::check($this->current_password,Auth::user()->password)){
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->password);
            $user->save();
            session()->flash('success','Change Password Successfully.');
        }else{
            session()->flash('error','Change Password Not Successfully !!!');


        }
    }

    public function render()
    {
        return view('livewire.user.user-change-password');
    }
}
