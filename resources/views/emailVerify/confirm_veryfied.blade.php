<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
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
    h1{
        color: red;
    }
    .container p {
        font-size: 25px;
        width: 250px;
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
    <img src="/images/ok.jpg" alt="ok">
    <p>Xác thực tài khoản thành công, quý khách có thể nhấn nút bên dưới để quay lại trang chủ để đăng nhập </p>
<a href="{{ route('user.login') }}">Quay lại đăng nhập</a>
</div>