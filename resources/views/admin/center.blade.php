<form>
    <table>
        <tr>
            <td>用户ID</td>
            <td>用户名</td>
            <td>email</td>
            <td>注册时间</td>
            <td>最后登录时间</td>
        </tr>

        <tr>
            <td>{{$res->user_id}}</td>
            <td>{{$res->user_name}}</td>
            <td>{{$res->user_email}}</td>
            <td>{{date("Y-m-d H:i:s",$res->reg_time)}}</td>
            <td>{{date("Y-m-d H:i:s",$res->login_time)}}</td>
        </tr>

    </table>
</form>