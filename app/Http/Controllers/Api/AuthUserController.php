<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    public function auth(Request $request)
    {
        $validatedData = $request->validate([
            'email'       => 'required',
            'password'    => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['mensagem' => 'Credenciais inválidas'], 422);
        }

        $token = $user->createToken($request->device_name);

        return response()->json(['token' => $token->plainTextToken]);
    }

    public function me(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        // Revoke current token...
        $request->user()->currentAccessToken()->delete();

        return response()->json([], 204);
    }

    // public function forgot(Request $request)
    // {
    //     $user = User::with('company')->where('email', $request->email)->first();

    //     if(!$user) {
    //         return response()->json(['mensagem' => 'Favor verificar sua caixa de e-mail, caso esteja cadastrado enviaremos o link de redefinição de senha!']);
    //     }

    //     $resetPasswordToken = (string) Str::uuid();

    //     $user->update([
    //         'token' => $resetPasswordToken,
    //         'email_verified_at' => date('Y-m-d H:i')
    //     ]);

    //     try {

    //         $mailer = app(Mailer::class);
    //         $currentTransport = $mailer->getSymfonyTransport();
    //         $mailer->setSymfonyTransport(
    //             Transport::fromDsn("smtp://{$user->company->sender_username}:{$user->company->sender_password}@{$user->company->sender_host}:{$user->company->sender_port}")
    //         );

    //         Mail::to($user->email)->send(new ResetPasswordNotification($resetPasswordToken, $user));

    //         return response()->json(['mensagem' => 'Favor verificar sua caixa de e-mail, caso esteja cadastrado enviaremos o link de redefinição de senha!']);
    //     } catch(Exception $e) {

    //         Log::info('Erro ao enviar e-mail de reset password [AuthUserController - forgot]', [
    //             'message' => $e->getMessage(),
    //             'code'    => $e->getCode(),
    //             'error'   => null,
    //         ]);

    //         return response()->json(['mensagem' => 'Erro ao enviar e-mail de reset password'], 500);
    //     }
    // }

    // public function reset(Request $request, $token)
    // {
    //     $validate = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('token', $token)
    //                     ->where('email', $request->email)
    //                     ->first();

    //     if(!$user) {
    //         return response()->json(['mensagem' => 'Não conseguimos encontrar um usuário com esse endereço de email.'], 422);
    //     }

    //     if(Carbon::create($user->email_verified_at)->addMinutes(60) <= Carbon::now()) {
    //         return response()->json(['mensagem' => 'Tempo permitido para redefinir senha já expirado!'], 422);
    //     }

    //     $user->update([
    //         'password' => bcrypt($request->password)
    //     ]);

    //     return response()->json(['mensagem' => 'Senha atualizada com sucesso!']);
    // }
}
