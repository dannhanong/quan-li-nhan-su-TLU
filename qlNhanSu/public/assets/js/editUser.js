var accountF = $('#account').val();
var emailF = $('#email').val();

$('.formUser').validate({
    rules:{
        account:{
            required: true,
            remote: {
                url: baseUrl+'/check_account_unique',
                type: 'post',
                data: {
                    account: function(){
                        return $('#account').val();
                    },
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    accountF: accountF
                }
            }
        },
        password:{
            required: true,
            minlength: 8,
        },
        email:{
            required: true,
            email: true,
            remote: {
                // url: '{{ route("check_email_unique") }}',
                url: baseUrl+'/check_email_unique',
                type: 'post',
                data: {
                    email: function(){
                        return $('#email').val();
                    },
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    emailF: emailF
                },
            },
        }
    },
    messages:{
        account: {
            required: "Trường tài khoản không được để trống",
            remote: "Tài khoản đã tồn tại",
        },
        password: {
            required: "Trường mật khẩu không được để trống",
            minlength: "Mật khẩu tối thiểu 8 kí tự",
        },
        email: {
            required: "Trường email không được để trống",
            email: "Vui lòng nhập đúng định dạng email",
            remote: "Email đã tồn tại",
        },
    },
});

