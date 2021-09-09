<!-- Modal -->
<div class="modal fade" id="RouteDetails" role="dialog">
    <div class="modal-dialog md_route_details_history">

      <!-- Modal content-->
      <div class="modal-content mc_content_route_history">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Route History</h4>
        </div>
        <div class="panel-body" id="modal_remarks">
            <div class="table-responsive">
                <table class="table table-hover" id="tb-details">
                    {{-- <thead>
                        <tr>
                            <th>FROM</th>
                            <th>FORWARDED TO</th>
                            <th>DATE RECEIVED</th>
                            <th>DATE FORWARDED</th>
                            <th>ACTION</th>
                            <th>DURATION</th>
                        </tr>
                    </thead> --}}
                    <thead>
                      <tr>
                          <th rowspan="2">FROM</th>
                          <th rowspan="2">FORWARDED TO</th>
                          <th rowspan="2">ACTION</th>
                          <th rowspan="2">REMARK</th>
                          <th colspan="2">DATE</th>
                          <th colspan="2">DURATION</th>
                      </tr>
                      <tr>
                          <th>RECEIVED</th>
                          <th>FORWARDED</th>
                          <th>RECEIVED</th>
                          <th>FORWARDED</th>
                      </tr>
                  </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!-- Modal -->
  <div class="modal fade" id="create_interoffice" role="dialog">
    <div class="modal-dialog md_create_interoffice">

      <!-- Modal content-->
      <div class="modal-content mc_content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CREATE INTEROFFICE</h4>
        </div>
        <div class="panel-body">
              <div class="form">
                {{-- {{ Form::open(['route' => 'document.store', 'class' => 'form-validate form-horizontal', 'id'=>'frm_created_interoffice', 'role' => 'form', 'method' => 'post']) }} --}}
                {{ Form::open(['class' => 'form-validate form-horizontal', 'id'=>'frm_created_interoffice', 'role' => 'form']) }}
                  <div class="form-group">
                      <label for="d_type" class="control-label col-md-3" data-placeholder="Select Document...">Document Type</label>
                      <div class="col-md-9">
                          <select name="d_type" id="d_type" data-placeholder="Select Document Type..." class="form-control chosen-document_type">
                          @foreach($forms as $form)
                              <option value="{{$form->df_id}}">{{$form->name}}</option>
                          @endforeach
                              <option value="" selected></option>
                          </select>
                      </div>
                  </div><!--form-group-->

                  <div class="form-group">
                      <label for="d_description" class="control-label col-md-3">Description</label>
                      <div class="col-md-9">
                          <textarea rows="3" class="form-control" name="d_description" id="d_description"></textarea>
                      </div>
                  </div><!--form-group-->

                  <div class="form-group">
                      <label for="route_user" class="control-label col-md-3">Route</label>
                      <div class="col-md-9">
                          <select id="route_user" data-placeholder="Select Employee..." class="form-control chosen-user" name="route_user">
                              <option selected></option>
                              @foreach($users as $user)
                                  <option value="{{$user->id}}">{{ $user->name }} </option>
                              @endforeach
                          </select>
                      </div>
                  </div><!--form-group-->

                  <div class="form-group">
                    <label for="route_user" class="control-label col-md-3">Action</label>
                    <div class="col-md-9">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="chk_actions[]" value="For Signature">For signature
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="chk_actions[]" value="For Checking/Review/Comments">For checking/review/comments
                        </label><br>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="chk_actions[]" value="For Appropriate Action">For appropriate action
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="chk_actions[]" value="For Revision">For Revision
                        </label><br>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="chk_actions[]" value="For Filing">For Filing
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="chk_actions[]" value="For Reference">For Reference
                        </label>
                    </div>
                </div><!--form-group-->

                  <div class="form-group">
                      <label for="d_remarks" class="control-label col-md-3">Remarks</label>
                      <div class="col-md-9">
                          <textarea rows="3" class="form-control" name="d_remarks" id="d_remarks"></textarea>
                      </div>
                  </div><!--form-group-->
                  
                  <div class="form-group">
                      <div class="col-md-3"></div>
                      <div class="col-md-9" style="text-align:center;">
                          {{ Form::submit('SAVE', ['class' => 'btn btn-primary btn-md form-control', 'id'=>'btn_saveinteroffice']) }}
                      </div>
                  </div><!--formd-group-->
              {{ Form::close() }}
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>