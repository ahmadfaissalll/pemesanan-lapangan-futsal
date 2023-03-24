<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    // only guest who can access
    return !auth()->check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(Request $request)
  {
    // role validation
    $role = $request->input('role');
    if ( !isset($role) || !in_array($role, [1, 2]) ) {
      return back()->withErrors(['username' => 'Ada yang salah coba reload halaman dan coba lagi']);
    }

    return [
      'username' => 'required',
      'email' => ['required', 'email', Rule::unique('users')],
      'name' => ['required', Rule::unique('users')],
      'password' => 'required|confirmed',
      'password_confirmation' => 'required',
      'role' => 'required|numeric',
    ];
  }
}
