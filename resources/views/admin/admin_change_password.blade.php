@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Admin Change Password</h4>
                </div>

                @if(count($errors))
                    @foreach($errors-> all() as $errors)
                        <p class="alert alert-danger alert-dismissible fade show">
                            {{$errors}}
                        </p>
                    @endforeach

                @endif
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{route('admin.update.password')}}"
                            ">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Old Password <span class="text-danger">*</span></h5>
                                                <div class="controls">

                                                    <input type="password" id="current_password" name="oldpassword" class="form-control"
                                                           value="" required
                                                           data-validation-required-message="This field is required">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>New Password <span class="text-danger">*</span></h5>
                                                <div class="controls">

                                                    <input type="password" id="password" name="newpassword" class="form-control"
                                                           value="" required
                                                           data-validation-required-message="This field is required">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Confirm new Password <span class="text-danger">*</span></h5>
                                                <div class="controls">

                                                    <input type="password" name="confirm_password" class="form-control"
                                                           value="" required
                                                           data-validation-required-message="This field is required">

                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-xs-right">
                                                <button type="submit" class="btn btn-rounded btn-primary mb-5">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

    </div>

@endsection
