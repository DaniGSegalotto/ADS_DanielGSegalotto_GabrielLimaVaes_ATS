@component('mail::message')
# Recuperação de senha

Clique no botão abaixo para redefinir sua senha:

@component('mail::button', ['url' => $url])
Redefinir senha
@endcomponent

Se você não solicitou a mudança, ignore este e-mail.

@endcomponent
