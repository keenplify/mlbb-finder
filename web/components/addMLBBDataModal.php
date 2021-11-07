<!-- Modal -->

<form id="addMLBBDataForm">
  <div class="modal fade" id="addMLBBDataModal" tabindex="-1" role="dialog" aria-labelledby="addMLBBDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMLBBDataLabel">Add MLBB Account</h5>
        </div>
        <div class="modal-body">
          <div>
            <div class="form-group my-2">
              <label for="gameMode">In Game Name (IGN):</label>
              <div class="input-group mb-2 ">
                <div class="input-group-prepend">
                  <div class="input-group-text h-100"><span class="oi oi-copywriting"></span></div>
                </div>
                <input type="text" class="form-control" id="addMLBBData_ign" name="ign" placeholder="In Game Name">
              </div>
            </div>
            <div class="form-group my-2">
              <label for="gameMode">Mobile Legends ID</label>
              <div class="input-group mb-2 ">
                <div class="input-group-prepend">
                  <div class="input-group-text h-100"><span class="oi oi-person"></span></span></div>
                </div>
                <input type="text" class="form-control" id="addMLBBData_mlid" name="mlid" placeholder="Mobile Legends ID">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#addMLBBDataModal').modal('hide')">Close</button>
              <button type="submit" class="btn btn-primary">
                Submit
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<button type="button" class="btn btn-success" data-toggle="modal" onclick="openAddDataModal()">
  <span class="oi oi-plus"></span>
  Add
</button>

<a class="btn btn-secondary btn0 m-auto mx-2 fs-5" href="http://localhost/web/dashboard.php" role="button">Dashboard</a>

<!-- Javascript -->
<script defer>
  const _addForm = document.querySelector("#addMLBBDataForm");
  const addMLBBData_ign = document.querySelector("#addMLBBData_ign");
  const addMLBBData_mlid = document.querySelector("#addMLBBData_mlid");

  function openAddDataModal() {
    ACTIVEDATA_ID = false;
    $("#addMLBBDataModal").modal("show");
  }

  _addForm.onsubmit = (event) => {
    event.preventDefault();
    if (!ACTIVEDATA_ID) {
      $.ajax({
        url: "http://localhost/server/api/mlbbdata/add.php",
        method: "post",
        data: {
          ign: addMLBBData_ign.value,
          mlid: addMLBBData_mlid.value,
          createdBy: USER.user_id,
        },
        success: (data) => {
          if (data === "null") return console.log("Invalid user!");
          listUserMLBBDatas();
          $('#addMLBBDataModal').modal('hide');
        },
      });
    } else {
      $.ajax({
        url: "http://localhost/server/api/mlbbdata/update.php",
        method: "POST",
        data: {
          ign: addMLBBData_ign.value,
          mlid: addMLBBData_mlid.value,
          data_id: ACTIVEDATA_ID
        },
        success: (data) => {
          if (data === "null") return console.log("Invalid user!");
          listUserMLBBDatas();
          $('#addMLBBDataModal').modal('hide');
        },
      });
    }
  }
</script>