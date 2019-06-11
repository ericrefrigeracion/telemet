@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => 'sysnet.com.ar'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
