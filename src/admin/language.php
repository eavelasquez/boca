<?php
////////////////////////////////////////////////////////////////////////////////
//BOCA Online Contest Administrator
//    Copyright (C) 2003-2012 by BOCA Development Team (bocasystem@gmail.com)
//
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.
////////////////////////////////////////////////////////////////////////////////
// Last modified 08/aug/2015 by cassio@ime.usp.br
require('header.php');

if(($ct = DBContestInfo($_SESSION["usertable"]["contestnumber"])) == null)
	ForceLoad("../index.php");

if (isset($_GET["delete"]) && is_numeric($_GET["delete"])) {
	$param["number"] = $_GET["delete"];
	DBDeleteLanguage ($_SESSION["usertable"]["contestnumber"],$param);
	ForceLoad("language.php");
}

if (isset($_POST["Submit3"]) && isset($_POST["langnumber"]) && is_numeric($_POST["langnumber"]) && 
    isset($_POST["langname"]) && $_POST["langname"] != "") {
	if(strpos(trim($_POST["langname"]),' ')!==false) {
		$_POST["confirmation"]='';
		MSGError('Language name cannot have spaces');
	} else {
	if ($_POST["confirmation"] == "confirm") {
		$param = array();
		$param['number'] = $_POST['langnumber'];
		$param['name'] = trim($_POST['langname']);
		$param['extension'] = isset($_POST['langextension']) ? trim($_POST['langextension']) : '';
		DBNewLanguage ($_SESSION["usertable"]["contestnumber"], $param);
	}
	}
	ForceLoad("language.php");
}

// Add CSS styles in the head section
echo "<style>
:root {
  --color-primary: #3b82f6;
  --color-primary-dark: #2563eb;
  --color-danger: #ef4444;
  --color-danger-dark: #dc2626;
  --color-warning: #f59e0b;
  --color-warning-dark: #d97706;
  --color-warning-light: #fff7ed;
  --color-warning-border: #fdba74;
  --color-text: #1e293b;
  --color-text-light: #64748b;
  --color-border: #e2e8f0;
  --color-background: #f8fafc;
  --color-white: #ffffff;
  --color-card: #ffffff;
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
  --radius: 0.375rem;
  --transition: 0.2s ease;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
  line-height: 1.5;
  color: var(--color-text);
  background-color: var(--color-background);
  margin: 0;
  padding: 0;
}

.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
}

.content {
  background-color: var(--color-white);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  margin: 1.5rem 0;
  padding: 1.5rem;
}

.content-header {
  margin-bottom: 1.5rem;
  border-bottom: 1px solid var(--color-border);
  padding-bottom: 1rem;
}

.content-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 0 0 0.5rem 0;
  color: var(--color-text);
}

.content-description {
  color: var(--color-text-light);
  font-size: 0.875rem;
  margin: 0;
}

.data-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 1.5rem;
}

.data-table th {
  text-align: left;
  padding: 0.75rem;
  border-bottom: 2px solid var(--color-border);
  font-weight: 600;
  color: var(--color-text-light);
  font-size: 0.875rem;
}

.data-table td {
  padding: 0.75rem;
  border-bottom: 1px solid var(--color-border);
  font-size: 0.875rem;
}

.data-table tr:last-child td {
  border-bottom: none;
}

.data-table tr:hover {
  background-color: rgba(0,0,0,0.02);
}

.alert {
  padding: 1rem;
  border-radius: var(--radius);
  margin-bottom: 1.5rem;
  border-left: 4px solid transparent;
}

.alert-warning {
  background-color: var(--color-warning-light);
  border-color: var(--color-warning);
  color: var(--color-warning-dark);
}

.form-row {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -0.5rem;
}

.form-group {
  flex: 1;
  padding: 0 0.5rem;
  margin-bottom: 1rem;
  min-width: 200px;
}

.form-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  font-size: 0.875rem;
}

.form-input {
  width: 100%;
  padding: 0.5rem 0.75rem;
  border: 1px solid var(--color-border);
  border-radius: var(--radius);
  font-size: 0.875rem;
  transition: border-color var(--transition);
}

.form-input:focus {
  outline: none;
  border-color: var(--color-primary);
  box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 0.5rem;
  margin-top: 1.5rem;
}

.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 1rem;
  border-radius: var(--radius);
  font-size: 0.875rem;
  font-weight: 500;
  cursor: pointer;
  transition: all var(--transition);
  border: 1px solid transparent;
}

.btn-primary {
  background-color: var(--color-primary);
  color: white;
}

.btn-primary:hover {
  background-color: var(--color-primary-dark);
}

.btn-danger {
  background-color: var(--color-danger);
  color: white;
}

.btn-danger:hover {
  background-color: var(--color-danger-dark);
}

.btn-secondary {
  background-color: #f3f4f6;
  color: var(--color-text);
  border-color: var(--color-border);
}

.btn-secondary:hover {
  background-color: #e5e7eb;
}

.text-center {
  text-align: center;
}

.text-danger {
  color: var(--color-danger);
}

.font-bold {
  font-weight: 700;
}

.mt-4 {
  margin-top: 1rem;
}

.mb-4 {
  margin-bottom: 1rem;
}

@media (max-width: 768px) {
  .form-row {
    flex-direction: column;
  }
  
  .form-group {
    width: 100%;
  }
  
  .data-table {
    display: block;
    overflow-x: auto;
  }
}
</style>";
?>

<div class="container">
  <!-- Languages Table Section -->
  <div class="content">
    <div class="content-header">
      <h1 class="content-title">Programming Languages</h1>
      <p class="content-description">Manage the programming languages available for the contest</p>
    </div>
    
    <table class="data-table">
      <thead>
        <tr>
          <th>Language #</th>
          <th>Name</th>
          <th>Extension</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $lang = DBGetLanguages($_SESSION["usertable"]["contestnumber"]);
        $cf = globalconf();
        for ($i=0; $i<count($lang); $i++) {
          echo "<tr>\n";
          echo "  <td>" . $lang[$i]["number"] . "</td>\n";
          echo "  <td>" . $lang[$i]["name"] . "</td>\n";
          echo "  <td>" . $lang[$i]["extension"] . "</td>\n";
          echo "  <td><button class='btn btn-danger delete-btn' data-id='" . $lang[$i]["number"] . "' data-name='" . $lang[$i]["name"] . "'>Delete</button></td>\n";
          echo "</tr>\n";
        }
        ?>
      </tbody>
    </table>
    
    <?php if (count($lang) == 0): ?>
      <div class="text-center">
        <p class="text-danger font-bold">NO LANGUAGES DEFINED</p>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- Add/Edit Language Form Section -->
  <div class="content">
    <div class="content-header">
      <h2 class="content-title">Add/Edit Language</h2>
      <p class="content-description">Enter the details below to add a new language or edit an existing one</p>
    </div>
    
    <div class="alert alert-warning">
      <strong>Warning:</strong> It is NOT recommended to change anything while the contest is running.
      Note that any changes will overwrite the already defined data.
    </div>
    
    <form name="form1" id="language-form" enctype="multipart/form-data" method="post" action="language.php">
      <input type="hidden" name="confirmation" value="noconfirm" />
      <input type="hidden" name="Submit3" value="Save" />
      
      <div class="form-row">
        <div class="form-group">
          <label for="langnumber" class="form-label">Number:</label>
          <input type="text" id="langnumber" name="langnumber" class="form-input" maxlength="20" />
        </div>
        
        <div class="form-group">
          <label for="langname" class="form-label">Name:</label>
          <input type="text" id="langname" name="langname" class="form-input" maxlength="20" />
        </div>
        
        <div class="form-group">
          <label for="langextension" class="form-label">Extension:</label>
          <input type="text" id="langextension" name="langextension" class="form-input" maxlength="20" />
        </div>
      </div>
      
      <div class="form-actions">
        <button type="reset" name="Submit4" class="btn btn-secondary">Clear</button>
        <button type="button" class="btn btn-primary" id="submit-btn">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Delete button functionality
  const deleteButtons = document.querySelectorAll('.delete-btn');
  
  deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      const name = this.getAttribute('data-name');
      
      if (confirm("Confirm the DELETION of the LANGUAGE '" + name + "' and ALL data associated to it (including the SUBMISSIONS)?")) {
        if (confirm("Are you REALLY sure about what you are doing? DATA CANNOT BE RECOVERED!")) {
          window.location.href = 'language.php?delete=' + id;
        }
      }
    });
  });
  
  // Form validation and confirmation
  const languageForm = document.getElementById('language-form');
  const submitBtn = document.getElementById('submit-btn');
  
  submitBtn.addEventListener('click', function(e) {
    const numberField = document.getElementById('langnumber');
    const nameField = document.getElementById('langname');
    const extensionField = document.getElementById('langextension');
    
    // Remove any existing error messages
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    
    let isValid = true;
    
    // Validate number field
    if (!numberField.value.trim() || isNaN(numberField.value.trim())) {
      showError(numberField, 'Please enter a valid number');
      isValid = false;
    }
    
    // Validate name field
    if (!nameField.value.trim()) {
      showError(nameField, 'Name is required');
      isValid = false;
    } else if (nameField.value.trim().indexOf(' ') !== -1) {
      showError(nameField, 'Language name cannot have spaces');
      isValid = false;
    }
    
    // Validate extension field
    if (!extensionField.value.trim()) {
      showError(extensionField, 'Extension is required');
      isValid = false;
    }
    
    if (isValid) {
      if (confirm("Confirm?")) {
        // Set the confirmation value before submitting
        const confirmationField = document.getElementsByName('confirmation')[0];
        if (confirmationField) {
          confirmationField.value = 'confirm';
          languageForm.submit();
        } else {
          console.error('Confirmation field not found');
        }
      }
    }
  });
  
  function showError(field, message) {
    // Remove any existing error for this field
    const existingError = field.nextElementSibling;
    if (existingError && existingError.classList.contains('error-message')) {
      existingError.remove();
    }
    
    // Create and add error message
    const errorElement = document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.style.color = 'var(--color-danger)';
    errorElement.style.fontSize = '0.75rem';
    errorElement.style.marginTop = '0.25rem';
    errorElement.textContent = message;
    
    field.parentNode.insertBefore(errorElement, field.nextSibling);
    
    // Highlight the field
    field.style.borderColor = 'var(--color-danger)';
    
    // Remove error styling on input
    field.addEventListener('input', function() {
      field.style.borderColor = '';
      const error = field.nextElementSibling;
      if (error && error.classList.contains('error-message')) {
        error.remove();
      }
    }, { once: true });
  }
});
</script>
</body>
</html>
