<x-mail::message>
    مرحباً : {{ $data->name }}<br>
الرد علي موضوع : {{ $data->subject }}<br>

<p>
    {{ $data->message }}
</p>


<x-mail::button :url="''">
موقعنا
</x-mail::button>

شكرا,<br>
{{ config('app.name') }}
</x-mail::message>
