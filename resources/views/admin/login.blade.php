<form action="{{url('/login/login_do')}}"method="post">
    @csrf
    <table>
        <tr>
            <td>用户名</td>
            <td><input type="text"name="user_name"></td>
        </tr>

        <tr>
            <td>密码</td>
            <td><input type="password"name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit"value="提交"></td>
        </tr>
    </table>
</form>