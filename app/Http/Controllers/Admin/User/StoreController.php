<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $password = Str::random(10);
        $data['password'] = Hash::make($password);

        User::firstOrCreate(['email' => $data['email']], $data);

        try {
            Mail::to($data['email'])->send(new PasswordMail($password));
            session()->flash('success', 'Пользователь создан. Проверьте Mailpit для просмотра письма.');
        } catch (\Exception $e) {
            session()->flash('error', 'Ошибка отправки: ' . $e->getMessage());
        }

        return redirect()->route('admin.user.index');
    }
}
