@component('mail::message')
    <table>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <p>Dear {{ $adoptionInterest->user->full_name }},</p>
                            <p>We wanted to express our sincere gratitude for your interest in adopting a pet from our organization.</p>
                            <p> We are pleased to inform you that your pet adoption request has been accepted. This is an exciting step towards providing a loving home for a furry friend, and we truly appreciate your commitment to making a positive impact on a pet's life.</p>
                            <p>In the coming days, a member of our team will be in touch with you to discuss the next steps and provide you with additional details regarding the adoption process. We understand that this is an important decision, and we are here to assist you in any way we can.</p>
                            <p>If you have any immediate questions or concerns, feel free to reach out to us at test@test.com.</p>
                            <p>Best regards,</p>
                            <p>{{ config('app.name') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endcomponent
