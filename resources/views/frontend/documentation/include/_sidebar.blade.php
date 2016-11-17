<div class="col-sm-3 col-md-3">
    <div class="panel-group documentation" id="accordion">
            @foreach($sidebar as $item)
            <div class="panel panel-default documentation">
                <div class="panel-heading documentation">
                    <h4 class="panel-title documentation">
                        <a data-toggle="collapse" data-parent="#accordion" href="{{$item['slug'] or ''}}" class="documentation"><i class="{{$item['icon'] or ''}}" aria-hidden="true"></i> &nbsp;
                           {{$item['name'] or ''}}</a>
                    </h4>
                </div>
                <div id="{{$item['id'] or ''}}" class="panel-collapse collapse {{active_class(!$item['collapsed'], 'in')}}">
                    <div class="panel-body documentation">
                        <table class="table documentation">
                            @foreach($item['submenu'] as $subitem)
                            <tr>
                                <td>
                                    <i class="{{$subitem['icon'] or ''}}"></i>&nbsp;<a href="{{$subitem['link'] or ''}}">{{$subitem['name'] or ''}}</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>