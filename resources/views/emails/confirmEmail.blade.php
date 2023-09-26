<x-mail::message>
# Confirm E-mail
 
Please confirm your e-mail address by clicking the link below:
 
<x-mail::button :url="$url">
Confirm E-mail
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>