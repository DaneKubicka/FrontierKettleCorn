<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address

$receiving_email_address = 'contact@frontierkettlecorn.com';

$php_email_form = '../assets/vendor/php-email-form/php-email-form.php';
if (!file_exists($php_email_form)) {
  die('Unable to load the "PHP Email Form" Library!');
}
include($php_email_form);

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name  = strip_tags($_POST['name']);
$contact->from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$contact->subject    = strip_tags($_POST['subject']);

$contact->smtp = array(
  'host' => 'smtp.porkbun.com',
  'username' => 'contact@frontierkettlecorn.com',
  'password' => getenv('SMTP_PASSWORD'), // safer
  'port' => '587',
  'security' => 'tls'
);

$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

echo $contact->send();

?>
