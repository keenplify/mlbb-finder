<!-- Delete Modal -->

<form id="deletePreferenceForm">
  <div class="modal fade" id="deletePreferenceModal" tabindex="-1" role="dialog" aria-labelledby="deletePreferenceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletePreferenceLabel">Delete Preference Profile</h5>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete your current preference?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#deletePreferenceModal').modal('hide')">Close</button>
          <button type="submit" class="btn btn-primary">
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Javascript -->
<script defer>
  const _deleteForm = document.querySelector("#deletePreferenceForm");

  _deleteForm.onsubmit = (event) => {
    event.preventDefault();

     $.ajax({
      url: "http://localhost/server/api/preferences/delete.php",
      method: "post",
      data: {
        preference_id: selectedPreference
      },
      success: (data) => {
        if (data === "null") return console.log("Invalid user!");
        listUserPreferences();
        $('#deletePreferenceModal').modal('hide');
      },
    });
  }
</script>