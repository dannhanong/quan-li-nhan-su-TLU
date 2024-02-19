@include('header')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">

<input class="inputCheck" type="checkbox" name="" id="check">
<div class="ccontainer">
    <label for="check">
        <span class="fas fa-times spCheck" id="times"></span>
        <span class="fas fa-bars spCheck" id="bars"></span>
    </label>
    <ol>
        <li><a href=""><i class="fa-solid fa-house"></i>Trang chủ</a></li>
        <li><a href="{{ route('khoas.index') }}"><i class="fa-solid fa-building"></i>Khoa</a></li>
        <li><a href=""><i class="fa-solid fa-house"></i>Trang chủ</a></li>
        <li><a href=""><i class="fa-solid fa-house"></i>Trang chủ</a></li>
    </ol>
</div>
