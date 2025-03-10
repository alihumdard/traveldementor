<style>
  #qoutedetail {
    backdrop-filter: blur(5px);
    background-color: #01223770;
  }
</style>
<div class="modal fade" id="qoutedetail" tabindex="-1" aria-labelledby="qoutedetaillable" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header" style="background: #452c88; border-radius: 12px 12px 0px 0px; display: flex; align-items: center;">
        <div style="display: flex; align-items: center;">
          <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 4H20C21.1046 4 22 4.89543 22 6V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V6C2 4.89543 2.89543 4 4 4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M22 6L12 13L2 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <h5 class="modal-title text-white ml-2" id="qoutedetaillable"><span>Schedule Appointment</span></h5>
        </div>
        <button class="btn p-0" data-dismiss="modal">
          <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.8403 6L6.84033 18M6.84033 6L18.8403 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>

      <div class="modal-body pt-1">
        <div id="data-applicationDetails">
          <div class="row pb-2 mb-2" style="border-bottom: 2px solid #ACADAE4D;">
            <div class="col-lg-6 mt-4 mb-1">
              <div class="d-flex justify-content-start">
                <div>
                  <img src="/assets/images/user.png" id="quoteDetail_userImg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                </div>
                <div class="ml-3">
                  <label for="name" class="mb-0"><span style="color: #184A45FF;">Applicant name</span></label>
                  <input type="text" disabled id="name" class="form-control" >
                </div>
              </div>
            </div>
          </div>
          <div class="container mt-4">
            <table class="table table-bordered" style="border: 1px solid #ddd; border-radius: 12px; overflow: hidden; background-color: #f9f9f9; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
              <thead style="background-color: #452c88; color: white;">
                <tr>
                  <th style="text-align: left; padding: 15px; font-size: 16px;">Field</th>
                  <th style="text-align: left; padding: 15px; font-size: 16px;">Applicant Data</th>
                </tr>
              </thead>
              <tbody>
                {{-- <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Applicant Name</td>
                  <td style="padding: 12px;" id="name"></td>
                </tr> --}}
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Applicant Contact No</td>
                  <td style="padding: 12px;" id="contact_no"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Country</td>
                  <td style="padding: 12px;" id="country"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Category</td>
                  <td style="padding: 12px;" id="category"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">VFS/Embassy</td>
                  <td style="padding: 12px;" id="vfs_emb"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Appointment Contact</td>
                  <td style="padding: 12px;" id="appoint_contact"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Appointment Email</td>
                  <td style="padding: 12px;" id="appoint_email"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Appointment Refer No</td>
                  <td style="padding: 12px;" id="appointment_refer_no"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">VFS Appointment Ref.</td>
                  <td style="padding: 12px;" id="vfs_appointment_refer"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Biometric Appointment Date</td>
                  <td style="padding: 12px;" id="bio_metric_appointment_date"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">No of Applicants</td>
                  <td style="padding: 12px;" id="no_application"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Payment Mode</td>
                  <td style="padding: 12px;" id="pay_mod"></td>
                </tr>
                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Bank Name</td>
                  <td style="padding: 12px;" id="bank_name"></td>
                </tr>

                <tr>
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Card Holder Name</td>
                  <td style="padding: 12px;" id="card_holder_name"></td>
                </tr>
    
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
