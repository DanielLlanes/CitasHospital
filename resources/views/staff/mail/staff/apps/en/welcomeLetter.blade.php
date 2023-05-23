@extends('staff.mail.header')
@section('content')
    <table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;margin-top: -2px;">
        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
            <td class="container" style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #F2F2F2;display: block!important;max-width: 600px!important;clear: both!important;">
                <div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
                    <table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                                <p>Dear <b>{{ $patient->name }}</b></p>
                                 
                                <p>We are very thrilled and excited you have chosen <b>{{ getUcWords($treatment->service->brand->brand) }}</b> for your weight loss journey.  My name is </b>{{ $coordinator->name }}</b> and I will be your medical coordinator.  We have received your application and it is undergoing review for approval.  We expect to have an answer in the next 24-48 hrs and wish to thank you for your patience.</p>
                                 
                                <p>I will be very happy to answer all your questions regarding weight loss surgery and clear any doubts about your package.  Once your application is approved, you will receive an <b>APPROVAL LETTER</b> with <b>BOOKING & PAYMENT INFORMATION.</b></p>
                                 
                                <p>Please let me know if you have any questions or need assistance.</p>

                                <p>Warm Regards,</p>
                                
                                Dear <b>{{ $patient->name }}</b>,
                                <br>
                                It is our great pleasure that you have chosen <b>{{ getUcWords($treatment->service->brand->brand) }}</b> as your destination to achieve your weight loss goals. Let me introduce myself, I am </b>{{ $coordinator->name }}</b>, your medical coordinator. We want to express our appreciation for sending us your application, which is currently under review for prompt approval. We will be happy to provide you with our response within the next 24 hours, and we greatly appreciate your patience during this process.
                                <br>
                                In my role as medical coordinator, I am here to provide you with all the assistance you need and answer any questions you may have about weight loss surgery, as well as clarify any questions related to the package you have selected. Our main objective is to provide you with all the necessary information so that you feel safe and confident in your decision. Once your request is approved, you will receive an <b>APPROVAL LETTER</b> that will contain the <b>RESERVATION AND PAYMENT INFORMATION</b> necessary to continue with the process.
                                <br>
                                Feel free to contact me at any time if you have any additional questions or need additional assistance. I am here to guide you and give you the support you need.
                                <br>
                                Receives a warm greeting,
                                <br>
                                
                                <hr>
                                <p style="margin: 0;padding: 0;">{{ strtoupper($treatment->service->brand->acronym) }} {{ ucfirst($role = $coordinator->roles[0]->name_en ) }}</p>
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