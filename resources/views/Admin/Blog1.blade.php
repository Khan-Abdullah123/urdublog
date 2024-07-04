@extends('Admin.AdminLayout')
@section('title', 'Blog')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <!-- dialog -->
            <dialog id="CreateModal" style=" border: 0.1px solid black;border-radius:2%; width:80vh;">
      <div class="dialog-content">
        <section>
          <div class="dialog-header">
            <h3 class="modal-title">
              Blog
              <i
              data-close
              class="fa fa-x"
              style="float:right;cursor:pointer;font-size:25px;padding-top:13px;"
              ></i>
           </h3>
          </div>
        </section>
        <hr/>

        <section style="padding: 10px">
          <div class="dialog-body">
            <form id="blog_form">
              <input
                type="hidden"
                class="form-control"
                value=""
                name="blog_id"
                id="blog_id"
              />
              <div class="form-group mb-3">
                <label>Title</label>
                <input
                  type="text"
                  class="form-control"
                  name="blog_title"
                  id="blog_title"
                />
              </div>
              <div class="form-group mb-3">
                <label>Qoute</label>
                <textarea
                  type="text"
                  class="form-control"
                  name="post_qoute"
                  id="post_qoute"
                  rows="3"
                ></textarea>
              </div>
              <div class="form-group mb-3">
                <label>Short Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  name="blog_short_desc"
                  id="blog_short_desc"
                  rows="10"
                ></textarea>
              </div>
              <div class="form-group mb-3">
                <label>Long Description</label>
                <textarea
                  type="text"
                  class="form-control"
                  name="blog_long_desc"
                  id="blog_long_desc"
                  rows="10"
                ></textarea>
              </div>
              <div class="form-group mb-3">
                <label>Blog Image</label>
                <input
                  type="file"
                  accept="image"
                  class="form-control"
                  name="blog_image"
                  id="blog_image_input"
                />
                <div
                  class="mt-3"
                  id="image_preview"
                  style="
                    width: 100%;
                    height: 300px;
                    background: rgb(151, 151, 151) center / contain no-repeat;
                  "
                ></div>
              </div>
            </form>
          </div>
        </section>
        <hr />
      </div>
      <section>
        <div class="dialog-footer">
          <button
          data-close
            type="button"
            id="submitbtn"
            class="btn btn-lg btn-primary"
            onclick="SaveBlog() "
            style="width: 100%"
          >
            Save
          </button>
        </div>
      </section>
    </dialog>
            <div class="card my-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mt-2">Blogs</h3>
                        </div>
                        <div class="col-4">
                        <button onclick="OpenModal('CreateModal')" class="btn btn-primary mt-2">New</button>
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
        var post_qoute = '';
        let blog_short_desc = '';
        let blog_long_desc = '';
        $(document).ready(function() {
            GetData();

            post_qoute = new EasyMDE({
                element: document.getElementById('post_qoute')

            });
            blog_short_desc = new EasyMDE({
                element: document.getElementById('blog_short_desc')
            });
            blog_long_desc = new EasyMDE({
                element: document.getElementById('blog_long_desc')
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
                                    <button class="btn btn-info" onclick="EditBlog('CreateModal',${data})">Edit</button>
                                    <button class="btn btn-danger" onclick="DeleteBlog(${data})">Delete</button>`;
                        }
                    }
                ],
                responsive: true,
            });

        }

        $('#blog_image_input').on('change', (e) => {
            $('#image_preview').css({
                'background-image': ``
            });
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
        $("#submitbtn").prop('disabled', true);

        var formData = new FormData($('#blog_form')[0]);
        formData.append('post_qoute', post_qoute.value());
        formData.append('blog_short_desc', blog_short_desc.value());
        formData.append('blog_long_desc', blog_long_desc.value());

        $.ajax({
            url: "{{ route('BlogInsert') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                $('#blog_form')[0].reset();
                post_qoute.value('');
                blog_short_desc.value('');
                blog_long_desc.value('');
                $('#image_preview').css('background-image', '');
                $("#submitbtn").prop('disabled', false);
                if (res.success) {
                    swal("Success!", res.message, "success");
                    GetData();
                    $('#CreateModal').close();
                } else {
                    swal("Error!", res.message, "error");
                }
            }
        });
    }

        function DeleteBlog(id) {
        $.get("{{ route('BlogDelete') }}", { id: id }, function(data) {
            GetData();
        });
    }

        function EditBlog(modal, id) {
        OpenModal(modal);
        $.get("{{ route('BlogFetch') }}", { id: id }, function(data) {
            Object.keys(data[0]).forEach(function(key) {
                $(`#${key}`).val(data[0][key]);
            });
            post_qoute.value(data[0]['post_qoute']);
            blog_short_desc.value(data[0]['blog_short_desc']);
            blog_long_desc.value(data[0]['blog_long_desc']);
            $('#image_preview').css('background-image', `url({{ url('public/blog/') }}/${data[0]['blog_image']})`);
        });
    }

        function OpenModal(id) {
        document.getElementById(id).showModal();
        $('body').css('overflow', 'hidden');
      }

      document.addEventListener("click", function(event) {
        if (event.target.matches("[data-close]")) {
            const dialog = event.target.closest("dialog");
            if (dialog) {
                dialog.close();
                $('body').css('overflow-y', 'scroll');
            }
        }
    });


    </script>


@endsection
