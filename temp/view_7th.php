<!DOCTYPE html>
<html>
<head>
    <title>Dropdown from Database</title>
</head>
<body>

<form id="dataForm" method="post" action="insert_sup_correct.php">
    <select id="firstDropdown" name="idPUBLIC_TENDER">
        <option value="">Select id</option>
    </select>

    <input type="text" name="NAME" placeholder="Name">
    <input type="text" name="TELEPHONE" placeholder="Telephone">
    <input type="text" name="EMAIL" placeholder="Email">
    <input type="text" name="HEADQUARTER" placeholder="Headquarters">
    <input type="text" name="AFM_SUPPLIER" placeholder="AFM_SUPPLIER">
    <button type="button" id="finalSubmitButton">Final Submit</button>
</form>

<div id="responseMessage"></div>

<script>
    window.onload = function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'show_left_id.php', true);
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
            xhr.open('POST', 'show_supplier_7th.php', true);
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
        xhr.open('POST', 'insert_sup_correct.php', true);
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

    function clearFormFields() {
        document.getElementById('dataForm').reset();
    }
</script>
<script src="../public/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
