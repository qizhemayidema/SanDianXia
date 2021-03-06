@include('admin.common.source')
<div class="col-sm-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                <button type="button" onclick="window.location.href='{{ route('admin.storeService.add') }}'"
                        class="btn btn-w-m btn-primary">添加店铺服务
                </button>
            </h5>
        </div>
        <div class="ibox-content">
            <div class="example">

                <table class="table table-bordered table-hover text-center">
                    <thead>
                    <tr class="text-center">
                        <th style="text-align: center;">id</th>
                        <th style="text-align: center;">服务名称</th>
                        <th style="text-align: center;">人民币/年</th>
                        <th style="text-align: center;">购买限制(vip)</th>
                        <th style="text-align: center;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($storeInfo as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->money }}</td>
                            <td>
                                @if($value->vip_id)
                                    {{ $value->vip_name }}
                                    @else
                                    无
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"
                                            aria-expanded="false">操作 <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('admin.storeService.edit',['service_id'=>$value->id]) }}"
                                               class="font-bold">修改</a>
                                        </li>
                                        <li><a href="javascript:void(0);"
                                               onclick="removeCate(this,'{{ route('admin.storeService.delete',['service_id'=>$value->id]) }}')">删除</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div style="float: right;">
                {{ $storeInfo->links() }}
            </div>
        </div>
    </div>
</div>

<script>

    var removeCate = function (_this, url) {
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data:{
                _token:'{{ csrf_token() }}',
            },
            success: function (data) {
                if (data.code == 0) {
                    layer.msg(data.msg,{icon: 5})
                } else {
                    layer.msg('删除成功',{icon : 1})

                    $(_this).parents('tr').remove();
                }
            }
        })
    }
</script>