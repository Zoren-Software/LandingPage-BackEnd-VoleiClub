<x-mail::message>
# {{ trans('Leads.confirm_e-mail')}}

{{ trans("Leads.hello")}} {{ $lead->name }},

{{ trans("Leads.email_confirmation_thanks")}}

## {{ trans("Leads.email_confirmation_title_1")}}

{{ trans("Leads.email_confirmation_text_1")}}

## {{ trans("Leads.email_confirmation_title_2")}}

{{ trans("Leads.email_confirmation_text_2")}}

## {{ trans("Leads.email_confirmation_title_3")}}

{{ trans("Leads.email_confirmation_text_3")}}

## {{ trans("Leads.email_confirmation_title_4")}}

{{ trans("Leads.email_confirmation_text_4")}}


{{ trans("Leads.email_signature") }}<br>
{{ trans("Leads.email_signature_2") }}<br>
</x-mail::message>