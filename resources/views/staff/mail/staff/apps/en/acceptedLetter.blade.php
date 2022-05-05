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
                                <p>Dear <b>{{ $patient }}</b></p>

                                <p>Congratulations, you have been approved for a <b>{{ $procedure }}</b> Surgery!.</p>

                                <p>Your package includes the following:</b></p>

                                    <ul>
                                        @foreach ($includes as $item)
                                            <li>{{ $item->contain_en }}</li>
                                        @endforeach
                                    </ul>

                                <p>
                                    Thank you for your application withb <b>{{ $brand->brand }}</b>!! We are excited and thrilled that you have chosen us to begin a new journey.
                                </p>

                                <p>
                                    Your direct indications from our doctor are:
                                </p>
                                <p>
                                    <b>
                                        Indications
                                    </b>
                                </p>
                                {!! $indications !!}
                                <p><b>Reccomendations</b></p>
                                {!! $recomendations !!}
                                <br>
                                <p>
                                    Please take a minute to watch our step by step guide.
                                </p>

                                <p>
                                    <a href="">
                                        Step by step
                                    </a>
                                </p>

                                <p>
                                    To schedule your surgery a 10% deposit is required to lock in your surgery date,
                                    which in this case is <b>$ {{ $downPayment }}</b> of <b>${{ $price }}</b>.
                                    Once you have made this deposit,
                                    please take a picture of the deposit slip and send it to your coordinator to begin the schedule process.
                                </p>

                                <p>
                                    <b>Pre-surgical Indications</b>
                                </p>
                                <p>
                                    Now that you have been approved by our Surgeon, please follow these indications prior to surgery:
                                </p>

                                <p>
                                    1. No Alcohol (Pre-op Diet), Once you start your diet, you shouldn't drink any alcohol.
                                </p>
                                <p>
                                    2.No Smoking of any kind (VAPING / TABACO / MARIHUANA), necessary at least 5 weeks prior to surgery.
                                </p>
                                <p>
                                    3.No Aspirin, Necessary at least one week prior to surgery.
                                </p>
                                <p>
                                    4.No Birth Control or hormone Treatment (Oral Contraceptives), Necessary to stop 30 Days prior surgery.
                                </p>
                                <p>
                                    5.No Nail polish or acrylics (hands and toes) as it hinders the oximeter reading and we need to make sure your body is oxygenating accurately.
                                </p>
                                <p>
                                    6. No False eyelashes.
                                </p>
                                <p>
                                    7. No piercings, please remove them all no exceptions.
                                </p>
                                <br>
                                <h3>
                                    <b>PLEASE NOTE:</b>
                                </h3>
                                <ul>
                                    <li>If you are taking Thyroid or Blood Pressure medication, please continue to do so until the morning of pre-ops with a little bit of water.</li>
                                    <li>If you take anti-depressants, please do not suspend and take them morning of pre-ops with little bit of water.</li>
                                    <li>If you are a patient that needs to use a CPAP, please bring it with you.</li>
                                    <li>If you take blood thinners, please suspend them 10 days prior to surgery.</li>
                                    <li>Patients must suspend steroids and Immunodepressants 1 month prior to surgery.</li>
                                    <li>Patients must suspend Aspirin and any NSAID’s 7-10 days prior to surgery.</li>
                                    <li>NSAID’s:</li>
                                    <li>Ibuprofin, Naproxen, Diclofenac, Celecoxib,Nefenamic acid, Etoricoxib, Indomethacin, high dose aspirin.</li>
                                </ul>
                                <p>
                                    It is very important for you to follow these indications and if you have any questions please feel free to contact your coordinator we will be more than happy to attend any of your inquiries.
                                </p>

                                <h5  style="text-align: center">
                                    <b>PCR Covid19 test is mandatory for patients and companions.</b>
                                </h5>
                                <p>
                                    It must be made less than 5 days prior surgery date (not before) please send me results.
                                </p>
                                <p>
                                    <b>
                                        <i>
                                            Everyone at J.L.Prado Surgical Center wants to congratulate you and together we will open this new chapter in your life.
                                        </i>
                                    </b>
                                </p>

                                <h5 style="text-align: center">
                                    <b>DEPOSIT AND BOOKING INFORMATION.</b>
                                </h5>
                                <p>- Wire transfer to our account
                                <p>- Direct deposit to our account
                                <p>- Cash
                                <p>- Credit card (3.9% fee for processing card)
                                <p><b>*Card must be under patient's name*</b></p>
                                <p>- Certified check or cashiers check made out to:</p>
                                <h3><b>JLPRADO & ASSOCIATES, INC</b></h3>
                                <p>Bank Account Number</p>
                                <p><b>JL Prado & Associates Inc.</b></p>
                                <p>US Bank</p>
                                <p>Routing #122235821</p>
                                <p>Account #157522243953</p>
                                <p>Swift Code USBKUS44IMT</p>
                                <p>9543 Heinrich Hertz Suite 4</p>
                                <p>San Diego, Ca 92154.</p>
                                <br>
                                <p>US BANK</p>
                                <p>399 H St.</p>
                                <p>Chula Vista Ca</p>
                                <br>
                                <p><b>** NO ONLINE PAYMENTS**</b></p>
                                <p><b>** NO FSA CARDS**</b></p>
                                <hr>
                                <ul>
                                    <li>
                                        The remaining balance can be paid before your surgery date (1 week prior if
                                        wired) .
                                    </li>
                                    <li>
                                        You can make as many payments in advance as you like, completing the total balance "before surgery".
                                    </li>
                                    <li>
                                        You can pay off your balance the day of your arrival in cash or certified/cashiers check.
                                    </li>
                                </ul>
                                <br>
                                <h5 style="text-align: center">
                                    <b>
                                        CANCELLATION POLICY
                                    </b>
                                </h5>
                                <p>
                                    <b>**</b> You have 24 hours to cancel after deposit is made in order to receive a full refund <b>**</b>
                                </p>
                                <p>
                                   <b>**</b> If a patient cancels surgery once at J.L.Prado Surgical Center due to persona and not medical reasons, the amount paid for surgery will be forfeited to cover the cost of services rendered as well as the canceled cost of the surgery.
                                </p>
                                <p>
                                    <b><i>Cancelled Cost:</i></b> is the lost revenue from cancellations. It is not influenced by your ancellation policy, it simply shows the total potential revenue you could have generated without the cancellations.
                                </p>
                                <br>
                                <h5 style="text-align: center">
                                    <b>
                                        RESCHEDULE POLICY
                                    </b>
                                </h5>
                                <p>
                                    Reschedule must be made 3 weeks prior surgery date in order to not lose initial deposit (10% cost of surgery).
                                </p>
                                <p>
                                    One time reschedule only, a second reschedule, patient will lose initial deposit and will have to start the process all over including initial deposit.
                                </p>
                                <br>
                                <p>
                                    - If surgery is cancelled due to not following the diet or pre surgical indications the money paid for surgery will not be refunded.
                                </p>
                                <p>
                                    - If surgery is canceled due to a health problem during pre op evaluation, $1200 dlls will be deducted to cover medical expenses and the rest will be reimbursed to the patient.
                                </p>
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
