<x-mail::message>
# Sua Dúvida foi Respondida!

Dúvida: {{ $reply->support['subject'] }}

Resposta: {{ $reply->content }} <br>
De: {{ $reply->user['name'] }}

<x-mail::button :url="route('replies.index', $reply->support['id'])">
Ver
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
