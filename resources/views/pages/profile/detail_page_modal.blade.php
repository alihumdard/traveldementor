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
          <svg width="25" height="24" viewBox="0 0 640 512" fill="white" xmlns="http://www.w3.org/2000/svg">
            <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
          </svg>
          <h5 class="modal-title text-white ml-2" id="qoutedetaillable"><span>Staff</span></h5>
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
                  <label for="quoteDetail_user" class="mb-0"><span style="color: #184A45FF;">Applicant name</span></label>
                  <input type="text" disabled id="name" class="form-control" value="John Doe">
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
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Name</td>
                  <td style="padding: 12px;" id="name"></td>
                </tr>
                <tr style="background-color: #ffffff; transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Email</td>
                  <td style="padding: 12px;" id="email"></td>
                </tr>
                <tr style="transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Phone No</td>
                  <td style="padding: 12px;" id="phone_no"></td>
                </tr>
                <tr style="transition: all 0.3s;">
                  <td style="padding: 12px; color: #452c88; font-weight: bold;">Address</td>
                  <td style="padding: 12px;" id="address"></td>
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