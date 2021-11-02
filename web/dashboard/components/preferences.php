
<?php require "addPreferenceModal.php" ?>

<div class="row m-3">
  <div class="col-md-6">
    <div class="card-body border">
      <div class="d-flex align-items-center">
        <h5 class="flex-grow-1">Preference Profiles</h5>
        <div class="d-flex">
          <button class="btn btn-success mx-1" onclick="listUserPreferences()">
            <span class="oi oi-reload"></span>
            Refresh
          </button>
          <button class="btn btn-primary mx-1" data-toggle="modal" data-target="#addPreferenceModal">
            <span class="oi oi-plus"></span>
            Add
          </button>
        </div>
      </div>
      <div>
        <div class="form-group my-2">
          <label for="preferenceProfileSelect">Select Preference:</label>
          <select id="preferenceProfileSelect" class="custom-select" name="preferenceProfileSelect">
            <option selected disabled>No Preference!</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <strong>Primary Role: </strong>
          <span id="primaryRoleText"></span>
        </div>
        <div class="col-md-6">
          <strong>Secondary Role: </strong>
          <span id="secondaryRoleText"></span>
        </div>
      </div>
      <div class="row">
        <div class="col-md">
          <strong>Gamemode: </strong>
          <span id="gamemodeText"></span>
        </div>
      </div>
    </div>
  </div>
  <div>
    <p class="text-muted">The role preferences will be removed after 2 minutes at queue for faster queue time.</p>
  </div>
</div>

<script defer>
  const preferenceProfileSelect = document.querySelector("#preferenceProfileSelect");
  const gamemodeText = document.querySelector("#gamemodeText");
  const primaryRoleText= document.querySelector("#primaryRoleText");
  const secondaryRoleText = document.querySelector("#secondaryRoleText");

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
    if (typeof newValue !== "object") return;
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

    const currentPreference = preferences.find((v) => v.preference_id.toString() === val.toString())
    selectedPreference = Number.parseInt(currentPreference.preference_id);
    gamemodeText.innerHTML= currentPreference.gameMode;
    primaryRoleText.innerHTML = currentPreference.primaryRole;
    secondaryRoleText.innerHTML = currentPreference.secondaryRole;
  }

  window.addEventListener('load', function () {
    preferenceProfileSelect.onchange = UpdateTable;
    listUserPreferences();
  })
</script>