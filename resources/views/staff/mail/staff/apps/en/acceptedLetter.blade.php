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
                                @if (  strtolower($brand->brand)  == 'a beautiful me')

                                    <p>Congratulations, you have been approved for plastic surgery!</p>
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
                                    <p>The total price of the package is US ${{ $price }}, and this quote is valid for 3 months.</p>
                                    <br>
                                    <p>Your package is all inclusive:</p>
                                    <br>
                                    <ul style="list-style-type: none;">
                                        @foreach ($includes as $item)
                                            <li>{{ $item->contain_en }}</li>
                                        @endforeach
                                    </ul>

                                @elseif ( strtolower($brand->brand) == 'a slimmer me')
                                    <br>
                                    <p>Congratulations, you have been approved for a {{ $procedure }} Surgery!, Your package includes the following:</p>
                                    <br>
                                    <ul style="list-style-type: none;">
                                        @foreach ($includes as $item)
                                            <li>{{ $item->contain_en }}</li>
                                        @endforeach
                                    </ul>
                                    <br>
                                    <p>Your direct indications from our doctor are: {{ $indications }}</p>
                                    <br>
                                    <p>Please take a minute to watch our step by step guide <a href="https://jlpradosc.com/step-by-step">step-by-step</a> </p>
                                @endif
                                <br>

                                <p>To schedule your surgery, a 10% deposit is required to lock in your surgery date, which
                                    in this case is ${{ $downPayment }} to ${{ $price }}. Once you have made this deposit, please
                                    take a picture of the deposit slip and send it to your coordinator to begin the schedule
                                    process.</p>
                                <br>

                                <p> Everyone at J.L.Prado Surgical Center wants to congratulate you and together we will
                                    open this new chapter in your life. </p>

                                <p>
                                    DEPOSIT AND BOOKING INFORMATION.<br>
                                    This are the options we offer to make your deposit/payment - Wire transfer to our account:<br>
                                    - Direct deposit to our account<br>
                                    - Cash<br>
                                    - Credit card (3.9% fee for processing card)<br>
                                    NOTE: Card must be under patient's name<br>
                                    - Certified check or cashier's check made out to: JL Prado & Associates, Inc.
                                </p>
                                
                                <p>
                                    BALANCE PAYMENT<br>
                                    You can pay your balance with cash, card, wire transfer, cashier's check to: JLPRADO & ASSOCIATES, INC.<br>
                                    * balance can be paid in advance or the day of arrival, it must be paid before starting pre-op evaluation.<br>
                                    Bank name: FIRST BANK<br>
                                    JL Prado & Associates, inc.<br>
                                    ACCOUNT: 1048742079<br>
                                    ROUTING: 081009428<br>
                                    2494 Roll Dr<br>
                                    San Diego, Ca 92154<br>
                                    ** NO ONLINE PAYMENTS**<br>
                                    ** NO FSA CARDS**
                                </p>
                                
                                <p>
                                    • A 35% of the package must be covered two weeks prior to surgery.<br>
                                    • The remaining balance (65%) can be paid before your surgery date (1 week prior if wired)<br>
                                    • You can make as many payments in advance as you like, completing the total balance "before surgery"<br>
                                    • You can pay off your balance the day of your arrival in cash or certified/cashier's check or credit card (3.9% service fee)
                                </p>
                                
                                <p>
                                    CANCELLATION POLICY<br>
                                    ** 10% deposit is non-refundable **<br>
                                    ** If a patient cancels surgery once at J.L.Prado Surgical Center due to personal and not medical reasons, the amount paid for surgery will be forfeited to cover the cost of services rendered as well as the canceled cost of the surgery.<br>
                                    Cancelled Cost: is the lost revenue from cancellations. It is not influenced by your cancellation policy, it simply shows the total potential revenue you could have generated without the cancellations.<br>
                                    - If surgery is cancelled due to not following the diet or pre-surgical indications, the money paid for surgery will not be refunded.<br>
                                    - If surgery is canceled due to a health problem during pre-op evaluation, $1200 dlls will be deducted to cover medical expenses and the rest will be reimbursed to the patient.<br>
                                    - If surgery is canceled within two weeks prior surgery date, you will not be refunded.
                                </p>
                                
                                <p>
                                    RESCHEDULE POLICY<br>
                                    Reschedule must be made 3 weeks prior surgery date in order for your initial deposit to be valid, otherwise you will have to pay an initial deposit to schedule a new date.<br>
                                    One-time reschedule only, a second reschedule, the patient will have to start the process all over including initial deposit.
                                </p>
                                
                                <br>
                                <p>Warm Regards,</p>
                                <hr>
                                <p style="margin: 0;padding: 0;">{{ $coordinator->name }}</p>
                                <p style="margin: 0;padding: 0;"><b>{{ strtoupper($brand->acronym) }}</b> Coordinator</p>
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
