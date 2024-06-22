@extends('Admin.AdminLayout')
@section('title', 'Enquiries')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <!-- Modal -->

            <div class="card my-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mt-2">Enquiries</h3>
                        </div>
                     {{--  --}}
                    </div>
                </div>
                <div class="card-body">
                    <table id="gallery_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            GetData();

        });



        function GetData() {
            $('#gallery_table').DataTable().destroy()
            $.get("{{ route('ContactsFetch') }}", [],
                (res) => {
                    $('#gallery_table').DataTable({
                        data: res,
                        columns: [
                            {
                                data: 'id',
                                "searchable": true,
                                "orderable": true,
                            },

                            {
                                data: 'name',
                                "searchable": true,
                                "orderable": true,
                            },

                            {
                                data: 'email',
                                "searchable": true,
                                "orderable": true,
                            },


                            {
                                data: 'message',
                                "searchable": true,
                                "orderable": true,
                            },


                        ],
                        responsive: true,
                    });
                }
            );

        }

        $('#gallery_image_input').on('change', (e) => {
            $('#image_preview').css({'background-image': ``});
            const reader = new FileReader();
            const file = e.target.files[0];
            if (!file.type.match('image.*')) {
                swal("Warning", "Please select an image file.", "warning");
                return $('#gallery_image_input').val('');
            }
            reader.onload = function(e) {
                // $('#image_preview').css({'background-image': ``});

                $('#image_preview').css('background-image', `url(${e.target.result})`);
            };
            reader.readAsDataURL(file);
        });

        function SaveEnquiries() {
            $("#submitbtn").prop('disabled', true)
            var formData = new FormData($('#gallery_form')[0]);
            $.ajax({
                url: "{{ 'EnquiriesInsert' }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: (res) => {
                    $('#gallery_form')[0].reset();
                    // $("#gallery_short_desc").summernote('code',"")
                    // $("#gallery_long_desc").summernote('code', "")
                    $('#image_preview').css('background-image', `url('')`);
                    $("#submitbtn").prop('disabled', false)
                    if (res.success) {
                        swal("Success!", res.message, "success");
                        GetData();
                    } else {
                        swal("Error!", res.message, "error");
                    }
                }
            }).done(()=>{

                GetData();
            });

        }



    </script>
@endsection
