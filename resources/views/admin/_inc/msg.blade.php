<tfoot>
    @if(session('msg'))
    <tr>
        <td id="msg" colspan='5'> {{ session('msg') }} </td>
    </tr>
    @endif
</tfoot>