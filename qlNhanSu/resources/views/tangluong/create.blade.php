<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm tăng lương</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="formKiLuat" method="post" action="{{ route('kiluats.store') }}" class="m-5 mt-2 formKiLuat">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã tăng lương:</label>
                                <input class="form-control pt90" type="text" name="maTangLuong" id="maTangLuong" value="{{ old('maTangLuong') }}" placeholder="(*)" required>
                                <span id="errorMaTangLuong" class="error"></span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày tăng lương:</label>
                                <input class="form-control pt90" type="date" name="ngaytangluong" id="ngaytangluong" required>
                                <span id="errorNgayTangLuong" class="error"></span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Lí do tăng lương:</label>
                                <input class="form-control pt90" type="text" name="lidotangluong" id="lidotangluong" placeholder="(*)" required>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Chi tiết tăng lương:</label>
                                <input class="form-control pt90" type="text" name="chitiettangluong" id="chitiettangluong" placeholder="(*)" required>
                            </div>
                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã nhân sự:</label>
                                <select name="mans" id="mans">
                                    @foreach ($nhansus as $nhansu)
                                        <option value="{{ $nhansu->Manhansu }}">
                                            {{ $nhansu->Manhansu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group  float-end ">
                                <a href="{{ route('tangluongs.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddKiLuat">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script>
            $('#errorMaTangLuong').hide();
            $('#errorNgayTangLuong').hide();

            $(document).on('keyup', '#maTangLuong', function(){
                $.ajax({
                    url: '{{ route("check_maTangLuong_unique") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        maTangLuong: function(){
                            return $('#maTangLuong').val();
                        }
                    },
                    success: function(response){
                        if(response == 'b'){
                            $("#errorMaTangLuong").text("Mã tăng lương đã tồn tại").show();
                        }else if(response=="c"){
                            $("#errorMaTangLuong").text("Dữ liệu nhập có chứa kí tự đặc biệt").show();
                        }else{
                            $("#errorMaTangLuong").hide();
                        }
                    }
                })
            });

            $('#ngaytangluong').on('change', function() {
                $.ajax({
                    url: '{{ route("check_ngaytangluong") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        ngaytangluong: function(){
                            return $('#ngaytangluong').val();
                        },
                        mans: function(){
                            return $('#mans').val();
                        }
                    },
                    success: function(response){
                        if(response=="ko hop le"){
                            $("#errorNgayTangLuong").text("Ngày tăng lương phải sau ngày vào làm của nhân sự").show();
                        }else{
                            $("#errorNgayTangLuong").hide();
                        }
                    }
                })    
            });

            $(document).on('submit', '.formKiLuat', function(e) {
                e.preventDefault();
                if (!($("#errorMaTangLuong").is(":hidden")) || !($("#errorNgayTangLuong").is(":hidden"))) {
                    toastr.warning('Kiểm tra lại dữ lại nhập', 'Thông báo');
                } else {
                    $.ajax({
                    url: "{{ route('tangluongs.store') }}",
                    type: 'post',
                    data: $('.formKiLuat').serialize(),
                    success: function (response) {
                        $('#maTangLuong').val('');
                        $('#lidotangluong').val('');
                        $('#ngaytangluong').val('');
                        $('#chitiettangluong').val('');
                        toastr.options = {
                        "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm mới tăng lương thành công', 'Thông báo');
                    },
                    })   
                }
            });
        </script>

        @endsection
</x-app-layout>
