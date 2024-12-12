<?php
// Ορίζουμε τα μονοπάτια ως σταθερές ή μεταβλητές
const PATH_PROJECT = "ptixiaki"; //αυτό το αλλάζουμε στο: ΌΝΟΜΑ ΚΥΡΙΩΣ PROJECT ΦΑΚΕΛΟΥ στο htdocs
const PATH_VIEWS = PATH_PROJECT."/views";
/**
 * PATH_PROJECT: Χρησιμοποιείται μόνο για να ορίσει τον κυρίως φάκελο. Μπορούμε να συνεννοηθούμε
 * και να αντικαταστήσουμε απλά με τον όνομα του φακ΄έλου στα άλλα δύο paths
 * Περιέχει: "index"
 * 
 * PATH_VIEWS: 
 * Περιέχει:
 *             "public_tender_view", 
 *             "contract_view",
 *             "framework_agreement_view",
 *             "contract_view", 
 *             "awarding_contractor_view",
 *             "temp_contractor_view",
 *             "permanent_reception_view",
 *             "login",
 *             "logout_confirmation",
 *             "logout",
 *             "register", ΟΧΙ ΑΚΟΜΗ
 *             "error_403",
 *             "error_503"
 */

// Συνάρτηση για ανακατεύθυνση με χρήση των μονοπατιών
function redirect(string $page, string $path): void {
    $fullPath = "https://localhost/" . $path . "/$page.php";
    if (!headers_sent()) {
        header("Location: $fullPath");
        exit();
    } else {
        echo "Headers already sent. Redirect failed.";
    }
}

/**
 * ΠΑΡΑΔΕΙΓΜΑΤΑ: redirect("pulic_tender,PATH_VIEWS");
 *               redirect("index",PATH_PROJECT); 
 */