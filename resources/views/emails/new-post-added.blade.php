@component('mail::message')
# Introduction

This is just a simple example of the laravel command to send email
With the title : {{ $title }}
Content : {{ $content }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent