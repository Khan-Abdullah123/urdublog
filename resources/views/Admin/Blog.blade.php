@extends('Admin.AdminLayout')
@section('title', 'Blog')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <!-- Modal -->
            <div class="modal fade" id="blog_modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Blog</h3>
                        </div>
                        <div class="modal-body">
                            <form id="blog_form">
                                <input type="hidden" class="form-control" value="" name="blog_id" id="blog_id">
                                <div class="form-group mb-3">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="blog_title" id="blog_title">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Qoute</label>
                                    <textarea type="text" class="form-control" name="post_qoute" id="post_qoute" rows="3"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Short Description</label>
                                    <textarea type="text" class="form-control" name="blog_short_desc" id="blog_short_desc" rows="10"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Long Description</label>
                                    <textarea type="text" class="form-control" name="blog_long_desc" id="blog_long_desc" rows="10"></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Blog Image</label>
                                    <input type="file" accept="image/*" class="form-control" name="blog_image"
                                        id="blog_image_input">
                                    <div class="mt-3" id="image_preview" style="width: 100%; height: 300px; background: rgb(151, 151, 151) center / contain no-repeat;">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submitbtn" class="btn btn-lg btn-primary" onclick="SaveBlog()"
                                style="width: 100%">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mt-2">Blogs</h3>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary mt-2" style="float: right"
                                onclick="$('#blog_modal').modal('show')">New</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="blog_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
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
        $(document).ready(function() {
            GetData();
            $('#blog_short_desc').summernote({
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
            $('#blog_long_desc').summernote({
                height: 300,

            });
        });



        function GetData() {
            $('#blog_table').DataTable().destroy()
            $('#blog_table').DataTable({
                        ajax: {
                        url: "{{ route('BlogFetch') }}",
                                 dataSrc: ""
                                },
                        columns: [{
                                data: 'blog_id',
                                "searchable": true,
                                "orderable": true,
                            },
                            {
                                data: 'blog_title',
                                "searchable": true,
                                "orderable": true,
                            },
                        /*     {
                                data: 'blog_category',
                                "searchable": true,
                                "orderable": true,
                            }, */
                            {
                                data: 'blog_image',
                                render: function(data) {
                                    return `<img src="{{ url('public/blog/${data}') }}" height="50">`;
                                }
                            },
                            {
                                data: 'blog_id',
                                render: function(data) {
                                    return `
                                    <button class="btn btn-info" onclick="EditBlog(${data})">Edit</button>
                                    <button class="btn btn-danger" onclick="DeleteBlog(${data})">Delete</button>`;
                                }
                            }
                        ],
                        responsive: true,
                    });

        }

        $('#blog_image_input').on('change', (e) => {
            $('#image_preview').css({'background-image': ``});
            const reader = new FileReader();
            const file = e.target.files[0];
            if (!file.type.match('image.*')) {
                swal("Warning", "Please select an image file.", "warning");
                return $('#blog_image_input').val('');
            }
            reader.onload = function(e) {
                // $('#image_preview').css({'background-image': ``});

                $('#image_preview').css('background-image', `url(${e.target.result})`);
            };
            reader.readAsDataURL(file);
        });

        function SaveBlog() {
            $("#submitbtn").prop('disabled', true)
            var formData = new FormData($('#blog_form')[0]);
            $.ajax({
                url: "{{ 'BlogInsert' }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: (res) => {
                    $('#blog_form')[0].reset();
                    $("#blog_short_desc").summernote('code',"")
                    $("#blog_long_desc").summernote('code', "")
                    $('#image_preview').css('background-image', `url('')`);
                    $("#submitbtn").prop('disabled', false)
                    if (res.success) {
                        swal("Success!", res.message, "success");
                        GetData();
                        $('#blog_modal').modal('hide')
                    } else {
                        swal("Error!", res.message, "error");
                    }
                }
            });
        }

        function DeleteBlog(id) {
            $.get("{{ 'BlogDelete' }}", {
                    id: id
                },
                function(data) {
                    GetData()
                }
            );
        }

        function EditBlog(id) {
            $.get("{{ 'BlogFetch' }}", {
                    id: id
                },
                function(data) {
                    Object.keys(data[0]).map((e) => {
                        $(`#${e}`).val(data[0][e])
                    })
                    $("#blog_short_desc").summernote('code', data[0]['blog_short_desc'])
                    $("#blog_long_desc").summernote('code', data[0]['blog_long_desc'])
                    $('#image_preview').css('background-image', `url({{ url('public/blog/') }}/${data[0]['blog_image']})`);
                    $('#blog_modal').modal('show')
                }
            );
        }
    </script>
@endsection
