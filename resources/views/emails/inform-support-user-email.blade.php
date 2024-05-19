<x-mail::message>
# New Pet Report: Urgent Assistance Needed

We wanted to inform you that a new report has been created regarding a pet in need of urgent assistance.

As a valued member of our support team, we kindly request your immediate attention to this matter.
Please review the details of the report at your earliest convenience and take necessary action to provide
assistance or coordinate appropriate help for the pet in need.

If you have any questions or require further information, please contact to {{ $contact_phone_number }}

    <x-mail::button :url="route('report-request')">
        View report requests
    </x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
