<!-- Modal -->

<form id="addPreferenceForm">
  <div class="modal fade" id="addPreferenceModal" tabindex="-1" role="dialog" aria-labelledby="addPreferenceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPreferenceLabel">Add Preference Profile</h5>
        </div>
        <div class="modal-body">
          <div id="preferences">
            <div class="form-group my-2">
              <label for="gameMode">Game Mode:</label>
              <select class="custom-select" name="gameMode" id="addPreference_gameMode">
                <option value="Classic" selected>Classic</option>
                <option value="Ranked">Ranked</option>
                <option value="Brawl">Brawl</option>
              </select>
            </div>

            <div class="form-group my-2">
              <label for="primaryRole">Primary Role:</label>
              <select class="custom-select" name="primaryRole" id="addPreference_primaryRole">
                <option value="Tank" selected>Tank</option>
                <option value="Fighter">Fighter</option>
                <option value="Marksman">Marksman</option>
                <option value="Mage">Mage</option>
                <option value="Assassin">Assassin</option>
                <option value="Support">Support</option>
              </select>
            </div>

            <div class="form-group my-2">
              <label for="secondaryRole">Secondary Role:</label>
              <select class="custom-select" name="secondaryRole" id="addPreference_secondaryRole">
                <option value="Tank">Tank</option>
                <option value="Fighter" selected>Fighter</option>
                <option value="Marksman">Marksman</option>
                <option value="Mage">Mage</option>
                <option value="Assassin">Assassin</option>
                <option value="Support">Support</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">
            Add
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Javascript -->
<script defer>
  const _addForm = document.querySelector("#addPreferenceForm");
  const addPreference_gameMode = document.querySelector("#addPreference_gameMode");
  const addPreference_primaryRole = document.querySelector("#addPreference_primaryRole");
  const addPreference_secondaryRole = document.querySelector("#addPreference_secondaryRole");

  _addForm.onsubmit = (event) => {
    event.preventDefault();

     $.ajax({
      url: "http://localhost/server/api/preferences/add.php",
      method: "post",
      data: {
        gameMode: addPreference_gameMode.value,
        primaryRole: addPreference_primaryRole.value,
        secondaryRole: addPreference_secondaryRole.value,
        createdBy: USER.user_id,
      },
      success: (data) => {
        if (data === "null") return console.log("Invalid user!");
        listUserPreferences();
        selectedPreference
        $('#addPreferenceModal').modal('hide');
      },
    });
  }
</script>