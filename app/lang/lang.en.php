<?php
// CamelCase Recommended
// Errors
$lang->loginError = 'Login required!';
$lang->emailError = 'Sorry, there is no user with an email of "{{ email }}".';
$lang->passwordError = 'Password does not match.';

// Form elements
$lang->loginEmail = 'Email';
$lang->loginPassword = 'Password';
$lang->loginSubmit = 'Login';

// Texts
$lang->homeContent = <<<TEXT
<p>English © You can see that this is generated with the &copy; html entity.</p>
<p>This is just PHP so you can use Heredoc for longer text. Heredoc text behaves just like a double-quoted string, without the double quotes. This means that quotes in a heredoc do not need to be escaped, but the escape codes listed above can still be used. Variables are expanded, but the same care must be taken when expressing complex variables inside a heredoc as with strings.</p>
TEXT;
$lang->user = $app->view->getData('user');
$lang->hello = "Hello World!";
$lang->browsehappy = "You are using an <strong>outdated</strong> browser. Please <a href=\"http://browsehappy.com/\">upgrade your browser</a> to improve your experience.";
$lang->logout = 'Log out';

//Navigation items
$lang->link1 = 'Link 1';
$lang->link2 = 'Link 2';
$lang->link3 = 'Link 3';
$lang->dropdown = 'Dropdown';
$lang->navHeader = 'Social';
$lang->google = 'Google';
$lang->facebook ='Facebook';
?>
