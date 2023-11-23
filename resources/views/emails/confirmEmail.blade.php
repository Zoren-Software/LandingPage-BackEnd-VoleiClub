<x-mail::message>
# {{ trans('Leads.confirm_e-mail')}}

{{ trans("Leads.hello")}} {{ $lead->name }},

{{ trans("Leads.email_confirm_text_1")}} {{ env('APP_NAME') }}! 

{{ trans("Leads.email_confirm_text_2")}}

## {{ trans("Leads.email_confirm_text_3")}}

{{ trans("Leads.email_confirm_text_4")}}

{{ trans("Leads.email_confirm_text_5")}}

{{ trans("Leads.email_confirm_text_6")}}

## {{ trans("Leads.email_confirm_text_7")}}

{{ trans("Leads.email_confirm_text_8")}}

<x-mail::button :url="$url">
{{ trans('Leads.button_confirm_e-mail')}}
</x-mail::button>

{{ trans("Leads.email_signature") }}<br>
{{ trans("Leads.email_signature_2") }}<br>

</x-mail::message>