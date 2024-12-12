<?php
function print_error_messages($errors)
{
    if (!empty($errors)) {
        print "<p class='text--error'>Εντοπίστηκε πρόβλημα!\n";
        print "<ul class='text--error'>\n";
        foreach ($errors as $msg) {
            print "<li> $msg!</li>\n";
        }
        print "</ul></p>\n";
    }
}

function print_access_denied()
{
    print "<p style='color:red;'>Δεν ήταν δυνατή η πρόσβαση στη σελίδα.</p>\n";
}

function print_input($type, $name, $label, $value=NULL, $readonly=NULL)
{
    $nonlabel = ['submit', 'hidden'];
    $print_label = !in_array($type, $nonlabel);

    print "<p>";
    if ($print_label) {
        print "<label for='$name'>$label: ";
    }
    print "<input type='$type' name='$name'";
    if ($type == 'text') {
        print " maxsize='100'";
    }
    if ($value != NULL && $type != 'password') {
        $value = strip_tags($value);
        print " value='$value'";
    }
    if ($readonly) {
        print " readonly='readonly'";
    }
    print ">";
    if ($print_label) {
        print "</label>";
    }
    print "</p>\n";
}

function print_textarea($name, $label, $value=NULL, $readonly=NULL)
{
    print "<p><label for='$name'>$label: <textarea name='$name' rows='5' cols='40'";
    if ($readonly) {
        print " readonly='readonly'";
    }
    print ">";
    if ($value != NULL) {
        $value = strip_tags($value);
        print $value;
    }
    print "</textarea></label></p>\n";
}

function print_checkbox_input($type, $name, $label, $value, $feedback=NULL)
{
    print("<p>");
    print("<input type='$type' name='$name' value='$value'");
    if (!empty($feedback)) {
        if (is_array($value) && in_array($value, $feedback)) {
            print(" checked='checked'");
        } else {
            print(" checked='checked'");
        }
    }
    print(">$label");
    print("</p>\n");
}

function print_quote_form($id=NULL, $quote=NULL, $source=NULL, $favorite=NULL, $submit='Ανάρτηση', $readonly=NULL)
{
    print "<form action='' method='post'>\n";
    print_textarea('quote', 'Κείμενο Ανάρτησης', $quote, $readonly);
    print_input('text', 'source', 'Πηγή', $source, $readonly);
    print_checkbox_input('checkbox', 'favorite', 'Αγαπημένο', 1, $favorite);
    if ($id != NULL)
        print_input('hidden', 'id', NULL, $id);
    print_input('submit', 'submit', NULL, $submit);
    print "</form>\n";
}

function check_quote_input($quote=NULL, $source=NULL, $favorite=NULL)
{
    $errors = [];
    if (empty($quote)) {
        $errors[] = 'Παρακαλώ εισάγετε ρητό';
    }
    if (empty($source)) {
        $errors[] = 'Παρακαλώ εισάγετε πηγή';
    }
    if (!empty($errors)) {
        print_error_messages($errors);
        return false;
    }
    return true;
}

function is_loggedin()
{
    if (isset($_SESSION['username']) && isset($_SESSION['agent']) &&
        sha1($_SERVER['HTTP_USER_AGENT']) == $_SESSION['agent']) {
        return true;
    } else {
        return false;
    }
}

function check_session()
{
    if (!is_loggedin()) {
        header("Location: error.php\n"); // Ανακατεύθυνση στη σελίδα λάθους
        exit();
    }
}

function check_no_session()
{
    if (is_loggedin()) {
        header("Location: login_error.php\n"); // Ανακατεύθυνση στη σελίδα λάθους
        exit();
    }
}
?>