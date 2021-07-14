@component('mail::message')
# Introduction

## weclome email test

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thank you ,<br>
{{ config('app.name') }}
@endcomponent
