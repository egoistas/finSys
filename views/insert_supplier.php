<?php 
    
    
    $title = "Αρχική";
    $currentPage = "home.php";
    require ('../templates/header.php');
     

?>
    <!-- ΒΑΣΙΚΟ CONTAINER-->
            
    
  <!-- Φόρμα καταχώρησης ------------------------------------------------------------------------------------------------------------------------->        
<!--ΑΝΑΔΥΟΜΕΝΗ ΦΟΡΜΑ ΜΕ JQuery #entryForm ΚΡΥΦΗ ***display:none*** ΣΗΜΑΝΤΙΚΟ!!!-->
<div id="entryForm" class="position-absolute start-50 translate-middle-x p-3" style="margin: 5% auto; top:5% ">
    <div class="card shadow-lg d-flex" style="min-width: fit-content;">
    <form action="../temp/insert_sup_correct.php" method="post" name="insert_public_tender" id="supplierOfferForm"
          class="m-2 was-validated"> <!--was-validated -->
        <div class="justify-content-center align-items-center h-75 mx-0 my-0">
        <div class="col-xl-12">
                    <!--<div class="containter-fluid d-flex justify-content-end">
                      <button type="button" name="cancelButton" id="cancelButton" class="btn btn-close m-2"></button>
                    </div>-->
        <div class="card-title text-center fs-3 fw-lighter m-0">Φόρμα Καταχώρησης Προμηθευτή σε Διαγωνισμό</div>  
        <div class="card-body p-md-4"> 
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--1ο σετ-->
            <div class="form-floating mb-3 col-lg-4">
                    <select name="idPUBLIC_TENDER" id="firstDropdown" class="form-select" aria-label="Αναγνωριστικό Διαγωνισμού" required>
                        <option value=""> Επιλογή </option>
                    </select>
                    <label for="idPUBLIC_TENDER">Αναγνωριστικό Διαγωνισμού</label>
                </div>
                <div class="form-floating mb-3 col-lg-4">
                    <input name="AFM_SUPPLIER" id="AFM_SUPPLIER" type="text" min="0" placeholder="ΑΦΜ Προμηθευτή" required 
                           class="form-control"/>
                    <label for="AFM_SUPPLIER">ΑΦΜ Προμηθευτή</label>
                    <div class="invalid-feedback" >Υποχρεωτικό πεδίο</div>      
                </div>
                <div class="form-floating mb-3 col-lg-4">
                    <input name="NAME" id="NAME" placeholder="Επωνυμία" required 
                           class="form-control" type="text" />
                    <label for="NAME">Επωνυμία</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>  
            </div><!--1ο σετ-->  
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="row"> <!--2ο σετ-->       
                <div class="form-floating mb-3 col-lg-4">
                    <input name="HEADQUARTERS" id="HEADQUARTERS" type="text" placeholder="Έδρα" required 
                           class="form-control"/>
                    <label for="HEADQUARTERS">Έδρα</label>
                    <div class="invalid-feedback" >Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-4">
                    <input name="TELEPHONE" id="TELEPHONE" type="text" placeholder="Τηλέφωνο" required 
                           class="form-control"/>
                    <label for="TELEPHONE">Τηλέφωνο</label>
                    <div class="invalid-feedback" >Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-4">
                    <input name="EMAIL" id="EMAIL" type="email" placeholder="email" required  
                           class="form-control"/>
                    <label for="EMAIL">email</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
            </div> <!--2ο σετ-->
    <!---------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row"> <!--3ο σετ-->  
                <div class="form-floating mb-3 col-lg-3">
                    <input name="CPV" id="CPV" type="text" placeholder="CPV" required  
                           class="form-control"/>
                    <label for="CPV">CPV</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-3">
                    <input name="QUANTITY" id="QUANTITY" type="number" min='0' placeholder="Ποσότητα" required  
                           class="form-control"/>
                    <label for="QUANTITY">Ποσότητα</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-3">
                    <input name="PRICE_PER_UNIT" id="PRICE_PER_UNIT" type="number" min='0' placeholder="Τιμή ανά μοναδα" required  
                           class="form-control"/>
                    <label for="PRICE_PER_UNIT">Τιμή ανά μοναδα</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>
                <div class="form-floating mb-3 col-lg-3">
                    <input name="VAT" id="VAT" type="number" min='0' placeholder="ΦΠΑ" required  
                           class="form-control"/>
                    <label for="VAT">ΦΠΑ</label>
                    <div class="invalid-feedback">Υποχρεωτικό πεδίο</div>
                </div>    <!--3ο σετ-->
    </div>           
    <!-----------------------------------ΚΟΥΜΠΙΑ------------------------------------------------------------------------------------->                   
            <div class="row justify-content-end mb-2"> <!-- Κάτω μέρος της φόρμας με διάταξη Flex και δικαίωμα στοίχιση -->
                <div class="col-lg-2 d-flex justify-content-end"> <!-- Κουμπιά -->
                    <button type="button" id="reset_btn" class="btn btn-outline-warning reset-btn mx-2 fw-semibold">Αναίρεση όλων</button>
                    <button type="submit" name="submit" id="finalSubmitButton" class="btn btn-outline-success submit-btn mx-2 fw-semibold">Υποβολή για καταχώρηση</button>
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

    <script>

    // Συνάρτηση για επαναφορά της φόρμας καταχώρησης
    function resetForm() {
            var form = document.getElementById('supplierOfferForm');
            form.reset();
        }
        //  addEventListener στο κουμπί Αναίρεση
        document.getElementById('reset_btn').addEventListener('click', resetForm);



    window.onload = function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../temp/show_left_id.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var options = JSON.parse(xhr.responseText);
                populateDropdown(options);
            }
        };
        xhr.send();
    };

    function populateDropdown(options) {
        var firstDropdown = document.getElementById('firstDropdown');
        options.forEach(function(option) {
            var optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.textContent = option;
            firstDropdown.appendChild(optionElement);
        });
    }

    document.getElementById('firstDropdown').addEventListener('change', function() {
        var selectedId = this.value;
        if (selectedId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../temp/show_supplier_7th.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var suppliers = JSON.parse(xhr.responseText);
                    // populateSupplierDropdown(suppliers);
                }
            };
            xhr.send('id=' + selectedId);
        } else {
            alert('Please select an id first.');
        }
    });

    document.getElementById('finalSubmitButton').addEventListener('click', function() {
        var formData = new FormData(document.getElementById('dataForm'));
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../temp/insert_sup_correct.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById('responseMessage').textContent = response.message;
                    clearFormFields();
                    setTimeout(function() {
                        document.getElementById('responseMessage').textContent = '';
                    }, 2500); // 2500 milliseconds = 2.5 seconds
                } else {
                    document.getElementById('responseMessage').textContent = 'Form submission failed.';
                    setTimeout(function() {
                        document.getElementById('responseMessage').textContent = '';
                    }, 2500); // 2500 milliseconds = 2.5 seconds
                }
            }
        };
        xhr.send(formData);
    });
    </script>
    

    <?php
    include "../templates/footer.php"; // Include the footer
    ?>
</body>

</html>
