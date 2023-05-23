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
                                Estimado <b>{{ $patient->name }}</b>,

                                Es un gran placer para nosotros que haya elegido {{ getUcWords($treatment->service->brand->brand) }} como su destino para lograr sus objetivos de pérdida de peso. Permítanme presentarme, soy {{ $coordinator->name }}, su coordinador médico. Queremos expresar nuestro agradecimiento por enviarnos su solicitud, la cual se encuentra actualmente en revisión para su pronta aprobación. En las próximas 24 horas, estaremos encantados de comunicarle nuestra respuesta y le agradecemos mucho su paciencia durante este proceso.
                                <br>
                                En mi rol de coordinador médico, estoy para brindarte toda la asistencia que necesites y resolver cualquier duda que puedas tener sobre la cirugía de pérdida de peso, así como aclarar cualquier duda relacionada con el paquete que hayas seleccionado. Nuestro principal objetivo es brindarte toda la información necesaria para que te sientas seguro y confiado en tu decisión. Una vez aprobada su solicitud, recibirá una <b>CARTA DE APROBACIÓN</b> que contendrá la <b>INFORMACIÓN DE RESERVA Y PAGO</b> necesaria para continuar con el proceso.
                                <br>
                                No dude en ponerse en contacto conmigo en cualquier momento si tiene alguna pregunta adicional o necesita ayuda adicional. Estoy aquí para guiarte y brindarte el apoyo que necesitas.
                                <br>
                                Recibe un cordial saludo,
                                <br>
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