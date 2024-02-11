<x-mail::message>
# Dear {{ $user->full_name }},

This is a friendly reminder that you have an upcoming appointment today {{ $appointment->appointment_date }}.

The reason is :
{{ $appointment->reason }}

Please remember to bring any relevant medical documents or test results with you to the appointment.

Best regards,<br>
{{ config('app.name') }}
</x-mail::message>x
