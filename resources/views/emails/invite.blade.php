@component('mail::message')
You have been invited to join {{ config("app.name") }}, click in the link below to setup your account.

@component('mail::button', ['url' => env("FRONTEND_DOMAIN"). "/accept/". $invite->token])
Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
