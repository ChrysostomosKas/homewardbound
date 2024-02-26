@component('mail::message')
    <table>
        <tr>
            <td>
                <table>
                    <tr>
                        @if($adoptionInterest->status->name == \App\Enums\AdoptionAdStatus::Closed->name)
                            <td>
                                <p>Dear {{ $adoptionInterest->user->full_name }},</p>
                                <p>We wanted to express our sincere gratitude for your interest in adopting a pet from our organization.</p>
                                <p> We are pleased to inform you that your pet adoption request has been accepted. This is an exciting step towards providing a loving home for a furry friend, and we truly appreciate your commitment to making a positive impact on a pet's life.</p>
                                <p>In the coming days, a member of our team will be in touch with you to discuss the next steps and provide you with additional details regarding the adoption process. We understand that this is an important decision, and we are here to assist you in any way we can.</p>
                                <p>If you have any immediate questions or concerns, feel free to reach out to us at test@test.com.</p>
                                <p>Best regards,</p>
                                <p>{{ config('app.name') }}</p>
                            </td>
                        @else
                            <td>
                                <p>Dear {{ $adoptionInterest->user->full_name }},</p>
                                <p>We regret to inform you that your application for adopting a pet has been canceled. We understand that this news may be disappointing, and we want to provide you with the reason for the cancellation.</p>
                                <p>We understand that each adoption journey is unique, and sometimes circumstances beyond our control lead to difficult decisions.</p>
                                <p>{{ $adoptionInterest->reason }}</p>
                                <p>If you have any questions or would like further clarification regarding the cancellation reason, please do not hesitate to reach out to our adoption team at test@test.com.</p>
                                <p>We appreciate your understanding and interest in providing a loving home for a pet.</p>
                                <p>Thank you for considering adoption and for your continued support.</p>
                                <p>Best regards,</p>
                                <p>{{ config('app.name') }}</p>
                            </td>
                        @endif
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endcomponent
