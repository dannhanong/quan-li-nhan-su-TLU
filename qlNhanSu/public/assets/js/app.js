$('.formUser').validate({
    rules:{
        name:{
            required: true,
        },
        account:{
            required: true,
        },
        password:{
            required: true,
            minlength: 8,
        },
        email:{
            required: true,
        }
    },
    messages:{
        name: "Hãy nhập tên hiển thị",
        email: "Hãy nhập email",
    },
});
