<x-mail::message>
# Nouveau message de contact

**Nom :** {{ $data['lastname'] }}
**Prénom :** {{ $data['firstname'] }}
**E-mail :** {{ $data['email'] }}
**Sujet :** {{ $data['subject'] }}

{{ $data['message'] }}

Cordialement,
{{  config('app.name')  }}
</x-mail::message>