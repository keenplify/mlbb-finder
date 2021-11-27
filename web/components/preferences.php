<!---------------------------- CSS---------------------------->
<link rel="stylesheet" type="text/css" href="css/preference.css">

<?php require "addPreferenceModal.php" ?>
<?php require "deletePreferenceModal.php" ?>



            <div class="container-fluid m-auto" data-aos="fade-up" data-aos-duration="1000" id="sec6">
            
                <div class="row">                 
                    <div class="col-md-9 m-auto ">
                    <div class="showcase-left py-3">

                    <div class="card-body bg-dark">
  
              <h5 class="display-6">Preference Profiles</h5>
              <div class="d-flex gap-1">
                <button class="btn btn-success" onclick="listUserPreferences()">
                  <span class="oi oi-reload"></span>
                  Refresh
                </button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addPreferenceModal" onclick="$('#addPreferenceModal').modal('show')">
                  <span class="oi oi-plus"></span>
                  Add
                </button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#deletePreferenceModal" onclick="$('#deletePreferenceModal').modal('show')">
                  <span class="oi oi-minus"></span>
                  Delete
                </button>
              </div>
            <div class="container-fluid m-auto py-2">
              <div class="form-group">
                <label for="preferenceProfileSelect" class="fs-5">Select Preference:</label>
                <select id="preferenceProfileSelect" class="custom-select form-select " name="preferenceProfileSelect">
                  <option selected disabled>No Preference!</option>
                </select>
                    </div>
                    </div>
                    <div class="row m-auto">
                      <div class="col-md-6">
                        <strong>Primary Role: </strong>
                        <span id="primaryRoleText"></span>
                      </div>
                      <div class="col-md-6">
                        <strong>Secondary Role: </strong>
                        <span id="secondaryRoleText"></span>
                      </div>
                    </div>
                    <div class="row m-auto">
                      <div class="col-md">
                        <strong>Gamemode: </strong>
                        <span id="gamemodeText"></span>
                      </div>
                      <div class="col-md">
                        <strong>IGN: </strong>
                        <span id="mlbbdataText"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="container text-center">
                  <p class="text-muted">The role preferences will be removed after 2 minutes at queue for faster queue time.</p>
                </div>
              </div>
              </div>

                    </div>
                    </div>




           


<script defer>
  const preferenceProfileSelect = document.querySelector("#preferenceProfileSelect");
  const gamemodeText = document.querySelector("#gamemodeText");
  const primaryRoleText= document.querySelector("#primaryRoleText");
  const secondaryRoleText = document.querySelector("#secondaryRoleText");
  const mlbbdataText = document.querySelector("#mlbbdataText");

  let selectedPreference;
  let preferences = [];

  function listUserPreferences() {
    $.ajax({
      url: "http://localhost/server/api/preferences/getUserPreferences.php",
      data: {
        createdBy: USER.user_id,
      },
      success: (data) => {
        if (data === "null") return console.log("Invalid user!");
        setPreferenceList(JSON.parse(data))
      },
    });
  }

  function setPreferenceList(newValue) {
    if (typeof newValue !== "object" || newValue?.length <= 0) {
      preferenceProfileSelect.innerHTML = "<option disabled>No preference settings!</option>";
      UpdateTable();
      return;
    };
    let innerHTML = '';
    newValue.map(preference => innerHTML += `<option value="${preference.preference_id}">
      ${preference.primaryRole} + ${preference.secondaryRole} | ${preference.gameMode}
    </option>`);
    preferenceProfileSelect.innerHTML = innerHTML;
    preferences = newValue;
    selectedPreference = newValue[0].preference_id
    UpdateTable();
  }
  
  function UpdateTable() {
    const val = preferenceProfileSelect.value
    const currentPreference = preferences.filter(e=>e!==undefined).find((v) => v.preference_id.toString() === val.toString())

    if (currentPreference === undefined) {
      gamemodeText.innerHTML= "N/A";
      primaryRoleText.innerHTML = "N/A";
      secondaryRoleText.innerHTML = "N/A";
      mlbbdataText.innerHTML = "N/A";
    }

    selectedPreference = Number.parseInt(currentPreference.preference_id);
    gamemodeText.innerHTML= currentPreference.gameMode;
    primaryRoleText.innerHTML = currentPreference.primaryRole;
    secondaryRoleText.innerHTML = currentPreference.secondaryRole;

    $.ajax({
      method: "GET",
      url: `http://localhost/server/api/mlbbdata/read.php?data_id=${currentPreference.mlbbdata_id}`
    }).done(data => {
      const obj = JSON.parse(data);
      
      mlbbdataText.innerHTML = obj === null ? "Account not found!":obj.ign;
    })
    
  }

  window.addEventListener('load', function () {
    preferenceProfileSelect.onchange = UpdateTable;
    listUserPreferences();
  })
</script>