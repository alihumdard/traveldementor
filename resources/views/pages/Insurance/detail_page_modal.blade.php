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
          <h5 class="modal-title text-white ml-2" id="qoutedetaillable"><span>Application</span></h5>
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
                  <img src="assets/images/user.png" id="quoteDetail_userImg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                </div>
                <div class="ml-3">
                  <label for="quoteDetail_user" class="mb-0"><span style="color: #184A45FF;">Applicant name</span></label>
                  <input type="text" disabled id="quoteDetail_user" class="form-control" value="John Doe">
                </div>
              </div>
            </div>
          </div>
          <div class="container mt-4">
            <table class="table table-bordered" style="border: 1px solid #ddd; border-radius: 12px; overflow: hidden; background-color: #f9f9f9; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
              <thead style="background-color: #452c88; color: white;">
                <tr>
                  <th style="text-align: left; padding: 15px; font-size: 16px;">Field</th>
                  <th style="text-align: left; padding: 15px; font-size: 16px;">User Data</th>
                </tr>
              </thead>
              <tbody>
                <tr style="transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Country</td>
                  <td style="padding: 12px;">United States</td>
                </tr>
                <tr style="background-color: #ffffff; transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Category</td>
                  <td style="padding: 12px;">Business</td>
                </tr>
                <tr style="transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Passport Number</td>
                  <td style="padding: 12px;">A12345678</td>
                </tr>
                <tr style="background-color: #ffffff; transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Passport Expiry Date</td>
                  <td style="padding: 12px;">2025-12-31</td>
                </tr>
                <tr style="transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Visa Status</td>
                  <td style="padding: 12px;">Approved</td>
                </tr>
                <tr style="background-color: #ffffff; transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Visa Expiry Date</td>
                  <td style="padding: 12px;">2026-06-15</td>
                </tr>
                <tr style="transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">VSF Refer no</td>
                  <td style="padding: 12px;">12345678</td>
                </tr>
                <tr style="background-color: #ffffff; transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">DS160</td>
                  <td style="padding: 12px;">87654321</td>
                </tr>
                <tr style="transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Status</td>
                  <td style="padding: 12px;">Active</td>
                </tr>
              </tbody>
            </table>
            <div class="text-center mt-4">
              <button class="btn" style="background: linear-gradient(90deg, #452c88, #6a4ab5); color: white; padding: 12px 30px; border-radius: 8px; font-size: 16px; border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                Back
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>