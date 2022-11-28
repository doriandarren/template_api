@php
    $color = '#59C5F2';
    $headerBgColor = '#70bbd9';
    $bodyBgColor = '#ffffff';
    $footerBgColor = '#E5F3FF';
    $backGround = '#EDF0F3';
    $padding = 'padding: 30px 20px 30px 20px;';
    $paddingFooter = 'padding: 8px 20px 8px 20px;';
    $width = '450';
    $styleBtn = 'background-color: '.$color.';
                border: none; color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 8px;';

@endphp

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>Company</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>


<body style="font-family: sans-serif, Helvetica, Arial; margin: 0; padding: 0; font-size: 18px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.2em; background-color: rgb(237, 240, 243);" bgcolor="rgb(237, 240, 243)">

<!-- Table Main -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: {{ $backGround }};">

    <tr>

        <td style="padding: 40px 30px 40px 30px;">

            <!-- Table Wrapper -->
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="{{$width}}" style="border-collapse: collapse; background-color: {{ $bodyBgColor }};">

                <tr>
                    <td style="text-align: center; padding-top: 10px">
                        <img src="{{ env('APP_URL') }}/brand/images/company_logos/logo.png" style="width: 180px !important;" width="180" alt="newsletter-interna">
                    </td>
                </tr>

                <tr>
                    <td>
                        <!-- Table content -->
                        <table border="0" cellpadding="0" style="padding: 30px 10px 30px 10px;">
                            <tr>
                                <td bgcolor="{{ $bodyBgColor }}" style="{{ $padding }}">

                                    <div style="text-align: justify">
                                        Hola,
                                    </div>
                                    <div><br></div>
                                    <div>
                                        Está recibiendo este correo electrónico porque recibimos una solicitud de
                                        restablecimiento de contraseña para su cuenta.
                                    </div>
                                    <div><br></div>
                                    <div>
                                        El botón a continuación lo iniciará automáticamente. Puede restablecer su contraseña en su perfil.
                                    </div>
                                    <div><br><br></div>
                                    <div>
                                        <div style="text-align: center;">
                                            <a href="{{ $link }}"
                                                style="{{$styleBtn}}"
                                                role="button"
                                                aria-disabled="true"
                                            >
                                                Restablecer contraseña
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <!-- END Table content -->
                    </td>
                </tr>

                <tr>
                    <td>
                        <!-- Table footer -->
                        <table style="background-color: {{ $bodyBgColor }}; padding-bottom: 30px;">
{{--                            <tr>--}}
{{--                                <td style="text-align: center; {{ $paddingFooter }}">--}}
{{--                                    <hr>--}}
{{--                                    <img src="{{ env('APP_URL') }}/brand/images/company_logos/logo.png" style="max-width: 120px; margin-bottom:15px; margin-top:15px;" width="120" alt="footer-logo">--}}
{{--                                </td>--}}
{{--                            </tr>--}}
                            <tr>
                                <td style="text-align: center; font-size: 14px; {{ $paddingFooter }}">
                                    <hr>
                                    {{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::ADDRESS }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-size: 14px; {{ $paddingFooter }}">
                                    <a href="tel:{{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::PHONE_PREFIX }}{{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::PHONE }}" style="text-decoration: none;color: {{$color}};">{{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::PHONE_PREFIX }} {{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::PHONE }}</a> |
                                    <a href="mailto:{{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::EMAIL }}" style="text-decoration: none;color: {{$color}};">{{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::EMAIL }}</a> |
                                    <a href="{{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::WEB_SITE }}" target="_blank" style="text-decoration: none;color: {{$color}};">{{ \Src\Api\Shared\Domain\Enums\EnumSettingCompany::WEB_SITE }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: justify; font-size: 12px; {{ $paddingFooter }}">La información contenida en este mensaje es
                                    confidencial y solo se dirige de forma exclusiva a su destinatario. Esta prohibida cualquier divulgación,
                                    distribución o reproducción de este mensaje. Si ha recibido este mensaje por error, le rogamos nos lo
                                    comunique de forma inmediata al remitente y proceda a su eliminación total.
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: justify; font-size: 12px; {{ $paddingFooter }}">This e-mail and any attachments contain
                                    material that is confidential for the sole use of the intended recipient. Any review, reliance or
                                    distribution by others or forwarding without express permission is strictly prohibited. If you are not the
                                    intended recipient, please contact the sender and delete all copies.
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: justify; font-size: 12px; color: #8cc63f; {{ $paddingFooter }}">Cuidemos el medio ambiente. Por
                                    favor no imprima este e-mail si no es necesario. Please consider the environment before printing this email
                                </td>
                            </tr>
                        </table>
                        <!-- END Table footer -->
                    </td>
                </tr>
            </table>
            <!-- END Table Wrapper -->

        </td>

    </tr>

</table>
<!-- END Table Main -->

</body>

</html>

@php //dd("pasa"); @endphp
