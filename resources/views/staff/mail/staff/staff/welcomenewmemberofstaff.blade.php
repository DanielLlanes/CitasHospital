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
                                <h3 style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #0A3A50;font-weight: 900;font-size: 55px;text-align: center;">Bienvenido</h3>
                                <p class="lead patient-name" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: 900;font-size: 20px;line-height: 1.6;text-align: center;color: #2D5B6B;"> {{ $reciverName }} </p>
                                <br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                                <br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                                <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">
                                    @lang('This is to inform you that, Your account on :app_name has been created successfully. Log in for more details.', ['app_name' => str_replace('_', " ", config('app.name', 'Laravel'))])
                                   // @lang('This email is to inform you that your :app_name account has been created, log in to start using it.', ['app_name' => str_replace('_', " ", config('app.name', 'Laravel'))])
                                </p>
                                <div class="callout" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                                    <p class="data-patient" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 16px;line-height: 1.6;text-align: left;padding-bottom: 10px;color: #474747;"> 
                                        <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2D6177;">@lang('Username'): 
                                        </strong> {{ $username }}
                                    </p>
                                    <p class="data-patient" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 16px;line-height: 1.6;text-align: left;padding-bottom: 10px;color: #474747;"> 
                                        <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2D6177;">@lang('Email'): 
                                        </strong> {{ $email }} 
                                    </p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;"></p>
                                    <p class="data-patient" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 16px;line-height: 1.6;text-align: left;padding-bottom: 10px;color: #474747;"> 
                                        <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2D6177;">@lang('Password'): 
                                        </strong> {{ $password }} 
                                    </p>
                                </div>
                                <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">
                                    @lang('From this moment, you can log in with your email or username and password.')</p>
                                    <a href="{{ route('staff.login') }}" class="press-here" style="margin: 0;padding: 5px 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: white !important;margin-top: 10px;display: block;text-align: center;max-width: 200px;margin-left: 160px;background-color: #7CC576;cursor: pointer;border-radius: 15px 15px 15px 15px;font-weight: bold;"> 
                                        <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">@lang('Login')
                                        </strong> 
                                        <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                                        </strong> 
                                    </a>
                                </p>
                                <br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"> </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
@endsection