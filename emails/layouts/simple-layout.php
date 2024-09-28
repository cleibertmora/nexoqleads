<?php

function child_theme_email_simple_layout($data)
{
    // Extraer datos para el Layout
    $year = date("Y");
    $title = $data['title'] ?? '';
    $siteName = 'Lead Gen';
    $description = $data['description'] ?? '';
    $table = isset($data['table']) && $data['table'] ? $data['table'] : [];
    $tableRows = '';

    foreach ($table as $key => $value) {
        $tableRows .= '<tr style="background-color: #fff;">
            <td style="border: 1px solid #ddd; padding: 8px;"><strong>' . $key . '</strong></td>
            <td style="border: 1px solid #ddd; padding: 8px;">' . $value . '</td>
        </tr>';
    }

    return <<<EOT
        <!DOCTYPE html>
        <html>    
            <head>
                <meta charset="utf-8">
                <title>{$title}</title>
            </head>

            <body>                
                <table width="600" style="padding: 10px; margin-top: 20px;" align="center">
                    <tr>
                        <td>
                            <h1 style="font-size: 24px; font-weight: bold; text-align: center;">
                                {$title}
                            </h1>

                            {$description}
                            
                            <table style="border-collapse: collapse; width: 100%;">
                                <tbody>
                                    <tr style="background-color: #fff; text-align: center;">
                                        <td style="border: 1px solid #ddd; padding: 8px;" colspan="100%"><strong>Información general</strong></td>
                                    </tr>

                                    {$tableRows}
                                </tbody>
                            </table>                           

                            <hr style="margin-top: 30px; text-align: center; background-color: #ccc;">
                        </td>
                    </tr>
                </table>
                
                <table align="center" width="600" cellpadding="0" cellspacing="0" border="0" style="margin-top:20px;">
                    <tr>
                        <td>
                            <p style="text-align: center; font-size: 12px;">Este correo electrónico es enviado automáticamente. Por
                                favor, no responda a este mensaje.</p>
                            <p style="text-align: center; font-size: 12px;">© {$year} {$siteName}. Todos los derechos reservados.</p>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
    EOT;
}