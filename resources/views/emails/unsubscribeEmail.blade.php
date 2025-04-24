<x-mail::message>
# {{ trans('Leads.unsubscribe_e-mail')}}

{{ trans("Leads.hello")}} {{ $lead->name }},

{{ trans("Leads.email_unsubscribe_text_1")}} {{ env('APP_NAME') }}! 

{{ trans("Leads.email_unsubscribe_text_2")}}

## {{ trans("Leads.email_unsubscribe_text_3")}}

{{ trans("Leads.email_unsubscribe_text_4")}}

<x-mail::button :url="$url">
{{ trans('Leads.button_unsubscribe_e-mail')}}
</x-mail::button>

{{ trans("Leads.email_signature") }}<br>
{{ trans("Leads.email_signature_2") }}<br>

</x-mail::message>