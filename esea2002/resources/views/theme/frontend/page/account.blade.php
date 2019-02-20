@extends('theme.layout.frontend.main')
@section('style')
@endsection
@section('content')
<div class="main-section">
        <div class="main-container w-container">
          {{ Breadcrumbs::render('account') }}
          <div class="div-block-2-column-copy-copy">
            <div class="div-block-97">
              <div class="block-user-info">
                <div class="div-block-1168">
                    @if($customer->logo !== null)
                        @if(filter_var($customer->logo, FILTER_VALIDATE_URL) === FALSE)
                            @php $avatar = asset('img/'.$customer->logo); @endphp
                        @else
                            @php $avatar = $customer->logo; @endphp
                        @endif
                    @else
                        @php $avatar ="/assets/backend/img/no_image.png" ; @endphp
                    @endif
                    <div class="div-block-1169" id="avatar_main" style="background-image:url({{$avatar}})"></div>
                  <div class="div-block-1164">
                    @if(!empty($customer->name))
                    <h2 class="heading-20">{{$customer->name}} 
                      @if(!empty($customer->type))
                        @if($customer->type == 2)
                          <i class="fab fa-facebook-square" style="font-size:20px;color:#4267b2"></i>
                        @elseif($customer->type == 3)
                          <i class="fab fa-google-plus" style="font-size:20px;color:#de564a"></i>
                        @endif
                      @endif
                    </h2>
                    @endif

                    <div class="account-address">
                        <i class="fas fa-transgender-alt" style="font-size:20px;color:#999999"></i>
                        <div class="text-block-79">@if($customer->gender == 1) Male @elseif($customer->gender == 0) Female @else Unknown @endif</div>
                    </div>

                    @if(!empty($customer->dob))
                    <div class="account-address">
                        <i class="far fa-calendar-alt" style="font-size:20px;color:#999999"></i>
                      <div class="text-block-79">{{\Carbon\Carbon::parse($customer->dob)->format($config_language[0]->date_format)}}</div>
                    </div>
                    @endif
                    @if(!empty($customer->phone))
                    <div class="account-address">
                        <i class="fas fa-phone" style="font-size:20px;color:#999999"></i>
                    <div class="text-block-79">{{$customer->phone}}</div>
                    </div>
                    @endif
                    @if(!empty($customer->email))
                    <div class="account-address">
                        <i class="fas fa-envelope" style="font-size:20px;color:#999999"></i>
                      <div class="text-block-79">{{$customer->email}}</div>
                    </div>
                    @endif
                    @if(!empty($customer->address))
                    <div class="account-address">
                        <i class="fas fa-home" style="font-size:20px;color:#999999"></i>
                      <div class="text-block-79">{{$customer->address}}</div>
                    </div>
                    @endif

                    
                  </div>
                </div>
                <a href="account-edit.html" class="button-2new w-button btn-user-edit">Edit</a>
                <a href="account-edit.html" class="button-2new w-button btn-user-changePassword" style="margin-top:5px">Change Password</a>
              </div>

              <form id="form-account-change-pass" name="form-account-change-pass" role="form" data-toggle="validator">
                {!! csrf_field() !!}
                <div class="block-user-change-pass">
                    <div class="div-block-1164">
                      <div class="div-block-1172-copy-copy">
                        <div class="w-form w-100">
                            <label class="field-label">Mật khẩu hiện tại</label>
                            <div class="form-group">
                              <input type="password" class="text-field w-input" maxlength="256" name="oldPassword"
                                  data-name="" value="" id="oldPassword"
                                  required data-required-error="Chưa điền mật khẩu hiện tại.">
                              <div class="help-block with-errors"></div>
                              <label class="field-label">Mật khẩu mới</label>
                              <div class="form-group">
                                <input type="password" class="text-field w-input" maxlength="256" name="newPassword"
                                    data-name="" value="" id="newPassword"
                                    required data-required-error="Chưa điền mật khẩu mới.">
                                <div class="help-block with-errors"></div>
                              </div>
                              <label class="field-label">Nhập lại mật khẩu mới</label>
                              <div class="form-group">
                                <input type="password" class="text-field w-input" maxlength="256" name="renewPassword"
                                    data-name="" value="" id="renewPassword"
                                    required data-required-error="Chưa điền  nhập lại mật khẩu mới.">
                                <div class="help-block with-errors"></div>
                              </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a href="#" class="button-2new w-button btn-user-save-changePassword">Save</a>
                </div>
              </form>   
              <input type="hidden" value="" name="logo" id="logoAccount">



              <form id="form-account" name="form-account" role="form" data-toggle="validator" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <input type="hidden" value="" name="logo" id="logoAccount">
              <div class="block-user-edit">
                <div class="div-block-1168">
                  <div class="div-block-1169" id="avatar_frame"  style="background-image:url({{$avatar}})">
                    <div class="div-block-1235 upload-button">
                      <div>Upload your photo</div>
                    </div>
                    <input class="file-upload" type="file" id="avatar" name="avatar" accept="image/*"/>
                  </div>
                  <div class="div-block-1164">
                    <div class="div-block-1172-copy-copy">
                      <div class="w-form w-100">
                          <label class="field-label">Name</label>
                          <div class="form-group">
                            <input type="text" class="text-field w-input" maxlength="256" name="name"
                                 data-name="" value="{{$customer->name}}" id="fullName"
                                 required data-required-error="Tên không được trống.">
                            <div class="help-block with-errors"></div>
                          </div>
                          <label class="field-label">Gender</label>
                          <div class="div-block-1238 form-group block-gender">
                            <div class="block-radio">
                              <div class="radio-button-field w-radio">
                                <label class="w-form-label">
                                  <input type="radio" id="male" name="gender" value="1" data-name="" class="w-radio-input" @if($customer->gender == 1) checked @endif required data-required-error="Giới tính không được trống.">
                                  Male
                                </label>
                              </div>
                              <div class="w-radio">
                                <label class="w-form-label">
                                  <input type="radio" id="female" name="gender" value="0" data-name="" class="w-radio-input" @if($customer->gender == 0) checked @endif required data-required-error="Giới tính không được trống.">
                                  Female
                                </label>
                              </div>
                            </div>
                            <div class="help-block with-errors"></div>
                          </div>
                          <label class="field-label">Birthday</label>
                          <div class="div-block-1239">
                            <div class="form-group w-100">
                              <input type="text" name="dob" id="birthdayAccount" class="birthday text-field w-input" value="{{\Carbon\Carbon::parse($customer->dob)->format('Y-m-d')}}" required data-required-error="Ngày sinh không được trống."/>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <label class="field-label">Phone</label>
                          <div class="form-group">
                            <input type="text" class="text-field w-input" maxlength="256" name="phone" maxlength="15" data-name="" value="{{$customer->phone}}"
                                 id="phone" required data-required-error="Phone không được trống.">
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="#" class="button-2new w-button btn-user-save">Save</a>
              </div>
            </form>
            </div>
            <div class="child">
              <div class="boder">
                <div class="w-100">
                  <div class="div-block-1170-copy">
                    <div class="icon-big"></div>
                    <h3 class="heading-19">Your child</h3>
                  </div>
                  <div class="div-block-80-copy">
                    <div class="block-list-child">

                    @foreach($customer->mChildren as $k => $v)
                      <div class="child-item" id="child_item_{{$v->id}}">
                        <div class="div-block-1172">
                          <div class="child-item-name div-block-1172">
                          <div class="text-block-80-copy">{{$v->name}}</div>
                          @if($v->gender == 0)
                              <div class="icon-copy _1"></div>
                          @endif
                          @if($v->gender == 1)
                              <div class="icon-copy"></div>
                          @endif
                          </div>
                          <div class="child-item-action">
                            <i class="fas fa-pencil-alt color-green btn-child-edit" data-id="{{$v->id}}"></i>
                            <i class="fas fa-trash color-red btn-child-delete" data-id="{{$v->id}}"></i>
                          </div>
                        </div>
                      {{-- <div class="text-block-80"><strong>School:</strong> <a href="{{asset($v->mSchool->mSchoolTranslations[0]->slug)}}">{{$v->mSchool->mSchoolTranslations[0]->name}}</a></div> --}}
                        <div class="text-block-80"><strong>Birthday:</strong> {{\Carbon\Carbon::parse($v->dob)->format($config_language[0]->date_format)}}</div>
                        <div class="text-block-80"><strong>Genitive:</strong> 
                        {{$v->genitive}}
                        </div>
                      </div>
                    @endforeach
                    </div>

                    <div class="block-form-child">
                      <div class="div-block-1172-copy">
                        <div class="w-form">
                          <form id="form-child" name="email-form-3" data-name="Email Form 3" role="form" data-toggle="validator">
                              {!! csrf_field() !!}
                            <input type="hidden" id="idChild" name="idChild">
                            <label for="nameChild" class="field-label">Name</label>
                            <div class="form-group">
                              <input type="text" class="text-field w-input" maxlength="256"
                                   name="nameChild"
                                   data-name=""
                                   id="nameChild" required data-required-error="Tên không được trống.">
                              <div class="help-block with-errors"></div>
                            </div>
                            <label class="field-label">Gender</label>
                            <div class="div-block-1238 form-group block-gender">
                              <div class="block-radio">
                                <div class="radio-button-field w-radio">
                                  <label for="boy" class="w-form-label">
                                    <input type="radio" id="boy" name="genderChild" value="1" data-name="" class="w-radio-input"
                                           required data-required-error="Giới tính không được trống." >
                                    Boy
                                  </label>
                                  
                                </div>
                                <div class="w-radio">
                                  <label for="girl" class="w-form-label">
                                    <input type="radio" id="girl" name="genderChild" value="0" data-name="" class="w-radio-input"
                                           required data-required-error="Giới tính không được trống." >
                                    Girl
                                  </label>
                                </div>
                              </div>
                              <div class="help-block with-errors"></div>
                            </div>
                            <label class="field-label">Birthday</label>
                            <div class="div-block-1239">
                              <div class="form-group w-100">
                                <input type="text" class="birthday text-field w-input"
                                      id="birthChild" name="birthChild"
                                       required data-required-error="Ngày sinh không được trống."/>
                                <div class="help-block with-errors"></div>
                              </div>
                            </div>
                            <label class="field-label">Genitive</label>
                            <div class="form-group">
                              <select name="genitive[]" id="genitiveChild" class="div-block-109 txt-search-advanced _8 txt-search txt-search-service genitive1"  multiple="multiple" style="display: none;" 
                              required="" data-required-error="Tính cách không được trống.">
                                  @foreach($genitive as $k => $v)
                                      <option value="{{$v->genitive}}">{{$v->genitive}}</option>
                                  @endforeach
                              <select>
                              <div class="help-block with-errors"></div>
                            </div>
                            <div class="text-center">
                              <a href="#" class="button-2new-copy w-button btn-child-save">Save</a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="block-form-add-child">
                      <div class="div-block-1172-copy">
                        <div class="w-form">
                          <form id="form-add-child" name="email-form-3" data-name="Email Form 3" role="form" data-toggle="validator">
                              {!! csrf_field() !!}
                            <input type="hidden" id="idChild" name="idChild">
                            <label for="nameChild" class="field-label">Name</label>
                            <div class="form-group">
                              <input type="text" class="text-field w-input" maxlength="256"
                                   name="nameAddChild"
                                   data-name=""
                                   id="nameAddChild" required data-required-error="Tên không được trống.">
                              <div class="help-block with-errors"></div>
                            </div>
                            <label class="field-label">Gender</label>
                            <div class="div-block-1238 form-group block-gender">
                              <div class="block-radio">
                                <div class="radio-button-field w-radio">
                                  <label for="boy-add" class="w-form-label">
                                    <input type="radio" id="boy-add" name="genderAddChild" value="1" data-name="" class="w-radio-input"
                                           required data-required-error="Giới tính không được trống." >
                                    Boy
                                  </label>
                                </div>
                                <div class="w-radio">
                                  <label for="girl-add" class="w-form-label">
                                    <input type="radio" id="girl-add" name="genderAddChild" value="0" data-name="" class="w-radio-input"
                                           required data-required-error="Giới tính không được trống." >
                                    Girl
                                  </label>
                                </div>
                              </div>
                              <div class="help-block with-errors"></div>
                            </div>
                            <label class="field-label">Birthday</label>
                            <div class="div-block-1239">
                              <div class="form-group w-100">
                                <input type="text" class="birthday text-field w-input"
                                      id="birthAddChild" name="birthAddChild"
                                       required data-required-error="Ngày sinh không được trống."/>
                                <div class="help-block with-errors"></div>
                              </div>
                            </div>
                            <label class="field-label">Genitive</label>
                            <div class="form-group">
                              <select name="genitiveAddChild[]" id="genitiveAddChild" class="div-block-109 txt-search-advanced _8 txt-search txt-search-service genitive"  multiple="multiple" style="display: none;" 
                              required="" data-required-error="Tính cách không được trống.">
                                  @foreach($genitive as $k => $v)
                                      <option value="{{$v->genitive}}">{{$v->genitive}}</option>
                                  @endforeach
                              <select>
                              
                              <div class="help-block with-errors"></div>
                            </div>
                            <div class="text-center">
                              <a href="#" class="button-2new-copy w-button btn-add-child-save">Save</a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <a href="#add-child" class="button-4-copy w-button btn-child-add">Add childs</a>
                    </div>
                    <div class="col-md-6 col-sm-12">
                    <a href="{{asset('schools')}}" class="button-4-copy w-button">Find school for your childs</a>
                    </div>
                  </div>
                </div>
              </div>

              @if(count($customer->mWishlists) > 0)
              <div class="boder-copy noline">
                <div class="div-block-1170">
                  <div class="icon-big _2"></div>
                  <h3 class="heading-19">Favourite Schools</h3>
                </div>
                <div class="div-block-80-copy">
                  @foreach($customer->mWishlists as $k => $v)
                  <div class="link-school">
                    <a href="{{asset($v->mSchool->mSchoolTranslations[0]->slug)}}">
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          {{$v->mSchool->mSchoolTranslations[0]->name}}
                        <button data-action="0" data-id="{{$v->mSchool->id}}" type="button" class="close unWishlist" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </a>
                  </div>
                  @endforeach
                </div>
              </div>
              @endif

            </div>
            <div class="div-block-new">

                @include('theme.frontend.section.promotion.ads')

            </div>
          </div>
        </div>
      </div>


      <div class="section-email-enter">
            <div class="container w-container">
                @include('theme.frontend.section.homepage.subscribe')
            </div>
        </div>
          <!-- Confirm modal -->
  <div class="modal fade" id="confirm-delete-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
              <i class="fas fa-exclamation-triangle text-red"></i> Thông báo
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" class="form-control" id="idChild" name="idChild" required>
                Bạn có chắc chắn muốn xóa?
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-warning"
                    id="confirm-delete">Đồng ý</button>
            <button type="button" data-dismiss="modal" class="btn">Hủy bỏ</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- Confirm modal -->
@endsection

@section('script')
    <script src="{{asset('assets/frontend/js/account.js')}}" type="text/javascript"></script>
@endsection