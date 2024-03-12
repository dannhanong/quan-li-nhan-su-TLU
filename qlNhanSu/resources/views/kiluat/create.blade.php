<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm kỉ luật</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="formKiLuat" method="post" action="{{ route('kiluats.store') }}" class="m-5 mt-2 formKiLuat">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã kỉ luật:</label>
                                <input class="form-control pt90" type="text" name="maKiLuat" id="maKiLuat" value="{{ old('maKiLuat') }}" placeholder="(*)" required>
                                <span id="errorMaKiLuat" class="error"></span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày kỉ luật:</label>
                                <input class="form-control pt90" type="date" name="ngaykiluat" id="ngaykiluat" required>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Lí do kỉ luật:</label>
                                <input class="form-control pt90" type="text" name="lidokiluat" id="lidokiluat" placeholder="(*)" required>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Chi tiết kỉ luật:</label>
                                <input class="form-control pt90" type="text" name="chitietkiluat" id="chitietkiluat" placeholder="(*)" required>
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
                                <a href="{{ route('kiluats.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddKiLuat">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script>
            $('#errorMaKiLuat').hide();
            // $('#formKiLuat').validate({
            //     rules:{
            //         maKiLuat:{
            //             required: true
            //         },
            //         tenKiLuat:{
            //             required: true
            //         }
            //     }
            //     ,messages:{
            //         maKiLuat: {
            //             required: "Vui lòng nhập mã kỉ luật"
            //         },
            //         tenKiLuat: {
            //             required: "Vui lòng nhập tên kỉ luật"
            //         },
            //     }
            // });
            $(document).on('keyup', '#maKiLuat', function(){
                $.ajax({
                    url: '{{ route("check_maKiLuat_unique") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        maKiLuat: function(){
                            return $('#maKiLuat').val();
                        }
                    },
                    success: function(response){
                        if(response == 'b'){
                            $("#errorMaKiLuat").text("Mã kỉ luật đã tồn tại")
                            $("#errorMaKiLuat").show();
                        }else if(response=="a"){
                            $("#errorMaKiLuat").text("Vui lòng nhập mã Kỉ luật");
                            $("#errorMaKiLuat").show();
                        }else if(response=="c"){
                            $("#errorMaKiLuat").hide();
                        }
                    }
                })
            });

            $(document).on('submit', '.formKiLuat', function(e) {
                e.preventDefault();
                if (!($("#errorMaKiLuat").is(":hidden"))) {
                    toastr.warning('Kiểm tra lại dữ lại nhập', 'Thông báo');
                } else {
                    $.ajax({
                    url: "{{ route('kiluats.store') }}",
                    type: 'post',
                    data: $('.formKiLuat').serialize(),
                    success: function (response) {
                        $('#maKiLuat').val('');
                        $('#lidokiluat').val('');
                        $('#ngaykiluat').val('');
                        $('#chitietkiluat').val('');
                        toastr.options = {
                        "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm mới kỉ luật thành công', 'Thông báo');
                    },
                    })   
                }
            });
        </script>

        @endsection
</x-app-layout>
