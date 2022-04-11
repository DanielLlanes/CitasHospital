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
                                <p>Estimado {{ $patient->name }}</p>
                                 
                                <p>Estamos muy contentos y emocionados de que haya elegido {{ getUcWords($treatment->service->brand->brand) }} para su viaje de pérdida de peso.  Mi nombre es {{ $coordinator->name }} y seré su coordinador médico.  Hemos recibido su solicitud y está siendo revisada para su aprobación.  Esperamos tener una respuesta en las próximas 24-48 horas y deseamos agradecerle su paciencia.</p>
                                 
                                <p>Estaré encantado de responder a todas sus preguntas sobre la cirugía de pérdida de peso y aclarar cualquier duda sobre su paquete.  Una vez que su solicitud sea aprobada, recibirá una CARTA DE APROBACIÓN con la INFORMACIÓN DE RESERVA Y PAGO.</p>
                                 
                                <p>Por favor, hágame saber si tiene alguna pregunta o necesita ayuda.</p>

                                 
                                <p>Saludos cordiales,</p>
                                <hr>
                                <p style="margin: 0;padding: 0;">{{ ucfirst($role = $coordinator->roles[0]->name_es ) }} de {{ strtoupper($treatment->service->brand->acronym) }} 
                                <p style="margin: 0;padding: 0;">{{ $coordinator->phone }}</p>
                                <p style="margin: 0;padding: 0;">Horario de atención:</p>
                                <p style="margin: 0;padding: 0;">Lun-Vie 9am-5pm</p>
                                <p style="margin: 0;padding: 0;">Sábado 9 am-2pm</p>
                                <p style="margin: 0;padding: 0;">Domingos CERRADO</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
@endsection