<?php
/**
 * @title            Spanish Language File
 *
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2013-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package          PH7 / Lang / ES
 */

namespace PH7;

$LANG = array (
    'lang' => 'es',
    'charset' => 'utf-8',
    'lang_name' => 'Español',
    'version' => 'versión',
    'CMS_desc' => '<p>Bienvenido a la instalación de ' . Controller::SOFTWARE_NAME . '.<br />
    Gracias por elegir nuestro CMS y esperamos que sea de su agrado usted.</p>',
    'choose_install_lang' => 'Por favor, elija su idioma para comenzar la instalación',
    'requirements_desc' => '¡ADVERTENCIA! Por favor, asegúrese de que el servidor tiene la necesaria <a href="' . Controller::SOFTWARE_REQUIREMENTS_URL . '" target="_blank">requisitos</a> para funcionar correctamente pH7CMS.',
    'requirements2_desc' => 'En primer lugar, cree una base de datos MySQL y asignar a un usuario con privilegios completos. Una vez creada la base de datos MySQL y el usuario, asegúrese de escribir el nombre de la base de datos, el nombre de usuario y contraseña, ya que necesitará para la instalación.',
    'config_path' => 'Ruta del directorio &laquo;protected&raquo;',
    'desc_config_path' => 'Por favor, especifique la ruta completa a la carpeta de &laquo;protected&raquo;.<br />
    Es prudente y aconsejable (pero en cualquier caso no es obligatorio) colocar este directorio fuera de la raíz pública del servidor de la Web.',
    'need_frame' => '¡Debe utilizar un navegador Web que soporte marcos en línea!',
    'path_protected' => 'Ruta de la carpeta &laquo;protected&raquo;',
    'next' => 'Próximo',
    'go' => 'Siguiente Paso =>',
    'later' => 'Más tarde ...',
    'register' => '¡Guárdelo!',
    'site_name' => 'Nombre de tu sitio',
    'license' => 'Su Licencia',
    'license_desc' => '¡Por favor, lea cuidadosamente la licencia y acéptelo para continuar la instalación del software!',
    'registration_for_license' => 'Si no lo has hecho todavía, es un buen momento para comprar ahora <a href="' . Controller::SOFTWARE_LICENSE_KEY_URL . '" target="_blank">una licencia</a> con el fin de obtener la prima características ofrecen por el software.<br /> Si quieres probar la versión de prueba y que contienen enlaces de publicidad, puede omitir este paso.',
    'your_license' => 'Su clave de licencia',
    'agree_license' => 'He leído y acepto los términos anteriores.',
    'step' => 'Paso',
    'welcome' => 'Bienvenido a la instalación de',
    'welcome_to_installer' => 'Instalación de',
    'config_site' => '¡Configure su sitio web!',
    'config_system' => '¡Configuración del sistema CMS!',
    'finish' => '¡Finalizar la instalación!',
    'go_your_site' => '¡Vaya a su nuevo sitio web!',
    'go_your_admin_panel' => '¡Ve a tu panel de administración!',
    'error_page_not_found' => 'Página no encontrada',
    'error_page_not_found_desc' => 'Lo sentimos, pero la página que busca no se pudo encontrar.',
    'success_license' => '¡Bien hecho!',
    'failure_license' => '¡Formato de licencia incorrecta!',
    'no_protected_exist' => 'Lo sentimos, pero no hemos encontrado el directorio &laquo;protected&raquo;.',
    'no_protected_readable' => 'Cambie los permisos del directorio &laquo;protected&raquo; en el modo de lectura (CHMOD 755).',
    'no_public_writable' => 'Cambie los permisos del directorio &laquo;public&raquo; en el modo de escritura (CHMOD 777).',
    'no_app_config_writable' => 'Cambie los permisos del directorio &laquo;protected/app/configs&raquo; en el modo de escritura (CHMOD 777).',
    'database_error' => 'Error al conectar con la base de datos.<br />',
    'error_sql_import' => 'Se produjo un error al importar el archivo en su base de datos SQL',
    'require_mysql_version' => 'Debe instalar MySQL ' . PH7_REQUIRE_SQL_VERSION . ' o superior para poder continuar.',
    'field_required' => 'Este campo es obligatorio',
    'all_fields_mandatory' => 'Todos los campos marcados con un asterisco (*) son obligatorios',
    'db_hostname' => 'Nombre de host del servidor de base de datos',
    'desc_db_hostname' => '(Generalmente &quot;localhost&quot; o &quot;127.0.0.1&quot;)',
    'db_name' =>'Nombre de la base de datos',
    'db_username' => 'Nombre de usuario de la base de datos',
    'db_password' => 'Contraseña para la base de datos',
    'db_prefix' => 'El prefijo de la tabla de la base de datos',
    'desc_db_prefix' => 'Esta opción es útil cuando tiene varias instalaciones de pH7CMS en la misma base de datos. Recomendamos que usted todavía cambiar los valores por defecto con el fin de aumentar la seguridad de su sitio web.',
    'db_encoding' => 'Codificación',
    'desc_db_encoding' => 'Codificación de la base de datos, por lo general para la codificación UTF8 internacional.',
    'db_port' => 'Puerto de la base de datos',
    'ffmpeg_path' => 'La ruta de acceso al ejecutable FFmpeg (si usted no sabe dónde está, por favor pregunte a su anfitrión)',
    'bug_report_email' => 'Bug informes e-mail',
    'admin_first_name' => 'Su nombre',
    'admin_last_name' => 'Sus apellidos',
    'admin_username' => 'Su nombre de usuario para iniciar sesión en tu panel de administración',
    'admin_login_email' => 'Su correo electrónico para iniciar sesión en tu panel de administración',
    'admin_email' => 'Su dirección de correo electrónico para la administración',
    'admin_return_email' => 'Noreply dirección de correo electrónico (por lo general noreply@yoursite.com)',
    'admin_feedback_email' => 'Dirección de correo electrónico para el formulario de contacto (feedback)',
    'admin_password' => 'Su contraseña',
    'admin_passwords' => 'Por favor, confirme su contraseña',
    'bad_email' => 'E-mail incorrecta',
    'bad_username' => 'Su nombre de usuario es incorrecto',
    'username_too_short' => 'Su apodo es demasiado corto, por lo menos 4 caracteres',
    'username_too_long' => 'Su nombre es muy largo, con un máximo de 40 caracteres',
    'password_no_number' => 'La contraseña debe contener al menos un número de',
    'password_no_upper' => 'La contraseña debe contener al menos una mayúscula',
    'password_too_short' => 'Su contraseña es demasiado corta',
    'password_too_long' => 'Su contraseña es demasiado larga',
    'passwords_different' => 'La confirmación de contraseña no coincide con la contraseña inicial',
    'bad_first_name' => 'or favor, introduzca su nombre, debe ser de entre 2 y 20 caracteres.',
    'bad_last_name'=> 'Por favor, introduzca su nombre, debe ser de entre 2 y 20 caracteres.',
    'insecure_password' => 'Para su seguridad, la contraseña debe ser diferente de su información personal (nombre de usuario, nombre y apellidos).',
    'remove_install_folder' => 'Por favor, elimine la carpeta &laquo;_install&raquo; de su servidor antes de usar su sitio web.',
    'remove_install_folder_auto' => 'Eliminar automáticamente el directorio &laquo;install&raquo; (esto requiere derechos de acceso para borrar el directorio &laquo;install&raquo;).',
    'confirm_remove_install_folder_auto' => 'ADVERTENCIA, se eliminarán todos los archivos de la carpeta /_install/.',
    'title_email_finish_install' => 'Acerca de la instalación: Información',
    'content_email_finish_install' => '<p><strong>¡Enhorabuena, tu sitio web está instalado correctamente!</strong></p>
    <p>¡Esperamos que usted disfrute de <em>' . Controller::SOFTWARE_NAME . '</em>!</p>
    <p>La URL de su propio sitio web es: <a href="' . PH7_URL_ROOT . '">' . PH7_URL_ROOT . '</a></p>
    <p></p>Tu Panel de Administración URL es: <a href="' . PH7_URL_ROOT . 'admin123/">' . PH7_URL_ROOT . 'admin123/</a></p>
    <p>No se olvide de mostrar al mostrar su nuevo sitio de citas para todos sus amigos, sus colegas y compañeros de su Facebook (e incluso a sus enemigos ... o no).</p>
    <p>Por último, si no lo has hecho todavía, es un muy buen momento para comprar hoy una clave de licencia, simplemente <a href="' . Controller::SOFTWARE_LICENSE_KEY_URL . '" target="_blank">visitando nuestra página web</a> con el fin de obtener las características premium, quite todos los enlaces y notas de copyright en su sitio web e incluso el acceso a la ilimitada ticket de soporte.</p>
    <p>&nbps;</p>
    <p>P.D. Para informes de errores, sugerencias, colaboración, participación en el desarrollo y / o traducción de software, etc,
    por favor visite nuestro <a href="' . Controller::SOFTWARE_WEBSITE . '">sitio web</a>.</p>
    <p>---</p>
    <p>Saludos cordiales,</p>
    <p>El equipo de desarrolladores pH7CMS.</p>',
    'yes_dir' => '¡El directorio se encuentra correctamente!',
    'no_dir' => 'El directorio no existe.',
    'wait_importing_database' => 'Espere al importar la base de datos por favor.<br />
    Esto puede tardar varios minutos.',
    'service' => 'Servicios adicionales útiles',
    'buy_copyright_license_title' => 'Comprar una licencia',
    'buy_copyright_license' => '<span class="gray">Licencia de por vida</span> <span class="right">Compre ahora</span>',
    'buy_copyright_license_desc' => 'Al comprar una licencia, usted no tendrá ningún vínculo y avisos de copyright en su sitio web, obtiene todas las características premium y usted también será capaz de actualizar/actualizarlo.',
    'buy_individual_ticket_support_title' => 'Compre un servicio de apoyo individual',
    'buy_individual_ticket_support' => '<span class="gray">Tickets de soporte completo durante un mes</span> <span class="right">Compre ahora</span>',
    'buy_individual_ticket_support_desc' => 'Al comprar el apoyo individual, le ayudaremos siempre que tenga un problema con nuestro software. Estamos a su disposición para resolver cualquier encuentro problema pH7CMS.',
    'looking_hosting' =>'¿Buscando un alojamiento web compatible con pH7CMS? ¡Vea <a href="' . Controller::SOFTWARE_HOSTING_LIST_URL . '" target="_blank">nuestra Lista de Alojamiento</a>!',
    'warning_no_js' => 'Esta página web no es compatible sin tener Javascript activado.<br />
    Por favor, activa JavaScript en las opciones de su navegador web.',
    'powered' => 'Desarrollado por',
    'loading' => 'Cargando ...',
);
