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
                                Estimado/a <b>{{ $patient }}</b>,
                                @if (  strtolower($treatment->service->brand->brand)  == 'a beautiful me')
                                {{-- ABM --}}
                                    <p>¡Felicitaciones, ha sido aprobado para la cirugía plástica!</p>

                                    @isset($sugerencias)
                                        <br>
                                        @if (count($sugerencias) > 0)
                                        <p>Estos son los procedimientos que sugerimos que pueden ayudarte a lograr tus objetivos:</p>
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
                                    <p>El precio total del paquete es de US${{ $price }}, y esta cotización es válida por 3 meses. Queremos que te sientas tranquilo, por eso nuestro paquete incluye todos los servicios necesarios para que tu experiencia sea lo más completa posible:</p>
                                    <br>
                                    <ul style="list-style-type: none;">
                                        @foreach ($includes as $item)
                                            <li>{{ $item->contain_es }}</li>
                                        @endforeach
                                    </ul>
                                @elseif ( strtolower($treatment->service->brand->brand) == 'a slimmer me')
                                {{-- ASM --}}
                                    <br>
                                    <p>¡Felicidades, ha sido aprobado para una Cirugía de {{ $procedure }}!, Su paquete incluye lo siguiente:</p>
                                    <br>
                                    <ul style="list-style-type: none;">
                                        @foreach ($includes as $item)
                                            <li>{{ $item->contain_en }}</li>
                                        @endforeach
                                    </ul>

                                    
                                @endif
                                 <p>Para reservar la fecha de su cirugía, requerimos un depósito del 10%. Que en este caso es ${{ $downPayment }} de ${{ $price }}. Una vez que haya realizado este depósito, envíe una foto del recibo a su coordinador para iniciar el proceso de programación.</p>

                                 <p>En <b>J.L.Prado Surgical Center</b>, nos enorgullecemos de brindar la mejor atención posible, y cuidar su salud y bienestar es nuestra principal prioridad. Queremos que te sientas cómodo y seguro durante todo el proceso, por eso hemos preparado varias opciones de pago para tu comodidad:</p>
                                 <br>
                                 <p>Transferencia bancaria a nuestra cuenta.</p>
                                 <p>Depósito directo a nuestra cuenta.</p>
                                 <p>Pago en efectivo.</p>
                                 <p>Pago con tarjeta de crédito (se aplicará una comisión del 3,9% para cubrir los gastos de tramitación). Tenga en cuenta que la tarjeta debe estar a nombre del paciente.</p>
                                 <p>Cheque certificado o cheque de caja a nombre de: JLPRADO & ASSOCIATES, INC.</p>
                                 <p>A continuación encontrará los datos de nuestra cuenta bancaria:</p>
                                 <br>
                                 <p>Número de cuenta bancaria:
                                 <p>JL Prado & Associates Inc. Banco de EE. UU.
                                 <p>Número de ruta 122235821 Número de cuenta 157522243953 Código Swift USBKUS44IMT 9543
                                 <p>Suite Heinrich Hertz 4 San Diego, CA 92154
                                 <p>BANCO DE LOS ESTADOS UNIDOS</p>
                                 <p>399 H St. Chula Vista California</p>
                                 <br>
                                 <p>Entendemos que realizar un pago es una decisión importante, por lo que hemos establecido un plan flexible para que puedas cubrir el costo de la cirugía:</p>
                                 <p>No se aceptan pagos en línea No se aceptan tarjetas FSA</p>
                                 <br>
                                 <p>Se requiere cubrir el 35% del paquete dos semanas antes de la fecha programada de la cirugía.</p>
                                 <p>El saldo restante (65%) se puede pagar antes de la fecha de la cirugía (1 semana antes si se realiza transferencia bancaria).</p>
                                 <p>Puede realizar pagos adicionales por adelantado para completar el saldo total antes de la cirugía.</p>
                                 <p>El día de su llegada, puede liquidar el saldo en efectivo o con un cheque certificado/cheque de caja.</p>
                                 <p>Queremos asegurar su satisfacción y brindarle un servicio excepcional. Por este motivo, también hemos establecido una política de cancelación clara</p>
                                 <br>
                                 <b>POLÍTICA DE CANCELACIÓN</b>
                                 <p>Tiene 24 horas para cancelar después de realizar el depósito para recibir un pago completo
                                     reembolso</p>
                                 <br>
                                 <p>Si un paciente cancela una vez la cirugía en <b>Centro Quirúrgico J.L.Prado</b> por motivos personales y
                                     razones no médicas, el monto pagado por la cirugía se perderá para cubrir el costo de
                                     servicios prestados, así como el costo cancelado de la cirugía.</p>
                                 <p>Coste cancelado: es la pérdida de ingresos por cancelaciones. No está influenciado por su
                                     política de cancelación, simplemente muestra los ingresos potenciales totales que podría haber generado
                                     sin las cancelaciones.</p>
                                 <br>

                                 <p>- Si se cancela la cirugía por no seguir la dieta o indicaciones prequirúrgicas la
                                     el dinero pagado por la cirugía no será reembolsado.</p>
                                 <p>- Si la cirugía se cancela por un problema de salud durante la evaluación preoperatoria, $1200 dlls
                                     se deducirá para cubrir los gastos médicos y el resto se reembolsará al
                                     paciente.</p>
                                 <p>- Si cancelé la cirugía dentro de las dos semanas anteriores a la fecha de la cirugía, no se le reembolsará.</p>
                                 <br>

                                 <b>POLÍTICA DE REPROGRAMACIÓN</b>

                                <p> La reprogramación debe hacerse 3 semanas antes de la fecha de la cirugía para no perder el depósito inicial
                                 (10% costo de la cirugía).</p>
                                 <p>Solo en una reprogramación, una segunda reprogramación, el paciente perderá el depósito inicial y
                                     tiene que comenzar todo el proceso, incluido el depósito inicial.</p>
                                 <p>Nos esforzamos por ofrecer la mejor atención posible y la salud y el bienestar de nuestros pacientes es nuestro
                                 máxima prioridad.</p>
                                 <p>Si tiene alguna pregunta o necesita ayuda, no dude en ponerse en contacto conmigo.
                                 Que tenga un maravilloso y bendecido día y espero tener noticias suyas pronto.</p>
                                 <br>
                                 <p>Un cordial saludo,</p>
                                <br>
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
