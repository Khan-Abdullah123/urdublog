@extends('Admin.AdminLayout')
@section('title', 'Portfolio')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <!-- Modal -->
            <div class="modal fade" id="portfolio_modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Portofio</h3>
                        </div>
                        <div class="modal-body">
                            <form id="portfolio_form">
                                <div class="form-group mb-3">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="portfolio_name">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Subtitle</label>
                                    <input type="text" class="form-control" name="portfolio_subtitle">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Category</label>
                                    <select type="text" class="form-control" name="portfolio_category">
                                        <option value="logo-design">Logo Design</option>
                                        <option value="ui/ux-design">UI/UX Design</option>
                                        <option value="software">Software</option>
                                        <option value="branding">Branding</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Portfolio Image</label>
                                    <input type="file" accept="image/*" class="form-control" name="portfolio_image"
                                        id="portfolio_image">
                                    <div class="mt-3" id="image_preview"
                                        style="width: 100%; height: 300px; background: rgb(151, 151, 151) center / contain no-repeat;
                                    ">

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submitbtn" class="btn btn-lg btn-primary" onclick="SavePortfolio()"
                                style="width: 100%">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mt-2">Porfolio</h3>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary mt-2" style="float: right"
                                onclick="$('#portfolio_modal').modal('show')">New</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="portfolio_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
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
            GetData()
        });

        function GetData() {
            $('#portfolio_table').DataTable().destroy()
            $.get("{{ route('PortfolioFetch') }}", [],
                (res) => {
                    $('#portfolio_table').DataTable({
                        data: res,
                        columns: [{
                                data: 'portfolio_id',
                                "searchable": true,
                                "orderable": true,
                            },
                            {
                                data: 'portfolio_name',
                                "searchable": true,
                                "orderable": true,
                            },
                            {
                                data: 'portfolio_category',
                                "searchable": true,
                                "orderable": true,
                            },
                            {
                                data: 'portfolio_image',
                                render: function(data) {
                                    return `<img src="{{ url('public/portfolio/${data}') }}" height="50">`;
                                }
                            },
                            {
                                data: 'portfolio_id',
                                render: function(data) {
                                    return `<button class="btn btn-danger" onclick="DeletePortfolio(${data})">Delete</button>`;
                                }
                            }
                        ],
                        responsive: true,
                    });
                }
            );

        }

        $('#portfolio_image').on('change', (e) => {
            const reader = new FileReader();
            const file = e.target.files[0];
            if (!file.type.match('image.*')) {
                swal("Warning", "Please select an image file.", "warning");
                return $('#portfolio_image').val('');
            }
            reader.onload = function(e) {
                $('#image_preview').css('background-image', `url(${e.target.result})`);
            };
            reader.readAsDataURL(file);
        });

        function SavePortfolio() {
            $("#submitbtn").prop('disabled', true)
            var formData = new FormData($('#portfolio_form')[0]);
            $.ajax({
                url: "{{ 'PortfolioInsert' }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: (res) => {
                    $("#submitbtn").prop('disabled', false)
                    if (res.success) {
                        swal("Success!", res.message, "success");
                        GetData();
                    } else {
                        swal("Error!", res.message, "error");
                    }
                }
            });
        }
        function DeletePortfolio(id) {
            console.log(id);
            $.get("{{'PortfolioDelete'}}", {id: id},
                function (data) {
                    console.log(data);
                }
            );
        }
    </script>
@endsection
