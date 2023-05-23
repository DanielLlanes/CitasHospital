@extends('staff.mail.header')
@section('content')
    <table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;margin-top: -2px;">
        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
            <td class="container" style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #F2F2F2;display: block!important;max-width: 600px!important;clear: both!important;">
                <div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
                    <table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                            <td style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #F2F2F2;display: block!important;max-width: 600px!important;clear: both!important;">
                                Dear <b>{{ $patient }}</b>,

                                <p>Congratulations! We are pleased to inform you that you have been approved to undergo plastic surgery at our center. We are excited to be able to accompany you in this important chapter of your life, where you will be able to achieve the changes you so desire.</p>
                                @isset($sugerencias)
                                    <br>
                                    @if (count($sugerencias) > 0)
                                    <p>Here are the procedures we suggest that can help you achieve your goals:</p>
                                        <ul style="list-style-type: none;">
                                            @foreach ($sugerencias as $s)
                                            <li>
                                                <strong>{{ $s->name }}</strong>
                                            </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endisset
                                <br>
                                <p>The total price of the package is US $[price], and this quote is valid for 3 months. We want you to feel calm, so our package includes all the necessary services to make your experience as complete as possible:</p>
                                <br>
                                <ul style="list-style-type: none;">
                                    @foreach ($includes as $item)
                                        <li>{{ $item->contain_en }}</li>
                                    @endforeach
                                </ul>
                                <p>To reserve your surgery date, we require a 10% deposit. Which in this case is ${{ $downPayment }} out of ${{ $price }}. Once you have made this deposit, please send a photo of the receipt to your coordinator to start the programming process.</p>

                                <p>At <b>J.L.Prado Surgical Center</b>, we pride ourselves on providing the best care possible, and taking care of your health and well-being is our top priority. We want you to feel comfortable and secure throughout the entire process, which is why we have prepared several payment options for your convenience:</p>
                                <br>
                                <p>Bank transfer to our account.</p>
                                <p>Direct deposit to our account.</p>
                                <p>Cash payment.</p>
                                <p>Payment by credit card (a commission of 3.9% will be applied to cover processing costs). Please note that the card must be in the patient's name.</p>
                                <p>Certified check or cashier's check payable to: JLPRADO & ASSOCIATES, INC.</p>
                                <p>Below you will find our bank account details:</p>
                                <br>
                                <p>Bank account number:
                                <p>JL Prado & Associates Inc. US Bank
                                <p>Routing Number 122235821 Account Number 157522243953 Swift Code USBKUS44IMT 9543
                                <p>Heinrich Hertz Suite 4 San Diego, CA 92154
                                <p>BANK OF THE UNITED STATES</p>
                                <p>399 H St. Chula Vista Ca</p>
                                <br>
                                <p>We understand that making a payment is an important decision, so we have established a flexible plan so that you can cover the cost of surgery:</p>
                                <p>Online payments are not accepted FSA cards are not accepted</p>
                                <br>
                                <p>It is required to cover 35% of the package two weeks before the scheduled date of surgery.</p>
                                <p>The remaining balance (65%) can be paid before the surgery date (1 week before if bank transfer is made).</p>
                                <p>You can make additional payments in advance to complete the total balance before surgery.</p>
                                <p>On the day of your arrival, you can settle the balance in cash or with a certified check/cashier's check.</p>
                                <p>We want to ensure your satisfaction and provide you with exceptional service. For this reason, we have also established a clear cancellation policy</p>
                                <br>
                                <b>CANCELLATION POLICY</b>
                                <p>You have 24 hours to cancel after deposit is made in order to receive a full
                                    refund</p>
                                <br>
                                <p>If a patient cancels surgery once at <b>J.L.Prado Surgical Center</b> due to personal and
                                    not medical reasons, the amount paid for surgery will be forfeited to cover the cost of
                                    services rendered as well as the canceled cost of the surgery.</p>
                                <p>Cancelled Cost: is the lost revenue from cancellations. It is not in uenced by your
                                    cancellation policy, it simply shows the total potential revenue you could have generated
                                    without the cancellations.</p>
                                <br>

                                <p>- If surgery is cancelled due to not following the diet or pre surgical indications the
                                    money paid for surgery will not be refunded.</p>
                                <p>- If surgery is canceled due to a health problem during pre op evaluation, $1200 dlls
                                    will be deducted to cover medical expenses and the rest will be reimbursed to the
                                    patient.</p>
                                <p>- If surgery I canceled whithin two weeks prior surgery date, you will not be refunded.</p>
                                <br>

                                <b>RESCHEDULE POLICY</b>

                               <p> Reschedule must be made 3 weeks prior surgery date in order to not lose initial deposit
                                (10% cost of surgery).</p>
                                <p>One time reschedule only, a second reschedule, patient will lose initial deposit and will
                                    have to start the process all over including initial deposit.</p>
                                <p>We strive to o er the best care possible and our patient’s health and well- being is our
                                top priority.</p>
                                <p>If you have any questions or are in need of assistance, please feel free to contact me.
                                Have a wonderful and blessed day and I hope to hear from you soon.</p>
                                <br>
                                <p>Warm Regards,</p>
                                <hr>
                                <p style="margin: 0;padding: 0;"><b>{{ strtoupper($brand->acronym) }}</b></p>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->name }}</p>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->email }}</p>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->phone }}</p>
                                <p style="margin: 0;padding: 0;">Business Hours:</p>
                                <p style="margin: 0;padding: 0;">Mon-Fri 9am-5pm</p>
                                <p style="margin: 0;padding: 0;">Sat 9 am-2pm</p>
                                <p style="margin: 0;padding: 0;">Sundays CLOSED</p>
                            </td>
                        </tr>
                    </table>
                </div>
                {{-- @include('staff.mail.email-footer') --}}
            </td>
        </tr>
    </table>
@endsection
