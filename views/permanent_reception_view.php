<?php 

    $title = "Απόφαση παραλαβής";
    $currentPage = "permanent_reception_view.php";
    require ('../templates/header.php');

?>
    <!-- ΒΑΣΙΚΟ CONTAINER-->
    <div id = db_table_wrapper class="container shadow min-vh-100 py-2">
        <div class="row">
            <div class="col">
                <!-- data table Α -->
                <table id="db_table" class="table table-sm table-striped" style="width: 100%; max-width: 100%;">

                   
                </table>
                <!-- data table Ω -->
            </div>           
        </div>
    </div>        
    <!-- ΒΑΣΙΚΟ CONTAINER-->
<!-- Φόρμα καταχώρησης ------------------------------------------------------------------------------------------------------------------------->        
<!--ΑΝΑΔΥΟΜΕΝΗ ΦΟΡΜΑ ΜΕ JQuery #entryForm ΚΡΥΦΗ ***display:none*** ΣΗΜΑΝΤΙΚΟ!!!-->
<div id="entryForm" class="position-absolute start-50 translate-middle-x p-3" style="display:none; margin: 5% auto; top:5% ">
    <div class="card shadow-lg d-flex" style="min-width: fit-content;">
    <form action="#" method="post" name="insert_permanent_reception" id="permanentReceptionForm"
          class="m-2 was-validated"> <!--was-validated -->
        <div class="justify-content-center align-items-center h-75 mx-0 my-0">
        <div class="col-xl-12">
                    <div class="containter-fluid d-flex justify-content-end">
                      <button type="button" name="cancelButton" id="cancelButton" class="btn btn-close m-2"></button>
                    </div>
        <div class="card-title text-center fs-3 fw-lighter m-0">Φόρμα Καταχώρησης Απόφασης Παραλαβής</div>  
        <div class="card-body p-md-4"> 
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--1ο σετ-->
                <div class="form-floating mb-3 col-lg-4">
                    <select required 
                        name="idCONTRACT" id="contractDropdown" class="form-select" aria-label="Αναγνωριστικό Σύμβασης">
                        <option value=""> Επιλογή </option>
                    </select>
                    <label for="idCONTRACT">Αναγνωριστικό Σύμβασης</label>
                </div>    
                <div class="form-floating mb-3 col-lg-4">
                    <input required
                           name="idRECEIPT_DECISION" id="idRECEIPT_DECISION" placeholder="ΑπόφασΧΧΧΧΧη προσωρινού αναδόχου" required 
                           class="form-control" type="text" />
                    <label for="idTEMPORARY_CONTRACTOR_DECISION">Απόφαση παραλαβής</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-4">
                    <input name="RECEIPT_QUANTITY" id="RECEIPT_QUANTITY" placeholder="Ποσότητα παραλαβής" 
                           class="form-control" type="number" min="0" />
                    <label for="RECEIPT_QUANTITY">Ποσότητα παραλαβής</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
            </div><!--1ο σετ-->  
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--2ο σετ-->   
                <div class="col-lg-4">
                    <div class="form-floating mb-4">
                        <input name="SIGN_DATE" id="SIGN_DATE" type="text" onfocus="(this.type='date')"
                               class="form-control" placeholder="Ημερομηνία υπογραφής" required />
                        <label for="SIGN_DATE">Ημερομηνία υπογραφής</label>
                        <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                    </div>
                </div>    
                <div class="col-lg-4">
                    <div class="form-floating mb-4">
                        <input name="RECEPTION_DATE" id="RECEPTION_DATE" type="text" onfocus="(this.type='date')"
                               class="form-control" placeholder="Ημερομηνία Παραλαβής" required />
                        <label for="RECEPTION_DATE">Ημερομηνία Παραλαβής</label>
                        <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                    </div>
                </div>    
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input name="FINE" id="FINE" type="number" placeholder="Πρόστιμο" required
                               class="form-control"/>
                        <label for="Fine">Πρόστιμο</label>
                        <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                    </div>
                </div>
            </div> <!--2ο σετ-->
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
   
    <!-----------------------------------ΚΟΥΜΠΙΑ------------------------------------------------------------------------------------->                    
            <div class="row justify-content-end mb-3"> <!-- Κάτω μέρος της φόρμας με διάταξη Flex και δικαίωμα στοίχιση -->
                <div class="col-lg-2 d-flex justify-content-end"> <!-- Κουμπιά -->
                    <button type="button" id="reset_btn" class="btn btn-outline-warning reset-btn mx-2 fw-semibold">Αναίρεση όλων</button>
                    <button type="submit" name="submit" id="submit" class="btn btn-outline-success submit-btn mx-2 fw-semibold">Υποβολή για καταχώρηση</button>
                </div>
            </div>
    <!---------------------------------------------------------------------------------------------------------------------------------------------->        
        </div>
        </div>
      </div>
    </form>
    </div>
    <!-- Φόρμα καταχώρησης ------------------------------------------------------------------------------------------------------------------------->      
<!-- ALERTS-->
<div id="successMessage" class="position-fixed top-50 start-50 translate-middle toast hide" style="z-index: 9999; width: 400px;">
    <div class="toast-header bg-success text-white">
        <strong class="me-auto fs-4 fw-semibold">Επιτυχία καταχώρησης</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body fs-4 fw-lighter"> 
        <!--Μήνυμα από php-->
    </div>
</div>
<div id="errorMessage" class="position-fixed top-50 start-50 translate-middle toast hide" style="z-index: 9999; width: 400px;">
    <div class="toast-header bg-danger text-white">
        <strong class="me-auto fs-4 fw-semibold">Αποτυχία καταχώρησης</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body fs-4 fw-lighter"> 
        <!--Μήνυμα από php-->
    </div>
</div>
<!-- ALERTS-->

    <script>
    $(document).ready(function () {
        // Καθορισμός της γλώσσας του DataTable στα ελληνικά
        var language = {
            "sProcessing":   "Επεξεργασία...",
            "sLengthMenu":   "Εμφάνιση _MENU_ εγγραφών ανά σελίδα",
            "sZeroRecords":  "Δεν βρέθηκαν αποτελέσματα",
            "sInfo":         "Εμφανίζονται _START_ έως _END_ από σύνολο _TOTAL_ εγγραφών",
            "sInfoEmpty":    "Εμφανίζονται 0 έως 0 από σύνολο 0 εγγραφών",
            "sInfoFiltered": "(φιλτραρισμένες από _MAX_ συνολικά εγγραφές)",
            "sInfoPostFix":  "",
            "sSearch":       "Αναζήτηση:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Πρώτη",
                "sPrevious": "Προηγούμενη",
                "sNext":     "Επόμενη",
                "sLast":     "Τελευταία"
            },
            "oAria": {
                "sSortAscending":  ": Αύξουσα ταξινόμηση",
                "sSortDescending": ": Φθίνουσα ταξινόμηση"
            }
        };

        // ajax request για να φέρει τα δεδομένα
        $.ajax({
            type: "POST",
            url: "../handlers/handle_permanent_reception_view.php",
            data: { x: JSON.stringify({ limit: 1050 }) },
            success: function (data) {
                // Δημιουργία DataTable με δυναμικές στήλες
                var table = $('#db_table').DataTable({
                    language: language,
                    data: data,
                    columns: [
                       // {data: 'idPINAKA_RECEIPT_DECISION', title: 'idPINAKA_TEMPORARY_CONTRACTOR', visible: false},
                        {data: 'idRECEIPT_DECISION', title: 'Απόφαση Παραλαβής'},
                       // {data: 'idPINAKA_CONTRACT', title: 'idPINAKA_CONTRACT', visible: false},
                       // {data: 'idPINAKA_EXECUTIVE_CONTRACT', title: 'idPINAKA_EXECUTIVE_CONTRACT',visible: false},
                        {data: 'RECEIPT_QUANTITY', title: 'Ποσότητα Παραλαβής'},
                        {data: 'RECEPTION_DATE', title: 'Ημερομηνία Παραλαβής'},
                        {data: 'SIGN_DATE', title: 'Ημερομηνία Υπογραφής'},
                        {data: 'FINE', title: 'Πρόστιμο'}
                    ],
                    //columns: Object.keys(data[0]).map(function (key) {
                      //  return { data: key, title: key };
                    //}),
                    responsive: true, // Enable responsive για να προσαρμοστεί στο μέγεθος της οθόνης
                    buttons: [ 
                        { extend: 'excel', text: 'Excel', className: 'btn-success'  },
                        { extend: 'colvis', text: 'Ορατότητα Στηλών', className: 'btn-light' },
                        {
                            text: 'Καταχώρηση Απόφασης Παραλαβής',
                            className: 'btn-light',
                            action: function () {
                                // Εμφάνιση της φόρμας καταχώρησης όταν πατηθεί το κουμπί
                                $('#entryForm').show();
                            }
                        }
                    ] //Δυνατότητα: 'copy', 'pdf'
                });

                // Τοποθέτηση του container των κουμπιών στο #db_table_wrapper
                table.buttons().container()
                    .appendTo( '#db_table_wrapper .col-md-6:eq(0)' );
            },
            dataType: "json"
        });

        // Υποβολή της φόρμας καταχώρησης μέσω AJAX
        $('#permanentReceptionForm').submit(function (event) {
            event.preventDefault(); // Αποτροπή της προεπιλεγμένης συμπεριφοράς υποβολής φόρμας
            
            // Συλλογή δεδομένων από τη φόρμα
            var formData = $(this).serialize();
            
            // Αποστολή δεδομένων μέσω AJAX
            $.ajax({
                type: 'POST',
                url: '../handlers/insert_to_reception.php', // Το PHP που διαχειρίζεται τα δεδομένα
                data: formData,
                success: function(response) {
                    if (response.success) {
                    $('#permanentReceptionForm').trigger('reset');//Επαναφορά της φόρμας
                    $('#successMessage').removeClass('hide');//Εμφάνιση μηνύματος επιτυχίας
                    $('#successMessage .toast-body').text(response.message);//Εμφάνιση μηνύματος JSON
                    $('#successMessage').toast('show');//Εμφάνιση μηνύματος
                    console.log(response);
                } else {
                    $('#errorMessage').removeClass('hide');
                    //$('#errorMessage .toast-body').text(response.message);//Απόκρυψη μηνύματος JSON
                    $('#errorMessage .toast-body').text('Σφάλμα εισαγωγής στη ΒΔ. Ελέγξτε πως έχετε ακολουθήσει σωστά το πρωτόκολο εισαγωγής. Αν χρειάζεστε βοήθεια επικοινωνήστε με τον διαχειριστή!');
                    $('#errorMessage').toast('show');
                    console.log(response);
                    }
                    //console.log(response);//Αν θέλουμε να δούμε το JSON αντί για το μήνυμα
                },
                error: function(xhr, status, error) {//Σε περίπτωση σφάλματος
                    console.error(xhr.responseText);//Εμφάνιση μηνύματος JSON
                    $('#errorMessage').removeClass('hide');
                    $('#errorMessage .toast-body').text('Σφάλμα εισαγωγής στη ΒΔ: ' + xhr.responseText);//Εμφάνιση μηνύματος JSON
                    $('#errorMessage').toast('show');
                }
            });//Τέλος AJAX
        });//Τέλος Υποβολής Φόρμας

        // Κρύψιμο της φόρμας καταχώρησης όταν πατηθεί το κουμπί Ακύρωση
        $('#cancelButton').click(function() {
            $('#entryForm').hide();
        });
    });

        // Συνάρτηση για επαναφορά της φόρμας καταχώρησης
        function resetForm() {
            var form = document.getElementById('permanentReceptionForm');
            form.reset();
        }
        //  addEventListener στο κουμπί Αναίρεση
        document.getElementById('reset_btn').addEventListener('click', resetForm);




 // Συνάρτηση για να γεμίσει το πρώτο dropdown με επιλογές
 $(document).ready(function() {
    // Φόρτωση των επιλογών στο πρώτο dropdown με AJAX
    $.get('../handlers/show_contract_for_reception.php', function(options) {
        populateDropdown(options);
    });


// Συνάρτηση για να γεμίσει το πρώτο dropdown με επιλογές
function populateDropdown(options) {
    var contractDropdown = $('#contractDropdown');
    options.forEach(function(option) {
        $('<option>').val(option).text(option).appendTo(contractDropdown);
    });
}
});
    

</script>


    <?php
    include "../templates/footer.php"; // Include the footer
    ?>
</body>

</html>
