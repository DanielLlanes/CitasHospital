@extends('staff.pdfs.header')
@section('content')
    <table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;margin-top: -2px;">
        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
            <td class="container" style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #F2F2F2;display: block!important;max-width: 600px!important;clear: both!important;">
                <div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
                    <table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                            <td style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #F2F2F2;display: block!important;max-width: 600px!important;clear: both!important;">
                                <p> Dear <b>{{ $patient->name }}</b></p>,
                                <br>
                                <p>We hope this message finds you well. We are pleased to inform you that we have successfully recorded and processed your recent payment. In this connection, we are pleased to attach a PDF (Portable Document Format) file containing important information about the process to which your payment refers.</p>
                                <br>
                                <p>The attached file, labeled "Important Document - Process [number/identifier]", provides full details on the next steps, the timelines involved, and any other relevant information you may need. Please review the content of the attached file carefully, as it is designed to provide you with a clear and comprehensive guide to the process in question.</p>
                                <br>
                                <p>If you have any additional questions or need more information, please do not hesitate to contact us. We will be happy to assist you in any way we can.</p>
                                <br>
                                <p>We appreciate your trust in our services and hope to provide you with a satisfactory experience. Attached you will find the mentioned PDF file. Don't hesitate to get in touch if you need any additional help!</p>
                                <br>
                                <p>Sincerely,</p>
                                <br>
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