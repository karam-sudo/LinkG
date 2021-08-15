<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="{{ asset('assets/images/pre-loader/loader-01.svg') }}" >
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <strong class="mb-0">ContactUs</strong>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>

                </div>
            </div>
           
            <!-- widgets -->
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered p-0" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-20p border-bottom-0">Email</th>
                                    <th class="wd-15p border-bottom-0">Phone</th>
                                    <th class="wd-15p border-bottom-0">Message</th>
                                    <th class="wd-15p border-bottom-0">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact_us as $contact)

                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $contact->Name }}</td>
                                        <td>{{ $contact->Email }}</td>
                                        <td>{{ $contact->Phone }}</td>
                                        <td>{{ $contact->Message }}</td>
                                        <td>{{ $contact->created_at->diffForHumans()}}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Orders Status widgets-->


            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')

</body>

</html>
