@component('mail::message')
# Introduction

This is just a simple example of the laravel command to send email

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent