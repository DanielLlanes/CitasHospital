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
                                <p>Estimado/a <b>{{ $patient->name }}</b>,</p>
                                <br>
                                <p>Esperamos que este mensaje le encuentre bien. Nos complace informarle que hemos registrado y procesado exitosamente su pago reciente. En relación a esto, nos complace adjuntar un archivo PDF (Portable Document Format) que contiene información importante sobre el proceso al que hace referencia su pago.</p>
                                <br>
                                <p>El archivo adjunto, denominado "Documento Importante - Proceso [número/identificador]", proporciona detalles completos sobre los pasos siguientes, los plazos involucrados y cualquier otra información relevante que pueda necesitar. Por favor, revise cuidadosamente el contenido del archivo adjunto, ya que está diseñado para brindarle una guía clara y completa sobre el proceso en cuestión.</p>
                                <br>
                                <p>Si tiene alguna pregunta adicional o necesita más información, no dude en contactarnos. Estaremos encantados de asistirle en todo lo que podamos.</p>
                                <br>

                                <p>Agradecemos su confianza en nuestros servicios y esperamos poder brindarle una experiencia satisfactoria. Adjunto encontrará el archivo PDF mencionado. ¡No dude en ponerse en contacto si necesita ayuda adicional!</p>
                                <br>
                                <p>Atentamente,</p>
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