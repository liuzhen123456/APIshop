<form action="{{url('/login/reg_do')}}"method="post">
    @csrf
    <table>
        <tr>
            <td>用户名</td>
            <td>
                <input type="text"name="user_name">
                <span>{{$errors->first('user_name')}}</span>
            </td>
        </tr>
        <tr>
            <td>email</td>
            <td>
                <input type="text"name="user_email">
                <span>{{$errors->first('user_email')}}</span>
            </td>
        </tr>
        <tr>
            <td>密码</td>
            <td>
                <input type="password"name="password">
                <span>{{$errors->first('password')}}</span>
            </td>
        </tr>
        <tr>
            <td>确认密码</td>
            <td>
                <input type="password"name="password_s">
                <span>{{$errors->first('password_s')}}</span>
            </td>
        </tr>
        <tr>
            <td><input type="submit"value="注册"</td>
        </tr>
    </table>
</form>