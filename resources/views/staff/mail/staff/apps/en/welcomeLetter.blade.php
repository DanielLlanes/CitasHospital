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
                                @if ( {{ strtolower($treatment->service->brand->brand) }} == 'a beautiful me')
                                    <br>
                                    <p>Thank you for your interest in A <b>{{ getUcWords($treatment->service->brand->brand) }}!</b></p>
                                    <br>
                                    <p>Our surgeon will review your application, as soon as we have a quote for you It will be
                                        sent to your email.</p>
                                    <p>In the mean time here is some important information for you to know.</p>
                                    <br>
                                    <p>In order to have plastics your BMI needs to be less than 32.</p>
                                    <br>
                                    <p>If your BMI is higher than 32 at the moment of your application a quote will not be sent
                                        until you lose the weight and have a BMI of 32 or less.</p>
                                    <br>
                                    <p>Hemoglobin needs to be at 14.</p>
                                    <br>
                                    <p>We strive to offer the best care possible and our patient’s health and well- being is our
                                        top priority.</p>
                                    <br>
                                    <p>If you have any questions or are in need of assistance, please feel free to contact me.</p>
                                    <br>
                                    <p>Have a wonderful and blessed day and I hope to hear from you soon.</p>
                                    
                                @elseif ( {{ strtolower($treatment->service->brand->brand) }}== 'a slimmer me')
                                    <p>We are very thrilled and excited you have chosen <b>{{ getUcWords($treatment->service->brand->brand) }}</b> for your weight loss journey.  My name is </b>{{ $coordinator->name }}</b> and I will be your medical coordinator.  We have received your application and it is undergoing review for approval.  We expect to have an answer in the next 24-48 hrs and wish to thank you for your patience.</p>
                                    <br>
                                    <p>I will be very happy to answer all your questions regarding weight loss surgery and clear any doubts about your package.  Once your application is approved, you will receive an <b>APPROVAL LETTER</b> with <b>BOOKING & PAYMENT INFORMATION.</b></p>
                                    <br>       
                                    <p>Please let me know if you have any questions or need assistance.</p>
                                    <br>
                                    @endif
                                    
                                <p>Warm Regards,</p>
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