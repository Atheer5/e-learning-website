<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>





<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content custom-modal ">
      <div id="" class=" mt-1 text-success text-center message msuccess"></div>     
      <div id=""  class="text-danger text-center mt-2 name_error merror"></div>
      <div class="m-header text-center pt-1">
        <h5 class="modal-title lbl " id="title"></h5>
      </div> 
            <form action="" class="registration">
              <div class="m-body p-3 ">              
                <div class="form-group">
                  <label for="fname" class="required lbl">First name </label>
                  <input type="text" class="form-control fname" id="fname" placeholder="First name" name="fname">
                </div>

                <div class="form-group">
                  <label for="lname" class="required lbl">Last name </label>
                  <input type="text" class="form-control lname" id="lname" placeholder="Last name " name="lname">
                </div>

                <div class="form-group">
                  <label for="email"class="required lbl">Email</label>
                  <input type="email" class="form-control email" id="email" placeholder="email" name="email">
                </div>

                <div class="form-group">
                  <label for="pwd" class="required lbl">Passowrd</label>
                  <input type="password" class="form-control pwd" id="pwd" placeholder="password" name="pwd">
                </div>

                <div class="form-group">
                  <label for="cpwd" class="required lbl ">Confirm Passowrd</label>
                  <input type="password" class="form-control cpassword" id="cpwd" placeholder="confirm passowrd" name="cpwd">
                </div>

                <div class="form-group">  
                  <div class="input-group mb-3">
                    <div class="custom-control custom-switch "id="tog">
                          <input class="form-check-input show" name="catshow" type="checkbox" id="show" >
                          <label class="form-check-label lbl" for="show" >Activate</label>
                    </div>
                  </div>
                </div> 
                <input type="text" class="form-control uid " id="userid">
            
              </div>
              <div class="m-footer pb-1 text-center">
                <button type="button" class="btn cls " data-dismiss="modal" onclick="javascript:window.location.reload()">close</button>
                <button type="submit" class="btn save add" name="add" id="add"  >Register</button>
                <button type="button" class="btn save edit" name="edit" id="edit"  >Save edit</button>
                
              </div>
            </form>
    </div>
 </div>

