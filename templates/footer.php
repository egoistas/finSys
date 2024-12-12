</main>
<div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">&copy; ΣΠΗΥ142 2023-24<br>Λαδόπουλος-Πασσάς-Χρηστίδης</p>
            <a href="/δ" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>

            <ul class="nav col-md-4 justify-content-end ">
                <li class="nav-item">
                    <div class="form-check form-switch">
                        <input name="dark_mode_switch" class="form-check-input" type="checkbox" id="btnSwitch">
                        <label class="form-check-label" for="btnSwitch" style="cursor: default; pointer-events: none;">
                          <img src="../custom/dark-mode-blue.svg" style="max-width: 35px; max-height: 35px; margin-right: 10px;" alt="" srcset="">
                        </label>
                    </div>
                </li>
            </ul>
        </footer>
        
    </div>

    <script>
        document.getElementById('btnSwitch').addEventListener('change', () => {
            const isDarkMode = document.getElementById('btnSwitch').checked;
            document.documentElement.setAttribute('data-bs-theme', isDarkMode ? 'dark' : 'light');
        });
    </script>
</body>

</html>
<?php
ob_end_flush(); // Αποστολή του buffer και απενεργοποίηση του output buffering
// Στο τέλος κάθε php προγράμματος γίνεται flush by default, ακόμη και αν δεν
// κληθεί η συνάρτηση ob_end_flush();
?>