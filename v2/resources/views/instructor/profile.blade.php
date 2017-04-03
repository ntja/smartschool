@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Profile')}}
@stop

@section('header-styles')
	
@stop
@section('content')
	@include('partials/instructor/header')
 
<section id="main_content">

<div class="container">

<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li class="active">Profile</li>
</ol>
     <div class="row">
         <div class="col-md-12">
     
     				<!--  Tabs -->   
                    <ul class="nav nav-tabs" id="mytabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                        <li><a href="#courses" data-toggle="tab">My Courses / Downloads</a></li>
                        <li><a href="#agenda" data-toggle="tab">My Agenda</a></li>
                        <li><a href="#plans" data-toggle="tab">Plans/billing</a></li>
                    </ul>
                    
                    <div class="tab-content">
                    
                        <div class="tab-pane fade in active" id="profile">
                        	<div class="row">
                                	 <aside class="col-md-4">
                                        <div class=" box_style_1 profile">
                                        <p class="text-center"><img src="img/teacher_2_small.jpg" alt="Teacher" class="img-circle styled"></p>
                                            <ul>
                                                <li>Name <strong class="pull-right">Marc Twain</strong> </li>
                                                <li>Email <strong class="pull-right">info@domain.com</strong></li>
                                                <li>Telephone  <strong class="pull-right">+34 004238423</strong></li>
                                                <li>Country<strong class="pull-right">United Kindom</strong></li>
                                                <li>Gender <strong class="pull-right">Male</strong></li>
                                                <li>Education <strong class="pull-right">Degree level</strong></li>
                                                <li>Age  <strong class="pull-right">34</strong></li>
                                            </ul>
                                            </div><!-- End box-sidebar -->
                                     </aside><!-- End aside -->
                        	<div class="col-md-8">
                                <h3>Biography</h3>
                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis.. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapiPhasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel</p>
                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis.. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapiPhasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel</p>
                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis.. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapiPhasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel</p>
                           </div><!-- End col-md-8 -->
                        </div><!-- End row -->
                       </div><!-- End tab-pane --> 
                       
                        <div class="tab-pane fade" id="courses">
                           <h3>Courses you're following</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. </p>
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Category</th>
                                        <th>Course name</th>
                                        <th>Date Purchased</th>
                                        <th>Progress</th>
                                        <th>Downloads</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>Business</td>
                                        <td><a href="#">Business Plan</a></td>
                                        <td>20/04/2015</td>
                                        <td><img src="img/bullet_complete_2.png" alt=""> Completed</td>
                                        <td><a href="#"><i class="icon-video"></i> Videos</a></td>
                                      </tr>
                                      <tr>
                                        <td>Math</td>
                                        <td><a href="#">12 Principles</a></td>
                                        <td>20/04/2015</td>
                                        <td><img src="img/bullet_progress_2.png" alt=""> In progress</td>
                                        <td><a href="#"><i class="icon-mic"></i> Audio</a></td>
                                      </tr>
                                      <tr>
                                        <td>Litterature</td>
                                        <td><a href="#">Poetry course</a></td>
                                        <td>20/04/2015</td>
                                        <td><img src="img/bullet_start_2.png" alt=""> Not started</td>
                                        <td><a href="#"><i class="icon-doc"></i> Doc</a></td>
                                      </tr>
                                      <tr>
                                        <td>Biology</td>
                                        <td><a href="#">Fundamentals</a></td>
                                        <td>20/04/2015</td>
                                        <td><img src="img/bullet_start_2.png" alt=""> Not started</td>
                                        <td><a href="#"><i class="icon-doc"></i> Doc</a></td>
                                      </tr>
                                      <tr>
                                        <td>Marketing</td>
                                        <td><a href="#">12 Principles</a></td>
                                        <td>20/04/2015</td>
                                        <td><img src="img/bullet_progress_2.png" alt=""> In progress</td>
                                      <td><a href="#"><i class="icon-video"></i> Videos</a></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  </div>
                        </div><!-- End tab-pane --> 
                        
                         <div class="tab-pane fade" id="agenda">
                         
                             <div class="row">
                                  <aside class="col-md-4">
                                  	 <div class="box_style_1"  id="external-events">
                                     	<h4>Draggable Events</h4>
                                            <div class='external-event'>Coffe Break</div>
                                            <div class='external-event'>Meeting</div>
                                            <div class='external-event'>Lesson</div>
                                            <div class='external-event'>Exam</div>
                                            <p><input type='checkbox' id='drop-remove' /><label for='drop-remove'>remove after drop</label></p>
                                     </div>
                                  </aside>
                                  
                                  <div class="col-md-8">
                                  <div id="calendar"></div><!-- End calendar --> 
                                  </div>
                                  
                             </div><!-- End row --> 
                        
                       	</div><!-- End tab-pane --> 
                        
                        <div class="tab-pane fade" id="plans">
                             <h3>Change your Payment method</h3>
                            <div  id="payment_opt">
                                <label class="radio-inline">
                                <input type="radio" id="" value="" name="payment" checked><img src="img/logo_paypal.png" alt="Paypal" class="payment_logos">
                                </label>
                                 <label class="radio-inline">
                                <input type="radio" id="" value="" name="payment"><img src="img/logo_visa.png" alt="Card" class="payment_logos">
                                </label>
                                 <label class="radio-inline">
                                <input type="radio" id="" value="" name="payment"><img src="img/logo_master.png" alt="Card" class="payment_logos">
                                </label>
                                 <label class="radio-inline">
                                <input type="radio" id="" value="" name="payment"><img src="img/logo_maestro.png" alt="Card" class="payment_logos">
                                </label>
                            </div>       
                            <hr>                     
                       
                            <h3>Order summary</h3>
              			 <div class="table-responsive">             
                                <table class="table table-hover " style="margin-bottom:0;">
                                    <thead>
                                    <tr>								
                                        <th>Items</th>
                                        <th>Amount</th>									
                                    </tr></thead>
                                <tbody>
                                <tr>
                                    <td>Price of the course</td>
                                    <td>€0.99</td>
                                </tr>
                                 <tr class="info" style="border-top: 2px solid #ccc; border-bottom: 2px solid #ccc; font-size:18px">
                                    <td><strong>TOTAL</strong></td>
                                    <td><strong>€0.99</strong></td>
                                </tr>
                                <tr>
                                    <td><small>without VAT</small></td>
                                    <td><small>€ 0.83</small></td>
                                </tr>
                                <tr>
                                    <td><small>VAT (19%)</small></td>
                                    <td> <small>€0.16</small> </td>
                                </tr>
                              
                            </tbody></table>
                        </div>
                    </div><!-- End tab-pane --> 
     		
         </div><!-- End col-md-8-->
      </div>   
    </div><!-- End row-->   
</div><!-- End container -->
</section><!-- End main_content-->
   
@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
@stop

@stop