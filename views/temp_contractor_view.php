<?php 

    $title = "Απόφαση προσωρινού αναδόχου";
    $currentPage = "temp_contractor_view.php";
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
<!-- Φόρμα καταχώρησης ------------------------------------------------------------------------------------------------------------------------->        
<!--ΑΝΑΔΥΟΜΕΝΗ ΦΟΡΜΑ ΜΕ JQuery #entryForm ΚΡΥΦΗ ***display:none*** ΣΗΜΑΝΤΙΚΟ!!!-->
<div id="entryForm" class="position-absolute start-50 translate-middle-x p-3" style="display:none; margin: 5% auto; top:5% ">
    <div class="card shadow-lg d-flex" style="min-width: fit-content;">
    <form action="" method="post" name="insert_temp_contractor" id="tempContractorForm"
          class="m-2 was-validated"> <!--was-validated -->
        <div class="justify-content-center align-items-center h-75 mx-0 my-0">
        <div class="col-xl-12">
                    <div class="containter-fluid d-flex justify-content-end">
                      <button type="button" name="cancelButton" id="cancelButton" class="btn btn-close m-2"></button>
                    </div>
        <div class="card-title text-center fs-3 fw-lighter m-0">Φόρμα Καταχώρησης Προσωρινού Αναδόχου</div>  
        <div class="card-body p-md-4"> 
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--1ο σετ-->
                <div class="form-floating mb-3 col-lg-5">
                    <select required 
                        name="idPUBLIC_TENDER" id="firstDropdown" class="form-select" aria-label="Αναγνωριστικό Διαγωνισμού">
                        <option value=""> Επιλογή </option>
                    </select>
                    <label for="idPUBLIC_TENDER">Αναγνωριστικό Διαγωνισμού</label>
                </div>
                <div class="form-floating mb-3 col-lg-2">
                    <button id="select_idPUBLIC_TENDER" class="btn btn-outline-secondary">Εύρεση Προμηθευτών</button>
                </div>
                <div class="form-floating mb-3 col-lg-5">
                    <select name="AFM_SUPPLIER" id="secondDropdown" class="form-select" aria-label="ΑΦΜ Προμηθευτή">
                        <option value=""> Επιλογή </option>
                    </select>
                    <label for="AFM_SUPPLIER">ΑΦΜ Προμηθευτή</label>
                </div>
            </div><!--1ο σετ-->  
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--2ο σετ-->   
                <div class="form-floating mb-3 col-lg-4">
                    <input name="idTEMPORARY_CONTRACTOR_DECISION" id="idTEMPORARY_CONTRACTOR_DECISION" placeholder="ΑπόφασΧΧΧΧΧη προσωρινού αναδόχου" required 
                           class="form-control" type="text" />
                    <label for="idTEMPORARY_CONTRACTOR_DECISION">Απόφαση προσωρινού αναδόχου</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-2">
                    <input name="CPV" id="CPV" type="text" placeholder="CPV" required  
                           class="form-control"/>
                    <label for="CPV">CPV</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>         
                <div class="form-floating mb-3 col-lg-2">
                    <input name="QUANTITY" id="QUANTITY" placeholder="Ποσότητα" required 
                           class="form-control" type="number" min="0" />
                    <label for="QUANTITY">Ποσότητα</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>      
                <div class="form-floating mb-3 col-lg-4">
                    <input name="TOTAL_VALUE" id="TOTAL_VALUE" type="number" min="0" placeholder="Προϋπολογισμός" required 
                           class="form-control"/>
                    <label for="TOTAL_VALUE">Προϋπολογισμός</label>
                    <div class="invalid-feedback" >Υποχρεωτικό πεδίο</div>
                </div>
            </div> <!--2ο σετ-->
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"><!--3ο σετ-->    
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input name="SIGN_DATE" id="SIGN_DATE" type="text" onfocus="(this.type='date')"
                               class="form-control" placeholder="Ημερομηνία υπογραφής" required />
                        <label for="SIGN_DATE">Ημερομηνία υπογραφής</label>
                        <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input name="PUBLICATION_DATE" id="PUBLICATION_DATE" type="text" onfocus="(this.type='date')" 
                               class="form-control" placeholder="Ημερομηνία δημοσίευσης" required />
                        <label for="PUBLICATION_DATE">Ημερομηνία δημοσίευσης</label>
                        <div class="invalid-feedback" required>Υποχρεωτικό πεδίο</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input name="NUM_OF_APPEAL_DAYS" id="NUM_OF_APPEAL_DAYS" type="number" placeholder="Αριθμός Ημερών Προσφυγής" required
                               class="form-control"/>
                        <label for="NUM_OF_APPEAL_DAYS">Αριθμός Ημερών Προσφυγής</label>
                        <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                    </div>
                </div>
            </div><!--3ο σετ-->    
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

    </div>        
    <!-- ΒΑΣΙΚΟ CONTAINER-->


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
            url: "../handlers/handle_temp_contractor_view.php",
            data: { x: JSON.stringify({ limit: 1050 }) },
            success: function (data) {
                // Δημιουργία DataTable με δυναμικές στήλες
                var table = $('#db_table').DataTable({
                    language: language,
                    data: data,
                    columns: [
                        //{data: 'idPINAKA_TEMPORARY_CONTRACTOR', title: 'idPINAKA_TEMPORARY_CONTRACTOR', visible: false},
                        {data: 'idTEMPORARY_CONTRACTOR_DECISION', title: 'Απόφαση Προσωρινού Αναδόχου'},
                        //{data: 'idPINAKA_PUBLIC_TENDER', title: 'idPINAKA_PUBLIC_TENDER', visible: false},
                        {data: 'AFM_SUPPLIER', title: 'ΑΦΜ Προμηθευτή'},
                        {data: 'CPV', title: 'CPV'},
                        {data: 'QUANTITY', title: 'Ποσότητα'},
                        {data: 'TOTAL_VALUE', title: 'Συνολική Αξία'},
                        {data: 'SIGN_DATE', title: 'Ημερομηνία Υπογραφής'},
                        {data: 'PUBLICATION_DATE', title: 'Ημερομηνία Δημοσίευσης'},
                        {data: 'NUM_OF_APPEAL_DAYS', title: 'Αριθμός Ημερών Προσφυγής'}
                    ],
                    responsive: true, // Enable responsive για να προσαρμοστεί στο μέγεθος της οθόνης
                    buttons: [ 
                        { extend: 'excel', text: 'Excel', className: 'btn-success'  },
                        { extend: 'colvis', text: 'Ορατότητα Στηλών', className: 'btn-light' },
                        {
                            text: 'Καταχώρηση Απόφασης Προσωρινού Αναδόχου',
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
         $('#tempContractorForm').submit(function (event) {
            event.preventDefault(); // Αποτροπή της προεπιλεγμένης συμπεριφοράς υποβολής φόρμας
            
            // Συλλογή δεδομένων από τη φόρμα
            var formData = $(this).serialize();
            
            // Αποστολή δεδομένων μέσω AJAX
            $.ajax({
                type: 'POST',
                url: '../handlers/insert_temp_contractor.php', // Το PHP που διαχειρίζεται τα δεδομένα
                data: formData,
                success: function(response) {
                    if (response.success) {
                    $('#tempContractorForm').trigger('reset');//Επαναφορά της φόρμας
                    $('#successMessage').removeClass('hide');//Εμφάνιση μηνύματος επιτυχίας
                    $('#successMessage .toast-body').text(response.message);//Εμφάνιση μηνύματος 
                    $('#successMessage').toast('show');//Εμφάνιση μηνύματος
                } else {
                    $('#errorMessage').removeClass('hide');
                    $('#errorMessage .toast-body').text(response.message);
                    $('#errorMessage').toast('show');
                }
                //console.log(response);//Αν θέλουμε να δούμε την απάντηση στο console του brows
                },
                error: function(xhr, status, error) {
                    // σφάλμα στην αποστολή των δεδομένων
                    console.error(xhr.responseText); // εκτύπωση μηνύματος σφάλματος
                    $('#errorMessage').removeClass('hide');
                    $('#errorMessage .toast-body').text('Σφάλμα εισαγωγής στη ΒΔ: ' + xhr.responseText);
                    $('#errorMessage').toast('show');
                }
            });
        });

        // Κρύψιμο της φόρμας καταχώρησης όταν πατηθεί το κουμπί Ακύρωση
        $('#cancelButton').click(function() {
            $('#entryForm').hide();
        });
    });
        // Συνάρτηση για επαναφορά της φόρμας καταχώρησης
        function resetForm() {
            var form = document.getElementById('tempContractorForm');
            form.reset();
        }
        //  addEventListener στο κουμπί Αναίρεση
        document.getElementById('reset_btn').addEventListener('click', resetForm);



 // Συνάρτηση για να γεμίσει το πρώτο dropdown με επιλογές
        $(document).ready(function() {
    // Φόρτωση των επιλογών στο πρώτο dropdown με AJAX
    $.get('../handlers/show_filled_supp.php', function(options) {
        populateDropdown(options);
    });

    // eventListener για κλικ στο κουμπί επιλογής idPUBLIC_TENDER
    $('#select_idPUBLIC_TENDER').click(function() {
        var selectedId = $('#firstDropdown').val();
        if (selectedId) {
            // Αίτημα AJAX για να φορτώσει τους προμηθευτές για το επιλεγμένο idPUBLIC_TENDER
            $.post('../handlers/show_sup_to_temp.php', { id: selectedId }, function(suppliers) {
                populateSupplierDropdown(suppliers);
            });
        } else {
            alert('Παρακαλώ επιλέξτε Διαγωνισμό και πατήστε το κουμπί "Εύρεση Προμηθευτών".');
        }
    });
});

// Συνάρτηση για να γεμίσει το πρώτο dropdown με επιλογές
function populateDropdown(options) {
    var firstDropdown = $('#firstDropdown');
    options.forEach(function(option) {
        $('<option>').val(option).text(option).appendTo(firstDropdown);
    });
}

// Συνάρτηση για να γεμίσει το δεύτερο dropdown με προμηθευτές
function populateSupplierDropdown(suppliers) {
    var secondDropdown = $('#secondDropdown');
    // Εκκαθάριση των υπαρχόντων επιλογών
    secondDropdown.empty();
    suppliers.forEach(function(supplier) {
        $('<option>').val(supplier).text(supplier).appendTo(secondDropdown);
    });
}

</script>


    <?php
    include "../templates/footer.php"; // Include the footer
    ?>

