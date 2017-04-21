<div class="row">
	<div class="col-md-12">				
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><span class="icon-plus"> {{__('Create Course form')}}</span></h4>
			  </div>
			  <div class="modal-body">
					<div class="response-message"></div>
					<form name="cretate_course" id="create-course-form" method="POST" autocomplete="off">
						<div class="box_style_2">
							<div class="row">
								<p class="col-md-12">{{__('Please Fill out the Form below to create your course')}}</p>
								<div class="col-md-6">
									<ul class="data-list">
										<li>
											<label class="control-label">{{__('Course Title')}}</label>
											<div class="form-group">
												<input type="text" name="course_title" id="course_title" class="required form-control" placeholder="{{__('Course Title')}}" required>
											</div>													
										</li>
										<li>
											<label class="control-label">{{__('Short Name')}}</label>
											<div class="form-group">
												<input type="text" name="short_name" id="short_name" class="required form-control" placeholder="{{__('Short Name')}}" required>
											</div></li>
										<li>
											<label class="control-label">{{__('Course Format')}} <small>({{__('how your lessons will be organized')}})</small></label>
											<div class="styled-select">
												<select class="form-control required" name="course_format" id="course_format">
													<option value="">{{__('Select a Format')}}</option>
													<option value="SECTIONS">{{__('SECTIONS')}}</option>
													<option value="CHAPTERS">{{__('CHAPTERS')}}</option>
													<option value="MODULES">{{__('MODULES')}}</option>
													<option value="PARTS">{{__('PARTS')}}</option>
												</select>
												
											</div>
										</li>
									</ul>
								</div><!-- end col-md-6 -->
								<div class="col-md-6">                        
									<ul class="data-list" style="margin:0; padding:0;">
										<li>
											<label class="control-label">{{__('Target Audience')}}</label>
											<div class="styled-select">
												<select class="form-control required" name="target_audience" id="target_audience">
													<option value="">{{__('Select an Audience')}}</option>
													<option value="0">{{__('Beginner')}}</option>
													<option value="1">{{__('Intermediate')}}</option>
													<option value="2">{{__('Advanced')}}</option>
													<option value="3">{{__('Other')}}</option>
												</select>														
											</div>
										</li>
										<li>
											<label class="control-label">{{__('Course Subject')}}</label>
											<div class="styled-select">
												<select class="form-control required" name="category_list" id="category_list">
													<option value="">{{__('Select a Subject')}}</option>
												</select>														
											</div>
										</li>
										<li>
											<label class="control-label">{{__('Course Language')}}</label>
											<div class="styled-select">
												<select class="form-control required" name="language" id="language">
													<option value="">{{__('Select a Language')}}</option>
													<option value="en">{{__('English')}}</option>
													<option value="fr">{{__('French')}}</option>
												</select>														
											</div>
										</li>
									</ul>									
								</div><!-- end col-md-6 -->
							</div><!-- end row -->
							<div class="row">         
								<div class="col-md-12">        
									<div class="form-group">
										<div class="col-md-12"> 
											<label class="control-label">{{__('Course Description')}} <small>( {{__('What student will learn through this course') }})</small></label>     
											<textarea class="form-control required" name="course_description" id="course_description" rows="30" cols="100" required>
											</textarea>                            
										</div>
									</div>                                    
								</div>
							</div>
								
						</div><!-- end step-->            			
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="button_medium_outline" data-dismiss="modal" id="close_create_modal"><span class="icon-cross"></span> {{__('Close')}}</button>
				<button type="button" class="button_medium" id="submit_btn">{{__('Save')}}</button>
			</div>
			</div>
		  </div>
		</div>
	</div>
</div>
