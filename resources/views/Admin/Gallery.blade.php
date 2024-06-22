@extends('Admin.AdminLayout')
@section('title', 'Gallery')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <!-- Modal -->
            <div class="modal fade" id="gallery_modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Gallery</h3>
                        </div>
                        <div class="modal-body">
                            <form id="gallery_form">
                                <input type="hidden" class="form-control" value="" name="gallery_id" id="gallery_id">
                                {{--  <div class="form-group mb-3">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="gallery_title" id="gallery_title">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Short Description</label>
                                    <textarea type="text" class="form-control" name="gallery_short_desc" id="gallery_short_desc" rows="10"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Long Description</label>
                                    <textarea type="text" class="form-control" name="gallery_long_desc" id="gallery_long_desc" rows="10"></textarea>
                                </div> --}}

                                <div class="form-group mb-3">
                                    <label>Gallery Image</label>
                                    <input type="file" accept="image/*" class="form-control" name="gallery_image"
                                        id="gallery_image_input">
                                    <div class="mt-3" id="image_preview"
                                        style="width: 100%; height: 300px; background: rgb(151, 151, 151) center / contain no-repeat;">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submitbtn" class="btn btn-lg btn-primary" onclick="SaveGallery()"
                                style="width: 100%">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mt-2">Gallery</h3>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary mt-2" style="float: right"
                                onclick="$('#gallery_modal').modal('show')">New</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="gallery_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                {{-- <th>Name</th> --}}
                                {{-- <th>Category</th> --}}
                                <th>Image</th>
                                <th>Action</th>
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
        var dataTable = "";
        $(document).ready(function() {
            GetData();
            $('#gallery_short_desc').summernote({
                tabDisable: true,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                        'subscript', 'clear'
                    ]],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ol', 'ul', 'paragraph', 'height']],
                    ['insert', ['link']],
                    ['view', ['undo', 'redo', 'help']]
                ]
            });
            $('#gallery_long_desc').summernote({
                height: 300,

            });
        });



        function GetData() {
            $('#gallery_table').DataTable().destroy()
            $('#gallery_table').DataTable({
                ajax: {
                    url: "{{ route('GalleryFetch') }}",
                    dataSrc: ""
                },
                columns: [{
                        data: 'gallery_id',
                        "searchable": true,
                        "orderable": true,
                    },
                    {
                        data: 'gallery_image',
                        render: function(data) {
                            return `<img src="{{ url('public/gallery/${data}') }}" height="50">`;
                        }
                    },
                    {
                        data: 'gallery_id',
                        render: function(data) {
                            return `
                                    <button class="btn btn-info" onclick="EditGallery(${data})">Edit</button>
                                    <button class="btn btn-danger" onclick="DeleteGallery(${data})">Delete</button>`;
                        }
                    }
                ],
                responsive: true,
            });
        }

        $('#gallery_image_input').on('change', (e) => {
            $('#image_preview').css({
                'background-image': ``
            });
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

        function SaveGallery() {
            $("#submitbtn").prop('disabled', true)
            var formData = new FormData($('#gallery_form')[0]);
            $.ajax({
                url: "{{ 'GalleryInsert' }}",
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
            }).done(() => {

                GetData();
            });

        }

        function DeleteGallery(id) {
            $.get("{{ 'GalleryDelete' }}", {
                    id: id
                },
                function(data) {
                    GetData()
                }
            );
        }

        function EditGallery(id) {
            $.get("{{ 'GalleryFetch' }}", {
                    id: id
                },
                function(data) {
                    Object.keys(data[0]).map((e) => {
                        $(`#${e}`).val(data[0][e])
                    })
                    // $("#gallery_short_desc").summernote('code', data[0]['gallery_short_desc'])
                    // $("#gallery_long_desc").summernote('code', data[0]['gallery_long_desc'])
                    $('#image_preview').css('background-image',
                        `url({{ url('public/gallery/') }}/${data[0]['gallery_image']})`);
                    $('#gallery_modal').modal('show')
                }
            );
        }
    </script>
@endsection
