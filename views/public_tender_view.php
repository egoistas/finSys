<?php 
    $title = "Διαγωνισμός";
    $currentPage = "public_tender_view.php";
    require ('../templates/header.php');

?>

<main>

    <!-- Αρχή ΒΑΣΙΚΟ CONTAINER-->
    <div class="container shadow min-vh-100 py-2 my-2">
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
    <form action="" method="post" name="insert_public_tender" id="publicTenderForm"
          class="m-2 was-validated"> <!--was-validated -->
        <div class="justify-content-center align-items-center h-75 mx-0 my-0">
        <div class="col-xl-12">
                    <div class="containter-fluid d-flex justify-content-end">
                      <button type="button" name="cancelButton" id="cancelButton" class="btn btn-close m-2"></button>
                    </div>
        <div class="card-title text-center fs-3 fw-lighter m-0">Φόρμα Καταχώρησης Διαγωνισμού</div>  
        <div class="card-body p-md-4"> 
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--1ο σετ-->
                <div class="form-floating mb-3 col-lg-6">
                    <input  name="idPUBLIC_TENDER" id="idPUBLIC_TENDER" type="text" 
                            class="form-control" placeholder="Αναγνωριστικό Διαγωνισμού" required />
                    <label class="float" for="idPUBLIC_TENDER">Αναγνωριστικό Διαγωνισμού</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-6">
                    <input name="WRIT" id="WRIT" type="text" placeholder="Ταυτότητα εγγράφου" required 
                           class="form-control" />
                    <label for="WRIT">Ταυτότητα εγγράφου</label>
                    <div class="invalid-feedback" >Υποχρεωτικό πεδίο</div>
                </div>
            </div><!--1ο σετ-->  
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--2ο σετ-->   
                <div class="form-floating mb-3 col-lg-4">
                    <input disabled name="DEPARTMENT" id="DEPARTMENT" placeholder="Τμήμα Διαχείρισης" required 
                           class="form-control" type="text" />
                    <label for="DEPARTMENT">Τμήμα Διαχείρισης</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>         
                <div class="form-floating mb-3 col-lg-4">
                    <select name="TYPE" id="TYPE" class="form-select" aria-label="Είδος Διαγωνισμού"
                        required>
                        <option value=""> Επιλογή </option>
                        <option value="0"> Σύμβαση </option>
                        <option value="1"> Συμφωνία-Πλαίσιο </option>
                    </select>
                    <label for="TYPE">Είδος Διαγωνισμού</label>
                </div>
                <div class="form-floating mb-3 col-lg-4">
                    <input name="BUDGET" id="BUDGET" type="number" min="0" placeholder="Προϋπολογισμός" required 
                           class="form-control"/>
                    <label for="BUDGET">Προϋπολογισμός</label>
                    <div class="invalid-feedback" >Υποχρεωτικό πεδίο</div>
                </div>
            </div> <!--2ο σετ-->
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--3ο σετ-->                
                <div class="form-floating mb-3 col-lg-4">
                    <input name="CPV" id="CPV" type="text" placeholder="CPV" required  
                           class="form-control"/>
                    <label for="CPV">CPV</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-4">
                    <input name="QUANTITY" id="QUANTITY" type="number" min="0" placeholder="Ποσότητα" required  
                           class="form-control"/>
                    <label for="QUANTITY">Ποσότητα</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-4">
                    <select name="TECHNICAL_SPECIFICATION" id="TECHNICAL_SPECIFICATION" aria-label="Τεχνική Προδιαγραφή"
                            class="form-select">
                        <option value="Επιλογή">Επιλογή</option>
                        <option value="1">ΝΑΙ</option>
                        <option value="0">ΟΧΙ</option>
                    </select>
                    <label for="TECHNICAL_SPECIFICATION">Τεχνική Προδιαγραφή</label>
                </div>
            </div><!--3ο σετ-->        
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"><!--4ο σετ-->
                <div class="form-floating mb-3 col-lg-6">
                    <input name="UNIT_OF_DELIVERY" id="UNIT_OF_DELIVERY" type="text" placeholder="Μονάδα παράδοσης" required 
                           class="form-control" />
                    <label for="UNIT_OF_DELIVERY">Μονάδα παράδοσης</label>
                    <div class="invalid-feedback" >Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-6">
                    <input name="PERFORMANCE_BONDS" id="PERFORMANCE_BONDS"
                           class="form-control" type="number" placeholder="Εγγύηση" required/>
                    <label for="PERFORMANCE_BONDS">Εγγύηση</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div> 
            </div> <!--4ο σετ-->
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"><!--5ο σετ-->
                <div class="form-floating mb-3 col-lg-3">
                    <select name="DIVIDABILITY_BY_QUANTITY" id="DIVIDABILITY_BY_QUANTITY" aria-label="ΚΑΤΑΤΜΗΣΗ ΑΝΑ ΠΟΣΟΤΗΤΑ"
                            class="form-select">
                        <option value="Επιλογή">Επιλογή</option>
                        <option value="1"> ΝΑΙ </option>
                        <option value="0"> ΟΧΙ </option>
                    </select>
                    <label for="DIVIDABILITY_BY_QUANTITY">Κατάτμηση ανά ποσότητα</label>
                </div>
                <div class="form-floating mb-3 col-lg-3">
                    <select name="DIVIDABILITY_BY_CPV" id="DIVIDABILITY_BY_CPV"
                            class="form-select" aria-label="ΚΑΤΑΤΜΗΣΗ ΑΝΑ CPV">
                        <option value="none">Επιλογή</option>
                        <option value=1> ΝΑΙ </option>
                        <option value=0> ΟΧΙ </option>
                    </select>
                    <label for="DIVIDABILITY_BY_CPV">Κατάτμηση ανά CPV</label>
                </div>
                <div class="form-floating mb-3 col-lg-3">
                    <input name="ADA" id="ADA" type="text" placeholder="ADA" 
                           class="form-control" />
                    <label for="ADA">ADA</label>
                </div> 
                <div class="form-floating mb-3 col-lg-3">
                <input name="ADAM" id="ADAM" type="text" placeholder="ADAM" class="form-control"
                           class="form-control" />
                    <label for="ADAM">ADAM</label>
                </div> 
            </div><!--5ο σετ-->    
    <!---------------------------------------------------------------------------------------------------------------------------------------------->        
            <div class="row"><!--6ο σετ-->    
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input name="SIGN_DATE" id="SIGN_DATE" type="text"
                               class="form-control" placeholder="Ημερομηνία υπογραφής" required onfocus="(this.type='date')"/>
                        <label for="SIGN_DATE">Ημερομηνία υπογραφής</label>
                        <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input name="PUBLICATION_DATE" id="PUBLICATION_DATE" type="text" 
                               class="form-control" placeholder="Ημερομηνία δημοσίευσης" required onfocus="(this.type='date')" />
                        <label for="PUBLICATION_DATE">Ημερομηνία δημοσίευσης</label>
                        <div class="invalid-feedback" required>Υποχρεωτικό πεδίο</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input name="OFFER_LAST_DATE" id="OFFER_LAST_DAT" type="text" 
                               placeholder="Ημερομηνία τελευταίας προσφοράς" required
                               class="form-control" onfocus="(this.type='date')" />
                        <label for="OFFER_LAST_DATE">Ημερομηνία τελευταίας προσφοράς</label>
                        <div class="invalid-feedback" data-sb-feedback="ημερομηνίαΤελευταίαςΠροσφοράς:required">Υποχρεωτικό πεδίο</div>
                    </div>
                </div>
            </div><!--5ο σετ-->    
    <!-----------------------------------ΚΟΥΜΠΙΑ------------------------------------------------------------------------------------->                    
            <div class="row justify-content-end mb-2"> <!-- Κάτω μέρος της φόρμας με διάταξη Flex και δικαίωμα στοίχιση -->
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
<!-- Τέλος ΒΑΣΙΚΟ CONTAINER-->

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
            url: "../handlers/handle_public_tender_view.php",
            data: { x: JSON.stringify({ limit: 1050 }) },
            success: function (data) {
                // Δημιουργία DataTable με δυναμικές στήλες
                var table = $('#db_table').DataTable({
                    data: data,
                    language: language,
                    columns: [
                       //{data: 'idPINAKA_PUBLIC_TENDER', title: 'idPINAKA_PUBLIC_TENDER',visible: false},
                        {data: 'idPUBLIC_TENDER', title: 'Διαγωνισμός'},
                        {data: 'WRIT', title: 'Ταυτότητα Εγγράφου'},
                        {data: 'TYPE', title: 'Είδος'},
                        {data: 'DEPARTMENT', title: 'Τμήμα Διαχείρισης'},
                        {data: 'CPV', title: 'CPV'},
                        {data: 'BUDGET', title: 'Προϋπολογισμός'},
                        { data: 'TECHNICAL_SPECIFICATION', 
                          title: 'Τεχνική Προδιαγραφή',
                            render: function(data) {
                                return data === 1 ? 'ΝΑΙ' : 'ΟΧΙ';
                            },},
                        {data: 'UNIT_OF_DELIVERY', title: 'Μονάδα Παράδοσης'},
                        {data: 'DIVIDABILITY_BY_CPV',
                            title: 'Κατάτμηση ανά CPV',
                            render: function(data) {
                                return data === 1 ? 'ΝΑΙ' : 'ΟΧΙ';
                            },
                        },
                        {data: 'DIVIDABILITY_BY_QUANTITY',
                            title: 'Κατάτμηση ανά Ποσότητα',
                            render: function(data) {
                                return data === 1 ? 'ΝΑΙ' : 'ΟΧΙ';
                            },
                        },
                        {data: 'PERFORMANCE_BONDS', title: 'Εγγύηση'},
                        {data: 'ADA', title: 'ADA'},
                        {data: 'ADAM', title: 'ADAM'},
                        {data: 'SIGN_DATE', title: 'Ημερομηνία Υπογραφής'},
                        {data: 'PUBLICATION_DATE', title: 'Ημερομηνία Δημοσίευσης'},
                        {data: 'OFFER_LAST_DATE', title: 'Ημερομηνία Τελευταίας Προσφοράς'},
                        {data: 'STAGE' , title: 'Στάδιο διαγωνισμού'}
                    ],
                    responsive: true, // Enable responsive για να προσαρμοστεί στο μέγεθος της οθόνης
                    buttons: [ 
                        { extend: 'excel', text: 'Excel', className: 'btn-success'  },
                        { extend: 'colvis', text: 'Ορατότητα Στηλών', className: 'btn-light' },
                        {
                            text: 'Καταχώριση Διαγωνισμού',
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
       $('#publicTenderForm').submit(function(event) {
            event.preventDefault();
            // Συλλογή δεδομένων από τη φόρμα
            var formData = $(this).serialize();
        
    // Αποστολή δεδομένων μέσω AJAX
    $.ajax({
        type: 'POST',
        url: '../handlers/insert_public_tender.php',
        data: formData,
            success: function(response) {
                if (response.success) {
                    $('#publicTenderForm').trigger('reset');//Επαναφορά της φόρμας
                    $('#successMessage').removeClass('hide');//Εμφάνιση μηνύματος επιτυχίας
                    $('#successMessage .toast-body').text(response.message);//Εμφάνιση μηνύματος 
                    $('#successMessage').toast('show');//Εμφάνιση μηνύματος
                } else {
                    $('#errorMessage').removeClass('hide');
                    $('#errorMessage .toast-body').text(response.message);
                    $('#errorMessage').toast('show');
                }
                //console.log(response);//Αν θέλουμε να δούμε την απάντηση στο console του browser
            },
             error: function(xhr, status, error) {
            console.error(error);
            // Εμφάνιση μηνύματος σε περίπτωση σφάλματος
                    //alert('Παρουσιάστηκε σφάλμα κατά την υποβολή της φόρμας.');
                    console.error(xhr.responseText);
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
            var form = document.getElementById('publicTenderForm');
            form.reset();
        }
        //  addEventListener στο κουμπί Αναίρεση
        document.getElementById('reset_btn').addEventListener('click', resetForm);

</script>



    <?php
    include "../templates/footer.php"; // Προσθήκη του footer
    ?>
    
</body>

</html>
