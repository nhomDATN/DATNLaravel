<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    h1{
        color: red;
    }
    .container {
        display: flex;
        width: 100%;
        height: 100%;
        position: absolute;
        text-align: center;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .container p {
        font-size: 25px;
        width: 200px;
    }
    .button
    {
        padding: 5px 2px;
        cursor: pointer;
        background:rgb(132, 73, 248);
        border:solid 1px rgb(255, 255, 255,0.25);
    }
    .button:hover{
        border:solid 1px rgb(0,0,0);
    }
</style>
<div class="container">
    <h1>CKCFastFood</h1>
    <p>Rất vui khi được quý khách đăng ký tài khoản, nếu quý khách chưa nhận được địa chỉ xác thực tài khoản, vui lòng nhấn nút ở phía dưới để nhận lại địa chỉ xác thực, Thân! </p>
<form action="{{ route('sendMailVerifyAccount') }}" method="get">
    @csrf
    <input type="hidden" name ="id" value="{{ $id }}">
    <input type="hidden" name ="EmailAddress" value="{{ $EmailAddress }}">
    <input type="hidden" name ="VeryfiedAddress" value="{{ $VeryfiedAddress }}">
    <button type="submit" class="button">Gửi lại</button>
</form>
<a href="{{ route('homeuser') }}">Quay lại trang chủ</a>
</div>