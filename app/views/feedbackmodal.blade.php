<!-- Modal Dialog -->

<div class="modal fade" id="feedbackmodal" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title">Feedback</h4>

      </div>

      <div class="modal-body">
      <form class="form-horizontal">
        <div class="form-group ">
      <label class="col-md-2 control-label" for="feedbackmessage">Messsage<font color="red">*</font></label>
      <div class="col-md-9">
        <input class="form-control" type="text"  name="feedbackmessage" id="feedbackmessage" placeholder='Messsage'  required />
      </div>
    </div></br>
          
        <div class="form-group">
      <label class="col-md-2 control-label" for="feedbackemail">Email<font color="red">*</font></label>
      <div class="col-md-9">
        <input class="form-control" type="email" name="feedbackemail" id="feedbackemail" placeholder='Email' required />
      </div>
    </div></br>


        <div class="form-group ">
      <label class="col-md-2 control-label" for="feedbackdescription" >Description<font color="red">*</font></label>
      <div class="col-md-9">
        <textarea id="feedbackdescription" class="form-control full-width wysihtml5" name="feedbackdescription"  rows="5" placeholder='Description' required></textarea>
      </div>
    </div></br> 


      <div id="feedback_response" style="margin-left:180px;"></div>
      </form>
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

        <button type="button" class="btn btn-success" id="feedbackconfirm">Send</button>

      </div>

    </div>

  </div>

</div>



